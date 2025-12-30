# 🔧 Technical Reference & Code Snippets

## Modal Structure Overview

```
Modal Container (id="modalProgram")
│
├─ Header Section
│  ├─ Gradient background (emerald-50 → white → emerald-50)
│  ├─ Title (id="modalTitleProgram")
│  ├─ Subtitle (id="modalSubtitle")
│  └─ Close button [X]
│
├─ Form (id="formProgram")
│  ├─ Section 1: Basic Info
│  │  └─ Nama Program field
│  │
│  ├─ Section 2: Description
│  │  ├─ Auto-expanding textarea
│  │  └─ Character counter
│  │
│  ├─ Section 3: Timeline
│  │  ├─ Tanggal Mulai (date input)
│  │  └─ Tanggal Selesai (date input)
│  │
│  └─ Section 4: Image
│     ├─ Drop zone (id="dropZone")
│     ├─ File input (id="field_gambar")
│     ├─ New preview (id="preview-container")
│     └─ Existing preview (id="existing-image-container")
│
├─ Footer
│  ├─ Legend (required vs optional)
│  ├─ Cancel button
│  └─ Save button
│
└─ JavaScript Functions
   ├─ autoExpandTextarea()
   ├─ setupDragDropZone()
   ├─ updateCharCount()
   ├─ removeImage()
   ├─ previewImage()
   ├─ openModalProgram()
   ├─ closeModal()
   └─ Event listeners
```

---

## JavaScript Function Reference

### 1. Auto-Expanding Textarea
```javascript
/**
 * Automatically expand textarea to fit content
 * Called on input, focus, and modal open
 * @param {HTMLTextAreaElement} textarea
 */
function autoExpandTextarea(textarea) {
    textarea.style.height = 'auto';  // Reset height
    textarea.style.height = Math.min(textarea.scrollHeight, 500) + 'px';  // Set new height
}

// Usage:
autoExpandTextarea(document.getElementById('field_deskripsi'));
```

**How it works:**
1. Set height to 'auto' to calculate natural scroll height
2. Calculate scrollHeight (content height)
3. Set height to minimum of (scrollHeight, 500px max)
4. This prevents infinite growth

---

### 2. Setup Drag & Drop Zone
```javascript
/**
 * Initialize drag and drop for file uploads
 * Called on page load and after modal open
 */
function setupDragDropZone() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('field_gambar');

    if (!dropZone || !fileInput) return;

    // Prevent default browser behavior
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Visual feedback
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('border-emerald-500', 'bg-emerald-100/80', 'shadow-lg');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('border-emerald-500', 'bg-emerald-100/80', 'shadow-lg');
        }, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        fileInput.files = files;  // Set file input files
        const event = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(event);  // Trigger change event for preview
    }, false);
}
```

**Event flow:**
1. User drags file over zone → dragenter fires → highlight zone
2. User moves file in zone → dragover fires → keep highlighted
3. User moves out of zone → dragleave fires → remove highlight
4. User drops file → drop fires → extract files, trigger preview
5. preventDefaults() stops browser from opening file

---

### 3. Character Counter
```javascript
/**
 * Update character counter below textarea
 * Shows: "X / 500"
 */
function updateCharCount() {
    const textarea = document.getElementById('field_deskripsi');
    const charCount = document.getElementById('charCount');
    if (charCount) {
        charCount.textContent = `${textarea.value.length} / 500`;
    }
}

// Called on:
// 1. textarea input event
// 2. modal open (edit mode)
// 3. form reset
```

---

### 4. Image Preview with Validation
```javascript
/**
 * Show image preview after validation
 * Validates file size and type
 * @param {HTMLInputElement} input - File input element
 */
function previewImage(input) {
    const previewContainer = document.getElementById('preview-container');
    const imgPreview = document.getElementById('img-preview');

    if (!input.files || !input.files[0]) return;

    const file = input.files[0];
    
    // SIZE VALIDATION: Max 2MB
    if (file.size > 2 * 1024 * 1024) {
        alert('File terlalu besar! Maksimal 2MB.');
        input.value = '';  // Clear input
        previewContainer.classList.add('hidden');
        return;
    }

    // TYPE VALIDATION: JPG, PNG, WEBP only
    if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
        alert('Format tidak didukung! Gunakan JPG, PNG, atau WEBP.');
        input.value = '';  // Clear input
        previewContainer.classList.add('hidden');
        return;
    }

    // Read and display file
    const reader = new FileReader();
    reader.onload = (e) => {
        imgPreview.src = e.target.result;
        previewContainer.classList.remove('hidden');
        
        // Fade-in animation
        previewContainer.style.opacity = '0';
        previewContainer.style.transition = 'opacity 0.3s ease-in-out';
        setTimeout(() => {
            previewContainer.style.opacity = '1';
        }, 10);
    };
    reader.readAsDataURL(file);
}
```

