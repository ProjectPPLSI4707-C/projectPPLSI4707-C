# Sistem Informasi Koperasi Simpan Pinjam

Aplikasi web untuk manajemen Koperasi Simpan Pinjam yang dibangun menggunakan arsitektur **MVC** dengan **Laravel 11**, **Tailwind CSS v4**, dan **SQLite**.

> **Sprint 1** — Sistem Autentikasi & Manajemen Anggota

---

## 📋 Fitur Sprint 1

### Sistem Autentikasi & Keamanan
- ✅ **Registrasi Anggota** — Formulir pendaftaran (Nama, Email, Password, No. KTP, No. Telepon, Alamat)
- ✅ **Verifikasi Registrasi** — Status default pendaftar baru: "Menunggu Verifikasi"
- ✅ **Login Pengguna** — Halaman login untuk Admin dan Anggota
- ✅ **Keamanan Login** — Password hashing (bcrypt) & proteksi sesi
- ✅ **Lupa Password** — Fitur reset kata sandi via token
- ✅ **Logout Pengguna** — Tombol logout fungsional
- ✅ **Manajemen Hak Akses** — Route protection berdasarkan role (Admin / Anggota)

### Manajemen Anggota (Admin)
- ✅ **Pendataan Anggota** — Tabel daftar seluruh anggota koperasi
- ✅ **Pencarian Data** — Search bar untuk cari anggota berdasarkan nama, ID, atau email
- ✅ **Filter Status** — Filter berdasarkan status keanggotaan (Aktif, Menunggu, Ditangguhkan)
- ✅ **Detail Anggota** — Halaman profil lengkap anggota
- ✅ **Edit Data Anggota** — Formulir update informasi anggota
- ✅ **Hapus Data Anggota** — Tombol hapus dengan konfirmasi
- ✅ **Verifikasi Anggota** — Setujui/Tolak pendaftaran baru
- ✅ **Status Keanggotaan** — Badge berwarna (Aktif=hijau, Menunggu=kuning, Ditangguhkan=merah)

---

## 🛠️ Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Framework | Laravel 11 (PHP 8.2+) |
| CSS Framework | Tailwind CSS v4 |
| Database | SQLite |
| Build Tool | Vite 6 |
| Arsitektur | MVC (Model-View-Controller) |

---

## ⚙️ Prasyarat (Prerequisites)

Pastikan perangkat Anda sudah terinstal:

1. **PHP** versi 8.2 atau lebih baru
   ```bash
   php -v
   ```
2. **Composer** (dependency manager PHP)
   ```bash
   composer --version
   ```
3. **Node.js** versi 18+ dan **npm**
   ```bash
   node -v
   npm -v
   ```
4. **Ekstensi PHP** yang diperlukan:
   - `pdo_sqlite`
   - `mbstring`
   - `openssl`
   - `tokenizer`
   - `xml`
   - `ctype`
   - `json`
   - `bcmath`

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone <url-repository>
cd PPLSI4707-C
```

### 2. Install Dependency PHP (Composer)

```bash
composer install
```

### 3. Install Dependency JavaScript (NPM)

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
# Linux / Mac
cp .env.example .env

# Windows (Command Prompt)
copy .env.example .env

# Windows (PowerShell)
Copy-Item .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Buat File Database SQLite

```bash
# Linux / Mac
touch database/database.sqlite

# Windows (PowerShell)
New-Item -ItemType File -Path database/database.sqlite -Force
```

### 7. Jalankan Migrasi & Seeder Database

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan membuat semua tabel dan mengisi data dummy:

| Email | Password | Role | Status |
|-------|----------|------|--------|
| `admin@koperasi.com` | `admin123` | Admin | Aktif |
| `budi@email.com` | `password` | Anggota | Aktif |
| `siti@email.com` | `password` | Anggota | Aktif |
| `ahmad@email.com` | `password` | Anggota | Menunggu |
| `dewi@email.com` | `password` | Anggota | Menunggu |
| `rudi@email.com` | `password` | Anggota | Ditangguhkan |

### 8. Jalankan Server

Buka **2 terminal** secara bersamaan:

**Terminal 1** — Laravel Development Server:
```bash
php artisan serve
```

**Terminal 2** — Vite (Tailwind CSS & Asset Bundling):
```bash
npm run dev
```

### 9. Buka Aplikasi di Browser

```
http://127.0.0.1:8000
```

> ⚠️ **Penting:** Kedua server (PHP artisan serve & npm run dev) harus berjalan bersamaan agar CSS & JavaScript ter-load dengan benar.

---

## 📖 Panduan Penggunaan

### Login sebagai Admin

1. Buka `http://127.0.0.1:8000/login`
2. Masukkan email: `admin@koperasi.com`
3. Masukkan password: `admin123`
4. Klik **"Masuk"**

### Dashboard Admin

Setelah login, Admin akan melihat:
- **4 kartu statistik** — Total Anggota, Aktif, Menunggu Verifikasi, Ditangguhkan
- **Pendaftaran Terbaru** — Daftar pendaftar baru yang bisa langsung disetujui/ditolak
- **Aksi Cepat** — Pintasan ke menu utama

