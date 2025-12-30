# 📋 Quick Reference - Image Upload Implementation

## Changes Made

### 1️⃣ Controller Updates
**File:** `app/Http/Controllers/ProgramController.php`

#### Added Import
```php
use Illuminate\Support\Facades\Storage;
```

#### Enhanced Methods:
- ✅ **store()** - Validates and stores uploaded images
- ✅ **update()** - Deletes old image before storing new one
- ✅ **destroy()** - Removes image file when program is deleted

### 2️⃣ View Updates
**File:** `resources/views/livewire/admin/program-table.blade.php`

#### Added Elements:
- ✅ File input field (`<input type="file">`)
- ✅ Image preview container
- ✅ Error messages for all form fields
- ✅ Accept filter for image formats
- ✅ JavaScript preview function (already existed, now integrated)

### 3️⃣ Model - No Changes Needed
**File:** `app/Models/Program.php`

✅ Already includes `'gambar'` in `$fillable` array
✅ Column already exists in migration

### 4️⃣ Migration - No Changes Needed
**File:** `database/migrations/2025_12_17_102903_create_programs_table.php`

✅ Already includes `$table->string('gambar')->nullable();`

---

## Validation Rules

| Field | Validation |
|-------|-----------|
| nama_program | required, string, max:255 |
| deskripsi | required, string |
| tanggal_mulai | required, date |
| tanggal_selesai | required, date, after_or_equal:tanggal_mulai |
| **gambar** | **nullable, image, mimes:jpg,jpeg,png,webp, max:2048** |

---

## File Storage

📁 **Storage Location:** `storage/app/public/programs/`

📤 **Public Access URL:** `/storage/programs/{filename}`

### Ensure Storage Link Exists
```bash
php artisan storage:link
```

---

## Key Features Implemented

### Image Upload
- ✅ Accepts JPG, JPEG, PNG, WEBP formats
- ✅ Maximum file size: 2MB
- ✅ Optional (nullable)

### Image Management
- ✅ Real-time preview on selection
- ✅ Shows existing image when editing
- ✅ Automatically deletes old image on update
- ✅ Deletes image file when program is deleted

### User Experience
- ✅ Clear file type requirements in label
- ✅ Inline validation error messages
- ✅ Visual preview feedback
- ✅ Cursor feedback on file input

### Security
- ✅ Server-side MIME type validation
- ✅ File size restrictions
- ✅ Proper disk access management

---

## Testing Checklist

- [ ] Create program without image → Success
- [ ] Create program with valid image → Image stored in `/storage/programs/`
- [ ] Create with invalid file type → Validation error shown
- [ ] Create with oversized file → Validation error shown
- [ ] Edit program, change image → Old image deleted, new one stored
- [ ] Edit program, no image change → No changes
- [ ] Delete program with image → Image file deleted from storage
- [ ] View database → Correct image paths stored
- [ ] Edit page → Shows existing image preview
- [ ] Create page → Preview hidden initially

---

## Implementation Summary

### Database
- Column: `gambar` (string, nullable)
- Stores: Relative path like `programs/abc123.jpg`

### Backend
- Validates: File type, size, format
- Stores: In public disk under `programs/` directory
- Deletes: Old files before new uploads or on deletion

### Frontend
- Accepts: Image files only
- Previews: Real-time file preview
- Shows: Existing image when editing
- Validates: Error display inline

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Images not visible | Run `php artisan storage:link` |
| File not deleting | Check file permissions on `storage/app/public/` |
| Upload fails silently | Check `php.ini` upload limits |
| Permission denied | Ensure Apache/Nginx has write access |

---

## Code Snippets Reference

### Controller - Store New Image
```php
if ($request->hasFile('gambar')) {
  $file = $request->file('gambar');
  $path = $file->store('programs', 'public');
  $validated['gambar'] = $path;
}
```

### Controller - Update with Old Image Deletion
```php
if ($request->hasFile('gambar')) {
  if ($program->gambar && Storage::disk('public')->exists($program->gambar)) {
    Storage::disk('public')->delete($program->gambar);
  }
  $file = $request->file('gambar');
  $path = $file->store('programs', 'public');
  $validated['gambar'] = $path;
}
```

### Controller - Delete Program and Image
```php
if ($program->gambar && Storage::disk('public')->exists($program->gambar)) {
  Storage::disk('public')->delete($program->gambar);
}
$program->delete();
```

### Blade - File Input
```blade
<input type="file" name="gambar" id="field_gambar" 
       accept=".jpg,.jpeg,.png,.webp" 
       onchange="previewImage(this)" 
       class="w-full border border-slate-200 p-2.5 rounded-xl text-sm">
```

### JavaScript - Image Preview
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

---

## Next Steps

1. ✅ Clear cache: `php artisan cache:clear`
2. ✅ Test file upload functionality
3. ✅ Verify storage link: `ls -la public/storage` (should be symlink)
4. ✅ Check `/storage/programs/` directory permissions
5. ✅ Verify database contains correct paths
6. ✅ Test all CRUD operations

---

**Status:** ✅ Implementation Complete

All files have been updated with comprehensive image upload capabilities!