**Validation rules:**
- Size: 2,097,152 bytes (2MB) maximum
- Type: Only image/jpeg, image/png, image/webp
- If invalid: Alert shown, input cleared, preview hidden

---

### 5. Modal State Management
```javascript
/**
 * Open modal in create or edit mode
 * @param {string} modalId - Modal element ID
 * @param {string} mode - 'create' or 'edit'
 * @param {object} data - Program data for edit mode
 */
function openModalProgram(modalId, mode, data = {}) {
    const modal = document.getElementById(modalId);
    const form = document.getElementById('formProgram');
    const methodInput = document.getElementById('formMethodProgram');
    const titleElement = document.getElementById('modalTitleProgram');
    const subtitleElement = document.getElementById('modalSubtitle');

    if (mode === 'create') {
        // CREATE MODE
        form.reset();  // Clear all fields
        form.action = '/admin/programs';
        methodInput.value = 'POST';
        titleElement.textContent = 'Tambah Program';
        subtitleElement.textContent = 'Buat program donasi baru...';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('existing-image-container').classList.add('hidden');
        
    } else if (mode === 'edit') {
        // EDIT MODE
        methodInput.value = 'PUT';
        form.action = `/admin/programs/${data.id}`;
        titleElement.textContent = 'Edit Program';
        subtitleElement.textContent = `Edit informasi untuk program "${data.nama_program}"`;
        
        // Populate form with data
        document.getElementById('field_nama_program').value = data.nama_program || '';
        document.getElementById('field_deskripsi').value = data.deskripsi || '';
        document.getElementById('field_tanggal_mulai').value = data.tanggal_mulai || '';
        document.getElementById('field_tanggal_selesai').value = data.tanggal_selesai || '';

        // Auto-expand textarea
        const textarea = document.getElementById('field_deskripsi');
        if (textarea) {
            autoExpandTextarea(textarea);
            updateCharCount();
        }

        // Show existing image if available
        if (data.gambar) {
            const existingContainer = document.getElementById('existing-image-container');
            document.getElementById('existing-img-preview').src = `/storage/${data.gambar}`;
            existingContainer.classList.remove('hidden');
        } else {
            document.getElementById('existing-image-container').classList.add('hidden');
        }
        document.getElementById('preview-container').classList.add('hidden');
    }

    // Show modal with fade-in
    modal.classList.remove('hidden');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);

    // Reinitialize drag-drop
    setTimeout(() => setupDragDropZone(), 100);
}
```

**Mode differences:**
| Aspect | Create | Edit |
|--------|--------|------|
| Form action | POST /admin/programs | PUT /admin/programs/{id} |
| Form state | Empty (reset) | Populated with data |
| Title | "Tambah Program" | "Edit Program" |
| Existing image | Hidden | Visible if available |
| New preview | Hidden | Can add new image |

---

### 6. Close Modal with Animation
```javascript
/**
 * Close modal with fade-out animation
 * Clears form and previews
 * @param {string} modalId - Modal element ID
 */
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    
    // Fade out
    modal.style.opacity = '0';
    modal.style.transition = 'opacity 0.3s ease-in-out';
    
    // After animation, hide and reset
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.opacity = '1';  // Reset for next open
        document.getElementById('formProgram').reset();
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('existing-image-container').classList.add('hidden');
    }, 300);  // Match transition duration
}
```

**Timeline:**
```
0ms:    Fade begins (opacity 1 → 0)
300ms:  Fade complete, modal hidden, form cleared
        opacity reset to 1 for next opening
```

---

