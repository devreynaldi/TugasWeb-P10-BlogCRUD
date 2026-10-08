# TugasWeb-P10-BlogCRUD

Tugas Rutin 10 — Blog CRUD Laravel (Laravel 11/12).

## Cara pasang
1. Buat project baru:
   composer create-project laravel/laravel TugasWeb-P10-BlogCRUD
2. Salin isi folder ini (routes, app, database, resources) ke project tersebut (timpa jika diminta).
3. (Sudah termasuk) `app/Providers/AppServiceProvider.php` sudah mengaktifkan Paginator::useBootstrapFive().

4. Atur database di `.env` (default Laravel 11+ memakai SQLite, langsung jalan).
5. Jalankan:
       php artisan migrate
       php artisan storage:link
       php artisan serve
6. Buka http://127.0.0.1:8000

## Checklist requirement
| # | Requirement | Lokasi |
|---|-------------|--------|
| 1 | Route::resource('posts') + named routes | routes/web.php |
| 2 | PostController resource (7 method) | app/Http/Controllers/PostController.php |
| 3 | Blade layout master @extends/@yield | resources/views/layouts/app.blade.php |
| 4 | Minimal 2 components (Alert, Card) | resources/views/components/ |
| 5 | Validasi + error per field + old input | PostController::rules() + posts/_form.blade.php |
| 6 | Flash message sukses/gagal | layouts/app.blade.php + try/catch di controller |
| 7 | @csrf semua form + @method PUT/DELETE | posts/*.blade.php |
| 8 | Route Model Binding + pagination | show/edit/update/destroy(Post $post), paginate(6) |
| Bonus | Pencarian, soft delete, upload gambar | Post::scopeSearch, SoftDeletes, store('posts','public') |
