# Image Upload Implementation Guide - Donation Program Dashboard

## Overview
This document outlines the refactored CRUD functionality with comprehensive image upload capabilities for the "Donation Program Dashboard".

---

## 1. Migration File
**File:** `database/migrations/2025_12_17_102903_create_programs_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();  // Image path - nullable for optional uploads
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
```

**Key Points:**
- `gambar` column is **nullable**, allowing users to create programs without images
- Column type is `string` to store the file path
- Uses timestamps for audit trail

---

## 2. Model
**File:** `app/Models/Program.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'nama_program',
        'deskripsi',
        'gambar',           // Image file path
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
```

**Key Points:**
- `gambar` is included in the `$fillable` array to allow mass assignment

---

## 3. Controller Implementation
**File:** `app/Http/Controllers/ProgramController.php`

### Key Improvements:

#### A. Import Statement
```php
use Illuminate\Support\Facades\Storage;
```
Added to handle file deletion operations.

#### B. Store Method (Create)
```php
public function store(Request $request)
{
    $validated = $request->validate([
      'nama_program' => ['required', 'string', 'max:255'],
      'deskripsi' => ['required', 'string'],
      'tanggal_mulai' => ['required', 'date'],
      'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
      'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    // Handle image upload
    if ($request->hasFile('gambar')) {
      $file = $request->file('gambar');
      $path = $file->store('programs', 'public');
      $validated['gambar'] = $path;
    }

    Program::create($validated);

    return redirect()->route('admin.programs.index')
      ->with('success', 'Program berhasil dibuat.');
}
```

**Validation Rules:**
- `nullable`: Image is optional
- `image`: Must be a valid image file
- `mimes:jpg,jpeg,png,webp`: Allowed formats
- `max:2048`: Maximum 2MB file size

**Storage Logic:**
- Images stored in `storage/app/public/programs/` directory
- File path saved to database

#### C. Update Method (Edit)
```php
public function update(Request $request, Program $program)
{
    $validated = $request->validate([
      'nama_program' => ['required', 'string', 'max:255'],
      'deskripsi' => ['required', 'string'],
      'tanggal_mulai' => ['required', 'date'],
      'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
      'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    // Handle image upload - delete old image if new one is uploaded
    if ($request->hasFile('gambar')) {
      // Delete old image if it exists
      if ($program->gambar && Storage::disk('public')->exists($program->gambar)) {
        Storage::disk('public')->delete($program->gambar);
      }

      // Store new image
      $file = $request->file('gambar');
      $path = $file->store('programs', 'public');
      $validated['gambar'] = $path;
    }

    $program->update($validated);

    return redirect()->route('admin.programs.index')
      ->with('success', 'Program berhasil diperbarui.');
}
```

**Key Features:**
- Validates new image before deletion
- Deletes old image from storage before saving new one
- Prevents storage bloat
- Only updates image if new file is provided

#### D. Destroy Method (Delete)
```php
public function destroy(Program $program)
{
    // Delete associated image file if it exists
    if ($program->gambar && Storage::disk('public')->exists($program->gambar)) {
      Storage::disk('public')->delete($program->gambar);
    }

    $program->delete();

    return redirect()->route('admin.programs.index')
      ->with('success', 'Program berhasil dihapus.');
}
```

**Key Features:**
- Checks if image exists before deletion
- Prevents orphaned files in storage
- Maintains clean filesystem

---

## 4. Blade View Implementation
**File:** `resources/views/livewire/admin/program-table.blade.php`

### Key Updates:

#### A. Form Enctype (Already Present)
```blade
<form id="formProgram" method="POST" action="/admin/programs" enctype="multipart/form-data" class="p-6 space-y-5">
    @csrf
    <input type="hidden" name="_method" id="formMethodProgram" value="POST">
```

#### B. Image Input Field (NEW)
```blade
<div>
    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">
        Gambar Program (JPG, PNG, WEBP - Max 2MB)
    </label>
    <input type="file" name="gambar" id="field_gambar" accept=".jpg,.jpeg,.png,.webp" 
           onchange="previewImage(this)" 
           class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none cursor-pointer">
    @error('gambar')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    
    <!-- Image Preview Container -->
    <div id="preview-container" class="hidden mt-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
        <p class="text-xs font-semibold text-slate-600 mb-2">Preview Gambar:</p>
        <img id="img-preview" src="" alt="Preview" class="max-h-48 rounded-lg object-cover">
    </div>
</div>
```