### 7. Form Validation on Submit
```javascript
/**
 * Validate form data before submission
 * Runs when form submit event fires
 */
document.getElementById('formProgram').addEventListener('submit', function(e) {
    const nama = document.getElementById('field_nama_program').value.trim();
    const deskripsi = document.getElementById('field_deskripsi').value.trim();
    const mulai = document.getElementById('field_tanggal_mulai').value;
    const selesai = document.getElementById('field_tanggal_selesai').value;

    // Validation rules
    if (nama.length < 5) {
        e.preventDefault();
        alert('Nama program minimal 5 karakter.');
        return;
    }
    
    if (deskripsi.length < 20) {
        e.preventDefault();
        alert('Deskripsi minimal 20 karakter.');
        return;
    }
    
    if (new Date(mulai) >= new Date(selesai)) {
        e.preventDefault();
        alert('Tanggal selesai harus lebih besar dari tanggal mulai.');
        return;
    }

    // If all validations pass, form submits naturally (e.preventDefault not called)
});
```

**Validation rules:**
1. **Nama Program**: Min 5 chars
2. **Deskripsi**: Min 20 chars
3. **Dates**: selesai > mulai
4. **File** (server-side): Max 2MB, JPG/PNG/WEBP only

---

## Event Listener Map

```javascript
// Page Load
DOMContentLoaded
├─ Auto-expand textarea
├─ Setup drag-drop zone
└─ Update char count

// File Input Change
field_gambar.change
└─ previewImage(this)

// Textarea Input
field_deskripsi.input
├─ autoExpandTextarea(this)
└─ updateCharCount()

// Form Input (any field)
formProgram.input
└─ Show validation ring (brief)

// Form Submit
formProgram.submit
└─ Validate all fields

// Keyboard ESC
document.keydown
└─ closeModal('modalProgram')

// Modal Open Button
openModalProgram('modalProgram', mode, data)
├─ Reset or populate form
├─ Set form action and method
├─ Show/hide previews
└─ Fade in modal

// Modal Close Buttons
closeModal('modalProgram')
└─ Fade out, hide, reset
```

---

## CSS Classes Reference

### Layout Classes
- `fixed inset-0` - Cover entire viewport
- `bg-slate-900/60 backdrop-blur-sm` - Dimmed background
- `flex items-center justify-center` - Center modal
- `p-8` - Padding inside form sections
- `gap-6 space-y-6` - Spacing between elements

### Typography Classes
- `text-3xl font-black uppercase` - Main title
- `text-lg font-bold` - Section titles
- `text-sm font-bold` - Field labels
- `text-xs text-slate-500` - Helper text
- `tracking-tight tracking-widest` - Letter spacing

### Border & Outline Classes
- `border-2 border-slate-200` - Input borders
- `border-dashed` - Drag zone border
- `rounded-2xl rounded-xl rounded-lg` - Border radius
- `focus:border-emerald-500` - Focus state

### Color Classes
- `bg-gradient-to-r from-emerald-50 via-white to-emerald-50` - Gradient
- `bg-white bg-emerald-50 bg-emerald-100` - Backgrounds
- `text-emerald-600 text-slate-800` - Text colors
- `border-emerald-500 border-red-500` - Border colors

### Shadow & Effect Classes
- `shadow-2xl` - Modal shadow
- `shadow-lg shadow-emerald-200/50` - Button hover shadow
- `ring-2 ring-emerald-100` - Focus ring

### State Classes
- `focus:` - Focus state
- `hover:` - Hover state
- `active:` - Click state
- `group-focus-within:` - Group focus state

---

## Tailwind Configuration Used

```tailwind
// Colors
emerald-50:   #f0fdf4
emerald-100:  #dcfce7
emerald-500:  #10b981
emerald-600:  #059669

slate-50:    #f8fafc
slate-200:   #e2e8f0
slate-300:   #cbd5e1
slate-400:   #94a3b8
slate-500:   #64748b
slate-600:   #475569
slate-700:   #334155
slate-800:   #1e293b
slate-900:   #0f172a

red-50:      #fef2f2
red-500:     #ef4444
red-600:     #dc2626

blue-50:     #eff6ff
blue-100:    #dbeafe
blue-200:    #bfdbfe
blue-300:    #93c5fd

white:       #ffffff

// Opacity
/60 (60%)
/50 (50%)
/80 (80%)
```

---

## File Structure

```
program-table.blade.php
├─ Table HTML (lines 1-89)
│  ├─ Search input
│  ├─ Table thead
│  ├─ Table tbody
│  └─ Pagination
│
├─ Modal HTML (lines 92-387)
│  ├─ Header (gradient)
│  ├─ Form sections (4)
│  ├─ Footer buttons
│  └─ Blade directives (@csrf, @error)
│
└─ JavaScript (lines 388-602)
   ├─ Helper functions
   ├─ Event listeners
   └─ Form handlers
```

