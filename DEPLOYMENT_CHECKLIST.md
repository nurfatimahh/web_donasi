# ✅ Implementation Checklist & Deployment Guide

## Pre-Deployment Verification

### 1. File Integrity Check
- [x] `resources/views/livewire/admin/program-table.blade.php` - Updated ✓
- [ ] Verify file size (should be ~600 lines)
- [ ] Check for syntax errors: `php artisan view:clear`
- [ ] Verify @csrf token present in form
- [ ] Verify @method directive exists

### 2. Controller Verification
- [x] `app/Http/Controllers/ProgramController.php` - No changes needed
- [ ] Verify store() method has image validation
- [ ] Verify update() method deletes old image
- [ ] Verify destroy() method deletes image file
- [ ] Check all validation rules in place

### 3. Model Verification
- [x] `app/Models/Program.php` - No changes needed
- [ ] 'gambar' exists in $fillable array
- [ ] Database migration has 'gambar' column (nullable string)

### 4. Database Check
```bash
# Verify migration ran successfully
php artisan migrate:status

# Check that programs table has 'gambar' column
php artisan tinker
>>> \App\Models\Program::where('id', 1)->first()
>>> # Should show 'gambar' column
```

---

## Functional Testing Checklist

### Modal Opening & Closing
- [ ] Click "Tambah Program" button
- [ ] Modal appears with fade-in animation
- [ ] Modal header shows "TAMBAH PROGRAM"
- [ ] Form is empty
- [ ] Click [X] button closes modal
- [ ] Click "Batal" button closes modal
- [ ] Press ESC key closes modal

### Create Mode Testing
- [ ] Open modal in create mode
- [ ] Form action should be `/admin/programs` (POST)
- [ ] Fill in "Nama Program" field
- [ ] Type in "Deskripsi" field
  - [ ] Textarea expands as you type
  - [ ] Character counter updates (0/500)
  - [ ] Max expands to 500px height
- [ ] Select "Tanggal Mulai" date
- [ ] Select "Tanggal Selesai" date

### Image Upload - Drag & Drop Testing
- [ ] Visual drag & drop zone appears
- [ ] Hover over zone - color changes (border-emerald-500)
- [ ] Drag JPG file onto zone - should work
- [ ] Drag PNG file onto zone - should work
- [ ] Drag WEBP file onto zone - should work
- [ ] Try drag unsupported format (e.g., .gif) - should show error
- [ ] Try drag file > 2MB - should show error
- [ ] After valid upload:
  - [ ] Preview shows in emerald box
  - [ ] "Ganti Gambar" button appears
  - [ ] Click button to replace with different image

### Image Upload - Click to Browse
- [ ] Click on drop zone (or "Pilih Gambar" button)
- [ ] File browser dialog opens
- [ ] Select valid image file
- [ ] Preview appears with animation (fade in 0.3s)
- [ ] Existing image box appears (if in edit mode)

### Form Validation - Client Side
- [ ] Leave "Nama Program" empty, try submit - error alert
- [ ] Enter "Program" (4 chars), try submit - error alert minimum 5
- [ ] Leave "Deskripsi" empty, try submit - error alert
- [ ] Enter "Desc" (4 chars), try submit - error alert minimum 20
- [ ] Select "Tanggal Selesai" BEFORE "Tanggal Mulai", try submit - error
- [ ] Fill all fields correctly - should submit without errors

### Input Focus & Interaction
- [ ] Click on "Nama Program" field
  - [ ] Border changes to emerald-500
  - [ ] Ring-2 ring-emerald-100 visible
  - [ ] Icon color changes to emerald-500
- [ ] Click on "Deskripsi" field
  - [ ] Textarea auto-expands to content height
  - [ ] Icon color changes to emerald-500
- [ ] Fill field, then blur - validation ring pulse appears briefly
- [ ] Tab through all fields - focus visible on each

### Edit Mode Testing
- [ ] Click "Edit" button on existing program
- [ ] Modal opens with "EDIT PROGRAM" title
- [ ] Form populated with program data:
  - [ ] Nama Program: Shows correct value
  - [ ] Deskripsi: Shows correct value (textarea auto-expanded)
  - [ ] Character counter: Shows correct count
  - [ ] Tanggal Mulai: Shows correct date
  - [ ] Tanggal Selesai: Shows correct date
- [ ] If program has image:
  - [ ] "Gambar Saat Ini" section shows
  - [ ] Image preview displays correctly