**Features:**
- File input with accept filter
- Real-time preview functionality
- Error messages for validation failures
- Clear labeling with size/format requirements

#### C. Error Handling (Enhanced)
Added `@error()` directives to all form fields for comprehensive validation feedback:

```blade
@error('nama_program')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
```

#### D. JavaScript Preview Function
```javascript
function previewImage(input) {
    const container = document.getElementById('preview-container');
    const img = document.getElementById('img-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            container.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
```

#### E. Modal Update Function
```javascript
function openModalProgram(modalId, mode, data = null) {
    const modal = document.getElementById(modalId);
    const form = document.getElementById('formProgram');
    const preview = document.getElementById('preview-container');
    const img = document.getElementById('img-preview');
    
    modal.classList.remove('hidden');
    preview.classList.add('hidden');

    if (mode === 'edit' && data) {
        document.getElementById('modalTitleProgram').innerText = 'Edit Program';
        form.action = `/admin/programs/${data.id}`;
        document.getElementById('formMethodProgram').value = 'PUT';
        document.getElementById('field_nama_program').value = data.nama_program;
        document.getElementById('field_deskripsi').value = data.deskripsi;
        document.getElementById('field_tanggal_mulai').value = data.tanggal_mulai;
        document.getElementById('field_tanggal_selesai').value = data.tanggal_selesai;
        document.getElementById('field_gambar').value = '';  // Clear file input
        
        if(data.gambar) {
            img.src = `/storage/${data.gambar}`;
            preview.classList.remove('hidden');  // Show existing image
        }
    } else {
        document.getElementById('modalTitleProgram').innerText = 'Tambah Program';
        form.action = "/admin/programs";
        document.getElementById('formMethodProgram').value = 'POST';
        form.reset();
    }
}
```

**Key Features:**
- Shows existing image in preview when editing
- Clears file input on mode change (security best practice)
- Displays appropriate modal title based on mode

---

## 5. File Storage Setup

### Public Disk Configuration
Ensure your `config/filesystems.php` has proper public disk setup:

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL') . '/storage',
    'visibility' => 'public',
],
```

### Create Storage Link (if not already created)
```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public`.

---

## 6. Validation Summary

| Field | Rules | Notes |
|-------|-------|-------|
| nama_program | required, string, max:255 | Program name |
| deskripsi | required, string | Program description |
| tanggal_mulai | required, date | Start date |
| tanggal_selesai | required, date, after_or_equal | End date (must be >= start) |
| gambar | nullable, image, mimes:jpg/jpeg/png/webp, max:2048 | Image file (optional) |

---

## 7. Best Practices Implemented

✅ **Image Validation**
- File type checking (mime types)
- File size limit (2MB)
- Input type restrictions

✅ **Storage Management**
- Organized storage directory (`storage/app/public/programs/`)
- Old image deletion on update
- Image deletion on record deletion

✅ **Security**
- File input cleared on edit (prevents accidental uploads)
- Storage disk properly configured
- Symlink for public access

✅ **User Experience**
- Real-time image preview
- Clear error messages
- Intuitive file input with format hints
- Visual feedback (hidden/shown preview)

✅ **Data Integrity**
- Nullable image column (optional uploads)
- Atomic transactions (delete old, save new)
- Proper error handling

---

## 8. Testing Checklist

- [ ] Create program without image
- [ ] Create program with valid image
- [ ] Create program with invalid file type (should fail)
- [ ] Create program with oversized file (should fail)
- [ ] Edit program without changing image
- [ ] Edit program with new image (should delete old)
- [ ] Delete program with image (should delete file)
- [ ] Verify `/storage/programs/` contains only necessary files
- [ ] Check database stores correct image paths
- [ ] Verify image preview displays correctly

---

## 9. Troubleshooting

**Issue:** Images not visible after upload
- **Solution:** Run `php artisan storage:link`

**Issue:** "No such file or directory" error on delete
- **Solution:** Code checks if file exists before deleting

**Issue:** File permissions error
- **Solution:** Ensure `storage/app/public/` has write permissions

**Issue:** Large file uploads fail
- **Solution:** Check `php.ini` settings: `upload_max_filesize` and `post_max_size`

---

## 10. Future Enhancements

- Image optimization/resizing with Intervention Image
- Multiple image support (gallery)
- Soft deletes for programs and images
- Image compression for storage optimization
- CDN integration for better performance