---

## Browser API Used

- **FileReader API** - Read file contents for preview
- **FormData API** - Multipart form data for upload
- **Drag and Drop API** - Handle file drag-drop
- **Event API** - Event listeners and dispatching
- **DOM API** - Select, manipulate elements
- **CSS Transitions** - Smooth animations

---

## Common Customizations

### Change Max File Size
```javascript
// In previewImage() function
if (file.size > 5 * 1024 * 1024) {  // Change to 5MB
    alert('File terlalu besar! Maksimal 5MB.');
```

### Change Character Limit
```javascript
// In form field
<textarea ... data-char-limit="1000">  <!-- Change to 1000 -->
// In updateCharCount()
charCount.textContent = `${textarea.value.length} / 1000`;
```

### Change Max Textarea Height
```javascript
// In autoExpandTextarea()
textarea.style.height = Math.min(textarea.scrollHeight, 800) + 'px';  // Change to 800px
```

### Change Form Colors
```blade
<!-- In modal header -->
class="bg-gradient-to-r from-blue-50 via-white to-blue-50"  <!-- Change emerald to blue -->

<!-- In focus states -->
focus:border-blue-500 focus:ring-blue-100  <!-- Change emerald to blue -->
```

---

## Testing Code in Browser Console

```javascript
// Test form open (create)
openModalProgram('modalProgram', 'create')

// Test form open (edit)
openModalProgram('modalProgram', 'edit', {
    id: 1,
    nama_program: 'Test Program',
    deskripsi: 'This is a test program',
    tanggal_mulai: '2025-01-01',
    tanggal_selesai: '2025-12-31',
    gambar: 'programs/test.jpg'
})

// Test textarea auto-expand
autoExpandTextarea(document.getElementById('field_deskripsi'))

// Test character count
updateCharCount()

// Test setup drag-drop
setupDragDropZone()

// Test close modal
closeModal('modalProgram')

// Test file validation
previewImage(document.getElementById('field_gambar'))
```

---

## Performance Optimizations

1. **Event Delegation** - Use capture phase for body listeners
2. **Lazy Initialization** - Setup drag-drop only when modal opens
3. **Debounce** - Not needed (single input events are fine)
4. **Memory** - Event listeners cleaned up when modal closes
5. **CSS** - No custom CSS, uses Tailwind utilities
6. **Images** - FileReader is client-side (no network call)

---

## Accessibility Attributes

```html
<!-- ARIA labels (could be added) -->
<input 
    aria-label="Nama program"
    aria-required="true"
    aria-describedby="error-nama"
/>

<!-- Focus management -->
Modal autofocus on first field (currently not implemented, could add)

<!-- Semantic HTML -->
<form>, <label>, <textarea>, <input>, <button> all semantic

<!-- Error association -->
@error() works with field name, could use aria-invalid
```

---

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Modal doesn't open | Check browser console for errors, verify element IDs |
| Drag-drop doesn't work | Only works in modern browsers with HTML5 support |
| Image preview doesn't show | Check file size < 2MB and format is JPG/PNG/WEBP |
| Textarea doesn't expand | Ensure CSS has resize-none, check max height (500px) |
| Form doesn't submit | Check CSRF token, @method directive, form action |
| Character counter doesn't update | Check textarea has correct ID (field_deskripsi) |
| ESC key doesn't close | Check modal ID matches function parameter |
| Mobile doesn't work | Check responsive classes (md:), test touch events |

---

## Future Enhancement Ideas

```javascript
// Rich text editor for textarea
// import Quill from 'quill'
// const quill = new Quill('#field_deskripsi', { theme: 'snow' });

// Image crop before upload
// import Cropper from 'cropperjs'
// const cropper = new Cropper(image, options)

// Drag to reorder multiple images
// sortable.js library integration

// Auto-save draft
// localStorage.setItem('draft_program', JSON.stringify(formData))

// Real-time validation
// Fetch server-side validation rules, validate as user types

// Image optimization
// Canvas API to compress images before upload
```

---

**Version**: 2.0  
**Last Updated**: 2025  
**Compatibility**: Modern browsers (Chrome 90+, Firefox 88+, Safari 14+, Edge 90+)  
**Dependencies**: None (vanilla JS, Tailwind CSS, Laravel)
