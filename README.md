# Aplikasi Manajemen Buku

Aplikasi Manajemen Buku adalah aplikasi berbasis web yang dikembangkan menggunakan Laravel 10. Aplikasi ini dibuat untuk memenuhi tugas individu mata kuliah Pemrograman Web Lanjut dengan menerapkan Laravel Breeze sebagai sistem authentication dan Spatie Laravel Permission untuk pengelolaan role dan permission.

Aplikasi memiliki tiga jenis pengguna, yaitu Admin, Dosen, dan Mahasiswa. Setiap pengguna memiliki hak akses berbeda sesuai dengan role yang dimiliki.

## Fitur Aplikasi

- Registrasi akun pengguna.
- Login dan logout.
- Dashboard pengguna.
- Menampilkan daftar buku.
- Menambahkan data buku.
- Mengedit data buku.
- Menghapus data buku.
- Mengelola role pengguna oleh Admin.
- Pembatasan akses berdasarkan role dan permission.
- Proteksi route dan pemeriksaan hak akses di sisi server.
- Penolakan akses menggunakan HTTP 403 Forbidden bagi pengguna yang tidak memiliki izin.

## Teknologi yang Digunakan

| Teknologi | Keterangan |
|---|---|
| PHP | Bahasa pemrograman |
| Laravel 10 | Framework backend |
| Laravel Breeze 1.29 | Authentication |
| Spatie Permission 6.0 | Role dan permission |
| MySQL | Database |
| Bootstrap 5 | Framework tampilan |
| Composer | Pengelolaan dependensi PHP |
| Node.js dan NPM | Pengelolaan aset frontend |

## Role dan Hak Akses

| Fitur | Admin | Dosen | Mahasiswa |
|---|:---:|:---:|:---:|
| Login dan Logout | ✓ | ✓ | ✓ |
| Melihat Buku | ✓ | ✓ | ✓ |
| Menambahkan Buku | ✓ | ✓ | ✗ |
| Mengedit Buku | ✓ | ✓ | ✗ |
| Menghapus Buku | ✓ | ✗ | ✗ |
| Mengelola Role Pengguna | ✓ | ✗ | ✗ |

Pembatasan hak akses diterapkan melalui pemeriksaan permission di sisi server. Penyembunyian tombol pada tampilan hanya digunakan sebagai pengaturan antarmuka, bukan sebagai satu-satunya mekanisme keamanan.

## Struktur Database

Aplikasi menggunakan tabel berikut:

- `users`: menyimpan data pengguna.
- `books`: menyimpan data buku.
- `roles`: menyimpan data role.
- `permissions`: menyimpan daftar permission.
- Tabel relasi Spatie: menghubungkan pengguna, role, dan permission.

Tabel `books` memiliki kolom:

- `id`
- `title`
- `author`
- `publisher`
- `published_year`
- `created_at`
- `updated_at`

## Persyaratan Sistem

Pastikan perangkat sudah memiliki:

- PHP 8.1 atau lebih baru.
- Composer.
- MySQL atau MariaDB.
- Node.js dan NPM.
- Git.

## Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/shrzeduardo-hub/manajemen-buku.git
```

Masuk ke folder project:

```bash
cd manajemen-buku
```

### 2. Instal Dependensi PHP

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Untuk Windows Command Prompt:

```bash
copy .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Buat database MySQL dengan nama:

```text
manajemen_buku
```

Kemudian sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=manajemen_buku
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password dengan konfigurasi MySQL masing-masing.

### 5. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

Perintah tersebut akan membuat tabel database dan mengisi data role, permission, serta akun pengujian.

### 6. Instal Aset Frontend

```bash
npm install
```

Kemudian jalankan:

```bash
npm run build
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## Akun Pengujian

Aplikasi menyediakan tiga akun pengujian yang dibuat melalui database seeder.

| Role | Email | Password |
|---|---|---|
| Admin | admin@gmail.com | password123 |
| Dosen | dosen@gmail.com | password123 |
| Mahasiswa | mahasiswa@gmail.com | password123 |

**Catatan:** Akun tersebut hanya digunakan untuk pengujian lokal. Jangan gunakan password demo untuk lingkungan produksi.

## Pengujian Hak Akses

Pengujian dilakukan menggunakan ketiga akun untuk memastikan pembatasan akses berjalan sesuai ketentuan.

Hasil yang diharapkan:

1. Admin dapat melakukan seluruh operasi pengelolaan buku dan role pengguna.
2. Dosen dapat melihat, menambahkan, dan mengedit buku.
3. Mahasiswa hanya dapat melihat daftar buku.
4. Pengguna tanpa permission menerima respons HTTP 403 ketika mencoba mengakses fitur yang dibatasi.
5. Pengguna yang belum login diarahkan ke halaman login.
6. Setelah logout, pengguna tidak dapat mengakses kembali halaman terlindungi melalui sesi sebelumnya.

## Repository GitHub

Source code aplikasi dapat diakses melalui:

https://github.com/shrzeduardo-hub/manajemen-buku

---

**Dikembangkan sebagai tugas individu mata kuliah Pemrograman Web Lanjut.**