### Manajemen Anggota

Klik **"Manajemen Anggota"** di sidebar untuk:
- 🔍 **Cari anggota** — Ketik nama/ID/email di search bar, lalu klik "Cari"
- 🔽 **Filter status** — Pilih status dari dropdown (Semua, Aktif, Menunggu, Ditangguhkan)
- 👁️ **Lihat detail** — Klik ikon mata pada baris anggota
- ✏️ **Edit data** — Klik ikon pensil atau tombol "Edit Data Anggota" di halaman detail
- ✅ **Verifikasi** — Klik ikon centang (untuk anggota berstatus "Menunggu")
- 🗑️ **Hapus anggota** — Klik ikon tempat sampah (dengan konfirmasi)
- 🔄 **Ubah status** — Di halaman detail, klik "Aktifkan" atau "Tangguhkan"

### Registrasi Anggota Baru

1. Di halaman login, klik **"Daftar sekarang"**
2. Isi formulir lengkap (Nama, Email, Password, No. KTP, No. Telepon, Alamat)
3. Klik **"Daftar Sekarang"**
4. Akun baru akan berstatus **"Menunggu Verifikasi"**
5. Admin harus menyetujui pendaftaran sebelum anggota dapat menggunakan fitur

### Login sebagai Anggota

1. Buka `http://127.0.0.1:8000/login`
2. Gunakan salah satu akun anggota (contoh: `budi@email.com` / `password`)
3. Anggota akan melihat dashboard profil pribadi mereka

### Lupa Password

1. Di halaman login, klik **"Lupa password?"**
2. Masukkan email yang terdaftar
3. Sistem akan membuat link reset (untuk demo, langsung redirect ke form reset)
4. Masukkan password baru dan konfirmasi
5. Login dengan password baru

### Logout

Klik ikon logout (panah keluar) di bagian bawah sidebar, sebelah nama pengguna.

---

## 📁 Struktur Proyek (MVC)

```
PPLSI4707-C/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Controller autentikasi
│   │   │   ├── AdminController.php     # Controller dashboard & manajemen anggota
│   │   │   └── AnggotaController.php   # Controller dashboard anggota
│   │   └── Middleware/
│   │       └── RoleMiddleware.php      # Middleware proteksi role
│   └── Models/
│       └── User.php                    # Model User (Anggota/Admin)
├── database/
│   ├── migrations/                     # Struktur tabel database
│   ├── seeders/
│   │   └── DatabaseSeeder.php          # Data dummy (1 Admin + 5 Anggota)
│   └── factories/
│       └── UserFactory.php             # Factory untuk testing
├── resources/
│   ├── css/
│   │   └── app.css                     # Konfigurasi Tailwind CSS + tema kustom
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php           # Layout utama (sidebar + konten)
│       │   └── guest.blade.php         # Layout halaman publik
│       ├── auth/
│       │   ├── login.blade.php         # Halaman login
│       │   ├── register.blade.php      # Halaman registrasi
│       │   ├── forgot-password.blade.php
│       │   └── reset-password.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php     # Dashboard admin
│       │   └── anggota/
│       │       ├── index.blade.php     # Tabel manajemen anggota
│       │       ├── show.blade.php      # Detail profil anggota
│       │       └── edit.blade.php      # Form edit anggota
│       └── anggota/
│           └── dashboard.blade.php     # Dashboard anggota
├── routes/
│   └── web.php                         # Definisi semua route
├── bootstrap/
│   └── app.php                         # Konfigurasi middleware
└── .env                                # Konfigurasi environment
```

---

## 🗃️ Struktur Database

### Tabel `users`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint (PK) | Auto increment |
| `nomor_id_anggota` | string (unique) | Format: #SL-2026-XXXX |
| `nama_lengkap` | string | Nama lengkap pengguna |
| `email` | string (unique) | Email untuk login |
| `password` | string | Password (hashed bcrypt) |
| `no_ktp` | string | Nomor KTP |
| `no_telepon` | string | Nomor telepon |
| `alamat` | text | Alamat lengkap |
| `role` | enum | `admin` atau `anggota` |
| `status_keanggotaan` | enum | `menunggu`, `aktif`, `ditangguhkan` |
| `tanggal_bergabung` | timestamp | Tanggal bergabung |
| `email_verified_at` | timestamp | Timestamp verifikasi email |
| `remember_token` | string | Token "remember me" |
| `created_at` | timestamp | Dibuat pada |
| `updated_at` | timestamp | Diperbarui pada |

---

## 🔐 Keamanan

- **Password Hashing**: Bcrypt (via Laravel `Hash` facade)
- **CSRF Protection**: Token CSRF pada setiap form
- **Session Security**: Regenerasi session setelah login, invalidasi session saat logout
- **Route Protection**: Middleware `auth` dan `role` untuk proteksi halaman
- **Validation**: Server-side validation pada semua input form

---

## 👥 Tim Pengembang

**PPLSI4707-C**

---

## 📄 Lisensi

MIT License