- [ ] Can drag new image to replace
- [ ] Can click to browse and select new image
- [ ] Form action: `/admin/programs/{id}` (PUT method)

### Error Message Display
- [ ] Submit with invalid data
- [ ] Error messages appear below each field
  - [ ] Red border-l-4 border-red-500
  - [ ] bg-red-50 background
  - [ ] Warning icon
  - [ ] Clear error text from server
- [ ] Correct the error and resubmit
- [ ] Error message disappears
- [ ] Form submits successfully

---

## Mobile Testing Checklist

### Responsive Layout (Mobile 320px)
- [ ] Modal width fits within 320px with padding
- [ ] Header doesn't overflow (close button visible)
- [ ] Form fields full width
- [ ] Date inputs: Stack vertically (not side-by-side)
- [ ] Buttons stack or fit nicely

### Responsive Layout (Tablet 768px+)
- [ ] Date inputs: Side-by-side (2 columns)
- [ ] Form appears more spacious
- [ ] Modal width increases (max-w-3xl)

### Touch Interaction
- [ ] Buttons large enough to tap (py-3 ≈ 48px height)
- [ ] Input fields large enough to tap
- [ ] Drop zone accessible on mobile (though drag-drop may not work)
- [ ] Click "Pilih Gambar" works on mobile
- [ ] File browser opens on mobile

### Mobile Keyboard
- [ ] Keyboard doesn't hide critical fields
- [ ] Textarea still usable with mobile keyboard
- [ ] Can still see validation messages
- [ ] Submit button accessible after keyboard appears

---

## Browser Compatibility Testing

### Desktop Browsers
- [ ] Chrome 90+ - All features working
- [ ] Firefox 88+ - All features working
- [ ] Safari 14+ - Check drag-drop support
- [ ] Edge 90+ - All features working

### Mobile Browsers
- [ ] Chrome Android - Drag-drop may not work, click works
- [ ] Firefox Android - Drag-drop may not work, click works
- [ ] Safari iOS - Drag-drop may not work, click works
- [ ] Samsung Internet - Test on devices

---

## Performance Testing

### Load Time
- [ ] Modal appears quickly when button clicked
- [ ] No lag when typing in textarea
- [ ] Image preview generates quickly (<500ms)
- [ ] Form submission responsive

### Memory & CPU
- [ ] Opening/closing modal multiple times - no memory leak
- [ ] Dragging multiple files - no crashes
- [ ] Type rapid text - no stuttering
- [ ] Animations smooth (60fps)

### File Size
```bash
# Check generated HTML size
wc -l resources/views/livewire/admin/program-table.blade.php
# Should be ~600 lines (reasonable)

# Check CSS file size (Tailwind should be optimized in production)
# Run: npm run build
# Check dist file size
```

---

## Security Testing

### CSRF Protection
- [ ] Form includes `@csrf` token
- [ ] Submit without token - should fail (test in browser console)
- [ ] Token refreshes on page reload

### Input Validation
- [ ] SQL injection attempt in "Nama Program" - sanitized by Laravel
- [ ] Script injection in "Deskripsi" - escaped by blade `{{ }}`
- [ ] File upload validation - enforced in controller

### File Upload Security
- [ ] Only image files accepted (checked in JS and controller)
- [ ] File size limited to 2MB
- [ ] File stored with random name (not user-controlled)
- [ ] File stored outside web root if possible (`storage/` directory)

---

## Integration Testing

### Create Program Flow
```
1. Click "Tambah Program" ✓
2. Fill form (all required fields) ✓
3. Upload image (drag or click) ✓
4. Click "Simpan Program" ✓
5. Wait for response
   ✓ Success: Modal closes, table updates with new row
   ✗ Error: Error message shows below field
```

### Edit Program Flow
```
1. Click "Edit" on existing program ✓
2. Verify data populates correctly ✓
3. Change some fields ✓
4. Update image or leave as-is ✓
5. Click "Simpan Program" ✓
6. Wait for response
   ✓ Success: Modal closes, table row updates
   ✗ Error: Error message shows
```

### Delete Program Flow
```
1. Verify image file exists in storage/app/public/programs/
2. Click "Delete" on program
3. Confirm deletion
4. Wait for deletion
5. Verify image file is deleted from storage
6. Verify row removed from table
```

---

## Accessibility Testing

