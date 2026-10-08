# TugasWeb-P10-BlogCRUD

Tugas Rutin 10 - Blog CRUD dengan Laravel

| | |
|---|---|
| **Nama** | (Dev Reynaldi Simanjuntak) |
| **NIM** | (4253550008) |
| **Kelas** | (PSIK 25C) |
| **Mata Kuliah** | (Pemrograman Web) |

## Deskripsi
Aplikasi blog sederhana untuk menambah, melihat, mengubah, dan menghapus post (CRUD) menggunakan Laravel dan Bootstrap 5.

## Fitur

### Requirement
1. `Route::resource('posts')` dengan named routes
2. `PostController` resource (7 method)
3. Blade layout master (`@extends` / `@yield`)
4. Minimal 2 component: `<x-alert>` dan `<x-card>`
5. Validasi dengan pesan error per field dan `old()` input
6. Flash message sukses/gagal
7. `@csrf` di semua form, dan `@method` PUT/DELETE
8. Route Model Binding dan pagination

### Bonus
- Pencarian post (judul dan isi)
- Soft delete, dengan halaman Sampah dan fitur pulihkan
- Upload gambar (jpg, jpeg, png, webp, maksimal 2 MB)

## Teknologi
- PHP 8.2+
- Laravel 11/12
- Bootstrap 5 (CDN)
- SQLite / MySQL

## Cara Menjalankan

```bash
git clone https://github.com/devreynaldi/TugasWeb-P10-BlogCRUD.git
cd TugasWeb-P10-BlogCRUD

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan storage:link
php artisan serve
```

Buka http://127.0.0.1:8000 di browser.

> Jika memakai MySQL, buat database terlebih dahulu, lalu sesuaikan
> `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di file `.env`.

## Daftar Route

| Method | URI | Nama Route | Keterangan |
|---|---|---|---|
| GET | /posts | posts.index | Daftar post, pencarian, pagination |
| GET | /posts/create | posts.create | Form tambah post |
| POST | /posts | posts.store | Simpan post |
| GET | /posts/{post} | posts.show | Detail post |
| GET | /posts/{post}/edit | posts.edit | Form edit post |
| PUT/PATCH | /posts/{post} | posts.update | Update post |
| DELETE | /posts/{post} | posts.destroy | Hapus post (soft delete) |
| PATCH | /posts/{id}/restore | posts.restore | Pulihkan post |

## Struktur File Penting

```
app/Http/Controllers/PostController.php
app/Models/Post.php
app/Providers/AppServiceProvider.php
database/migrations/..._create_posts_table.php
resources/views/layouts/app.blade.php
resources/views/components/alert.blade.php
resources/views/components/card.blade.php
resources/views/posts/ (index, create, edit, show, _form)
routes/web.php
```

## Screenshot

### Daftar Post
![Daftar Post](screenshots/index.png)

### Tambah Post dan Validasi
![Validasi](screenshots/validasi.png)

### Halaman Sampah
![Sampah](screenshots/sampah.png)