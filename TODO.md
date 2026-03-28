# F1 Livery Ranker - Completion Plan

## Approved Plan Steps (to make drag-drop ranking fully functional)

### 1. [x] DB Setup & Test Data

- `php artisan migrate:fresh --seed` **DONE**
- Verify: 11 teams, drivers seeded; test user created.
- `php artisan storage:link` exists

### 2. [x] Fix RankingController store() - Cleanup old ranks

- Added delete prior + create new **DONE**

### 3. [x] Add Navigation Link

- Added 'Rankings' to desktop/responsive dropdowns **DONE**

### 4. [x] Add Liveries (Optional but complete)

- `mkdir -p storage/app/public/liveries/` **DONE**
- Download 2026 F1 team liveries as JPG (e.g. mclaren.jpg etc. matching seeder 'liveries/mclaren.jpg')
- Note: Placeholders work fine; real images optional for polish.

### 5. [ ] Test Functionality

- Login test@example.com / password
- Go /rankings
- Drag teams → auto-save toast → refresh → order persists.
- If issues: Check console, network tab.

### 6. [ ] Polish (if time)

- Update index.blade.php counter for empty.
- Skip email verify if blocks.

**Current Progress: Starting step 1 commands.**