### Keyboard Navigation
- [ ] Tab through all form fields in logical order
- [ ] Shift+Tab goes backward through fields
- [ ] Enter on button submits form
- [ ] ESC closes modal
- [ ] Focus always visible (blue ring)

### Screen Reader Testing (using NVDA or JAWS)
- [ ] Modal announced when opened
- [ ] Form labels read correctly
- [ ] Required fields announced
- [ ] Error messages announced
- [ ] Button purposes clear

### Color Contrast (using WebAIM Contrast Checker)
- [ ] Text on white: WCAG AA minimum
- [ ] White on emerald: WCAG AA minimum
- [ ] White on slate: WCAG AA minimum
- [ ] Error text on red background: WCAG AA minimum

### Focus Management
- [ ] Focus starts in first form field (Nama Program)
- [ ] Focus visible as ring around elements
- [ ] Focus trapped in modal (doesn't tab to background)
- [ ] Focus returns to trigger button after modal closes

---

## Documentation & Training

### For Developers
- [ ] README updated with form structure
- [ ] MODAL_REFACTOR_GUIDE.md created ✓
- [ ] FEATURE_COMPARISON.md created ✓
- [ ] Code comments added for complex functions ✓
- [ ] Inline documentation in JavaScript ✓

### For Users
- [ ] Helper text explains each field
- [ ] Placeholder examples provided
- [ ] Error messages are clear
- [ ] Character counter shows limit
- [ ] Drag & drop visual cues clear

---

## Deployment Steps

### 1. Pre-Deployment
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Run migrations (if new ones added)
php artisan migrate --force

# Seed database (if needed)
php artisan db:seed
```

### 2. File Deployment
- [ ] Upload updated `program-table.blade.php` to server
- [ ] Verify file permissions (644 for files)
- [ ] Verify directory permissions (755 for directories)

### 3. Post-Deployment Testing
- [ ] Access admin panel
- [ ] Click "Kelola Program" or similar
- [ ] Test create modal
- [ ] Test edit modal
- [ ] Test image upload
- [ ] Check browser console for errors (F12 → Console)

### 4. Monitoring
- [ ] Monitor error logs for 1 hour: `tail -f storage/logs/laravel.log`
- [ ] Monitor server resources (CPU, memory)
- [ ] Check for user-reported issues
- [ ] Monitor image upload directory for failed uploads

---

## Rollback Plan

If issues occur, rollback by:
```bash
# 1. Restore previous version of file
git checkout HEAD~1 resources/views/livewire/admin/program-table.blade.php

# 2. Clear caches
php artisan view:clear

# 3. Verify file restored
cat resources/views/livewire/admin/program-table.blade.php | head -20

# 4. Test in browser
# Access admin panel and test modal
```

---

## Post-Launch Improvements (Future)

- [ ] Add rich text editor (Quill or CKEditor) for deskripsi field
- [ ] Add image cropping tool before upload
- [ ] Add drag-to-reorder for multiple images (if needed)
- [ ] Add auto-save draft functionality
- [ ] Add image optimization on server
- [ ] Add upload progress indicator (for slow connections)
- [ ] Add bulk actions (edit multiple programs)
- [ ] Add image gallery with lightbox

---

## Maintenance Notes

### Monthly
- [ ] Review error logs for upload issues
- [ ] Check storage/app/public/programs/ for orphaned images
- [ ] Verify backups include image storage

### Quarterly
- [ ] Update Tailwind CSS version
- [ ] Check browser compatibility
- [ ] Review accessibility compliance
- [ ] Performance optimization review

### Annually
- [ ] Security audit of file upload code
- [ ] Update browser compatibility testing
- [ ] Review UX feedback from users
- [ ] Plan for next major refresh

---

## Sign-Off Checklist

- [ ] All functional tests passed ✓
- [ ] All mobile tests passed ✓
- [ ] All browser compatibility tests passed ✓
- [ ] Security testing completed ✓
- [ ] Performance acceptable ✓
- [ ] Accessibility compliant ✓
- [ ] Documentation complete ✓
- [ ] Team trained ✓
- [ ] Staging deployment successful ✓
- [ ] Production deployment completed ✓
- [ ] Post-launch monitoring 24+ hours ✓
- [ ] User feedback positive ✓

---

**Deployment Date**: _______________  
**Deployed By**: _______________  
**QA Sign-off**: _______________  
**Status**: 🟢 Ready / 🟡 On Hold / 🔴 Blocked

---

**Questions?** Refer to MODAL_REFACTOR_GUIDE.md or contact the development team.
