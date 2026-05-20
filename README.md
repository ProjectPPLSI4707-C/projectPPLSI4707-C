# 🏦 SKOTER — Sistem Koperasi Terpadu

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-v4-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind">
  <img src="https://img.shields.io/badge/MySQL-8.0-orange?style=for-the-badge&logo=mysql" alt="MySQL">
</p>

> Aplikasi manajemen koperasi digital berbasis web yang mencakup pengelolaan **Simpanan** (Pokok, Wajib, Sukarela) dan **Pinjaman** dengan fitur simulasi angsuran interaktif dan verifikasi admin.

---

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Akun Demo](#akun-demo)
- [Panduan Penggunaan — Anggota](#panduan-penggunaan--anggota)
- [Panduan Penggunaan — Admin](#panduan-penggunaan--admin)
- [Struktur Database](#struktur-database)
- [Struktur Folder](#struktur-folder)
- [Troubleshooting](#troubleshooting)

---

## ✨ Fitur Utama

### 👤 Anggota
- **Dashboard** — Ringkasan saldo simpanan per jenis dan status pinjaman aktif
- **Bayar Simpanan** — Input pembayaran 3 jenis simpanan (Pokok, Wajib, Sukarela) beserta unggah bukti bayar
- **Riwayat Simpanan** — Histori transaksi dengan filter jenis dan badge status (Pending/Success)
- **Simulasi Pinjaman** — Kalkulator angsuran interaktif real-time (slider tenor, input jumlah)
- **Ajukan Pinjaman** — Form pengajuan dengan unggah dokumen pendukung
- **Status Pinjaman** — Pantau pengajuan pinjaman (Diajukan/Disetujui/Ditolak) beserta catatan admin

### 👨‍💼 Admin
- **Dashboard** — Statistik total anggota, dana simpanan, pinjaman aktif, dan item pending
- **Notifikasi Badge** — Indikator merah di sidebar untuk setiap pengajuan baru yang belum diproses
- **Verifikasi Simpanan** — Tinjau bukti pembayaran dan ubah status ke Success
- **Persetujuan Pinjaman** — Tinjau detail pengajuan, riwayat simpanan anggota, dan rasio kelayakan
- **Approve / Reject** — Putuskan pengajuan pinjaman dengan catatan admin

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|----------|-----------|
| Backend Framework | Laravel 13 (PHP 8.3) |
| Frontend Styling | Tailwind CSS v4 + Vanilla CSS |
| Build Tool | Vite 8 |
| Database | MySQL 8 |
| Authentication | Session-based (Laravel built-in) |
| File Upload | Laravel Storage (local disk) |

---

## ⚙️ Persyaratan Sistem

Pastikan komputer Anda memiliki:

- **PHP** versi 8.3 atau lebih baru
- **Composer** versi 2.x
- **Node.js** versi 18+ dan **npm**
- **MySQL** versi 8.0+ (lokal atau remote)
- **Web server** — dapat menggunakan `php artisan serve`, Laragon, XAMPP, atau Herd

---

## 🚀 Instalasi

### Langkah 1 — Clone Repository

```bash
git clone https://github.com/username/projectPPLSI4707-C.git
cd projectPPLSI4707-C/PPLSI4707-C
```

### Langkah 2 — Install Dependensi PHP

```bash
composer install
```

### Langkah 3 — Install Dependensi Node.js

```bash
npm install
```

### Langkah 4 — Salin File Konfigurasi

```bash
cp .env.example .env
```

### Langkah 5 — Generate Application Key

```bash
php artisan key:generate
```

---

## 🗄️ Konfigurasi Database

### Buka file `.env` dan sesuaikan bagian berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1        # Ganti sesuai host MySQL Anda
DB_PORT=3306             # Ganti sesuai port MySQL Anda
DB_DATABASE=skoter       # Nama database (akan dibuat otomatis)
DB_USERNAME=root         # Username MySQL Anda
DB_PASSWORD=             # Password MySQL Anda
```

### Buat Database

Buat database bernama `skoter` di MySQL Anda:

```sql
CREATE DATABASE skoter CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau via terminal:

```bash
mysql -u root -p -e "CREATE DATABASE skoter CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

> Perintah ini akan membuat semua tabel dan mengisi data awal (3 user + 6 simpanan + 2 pinjaman dummy).

> **Reset data (jika diperlukan):**
> ```bash
> php artisan migrate:fresh --seed
> ```

### Buat Storage Link (untuk file upload)

```bash
php artisan storage:link
```

---

## ▶️ Menjalankan Aplikasi

### Mode Development (disarankan)

Buka **2 terminal** secara bersamaan:

**Terminal 1 — Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 — Vite (Hot Reload):**
```bash
npm run dev
```

Aplikasi dapat diakses di: **http://127.0.0.1:8000**

### Mode Production

```bash
npm run build
php artisan serve
```

---

## 🔐 Akun Demo

Setelah menjalankan seeder, gunakan akun berikut untuk login:

| Role | Email | Password | Keterangan |
|------|-------|----------|-----------|
| **Admin** | admin@skoter.id | password | Akses penuh verifikasi |
| **Anggota** | budi@skoter.id | password | Anggota dengan riwayat simpanan |
| **Anggota** | siti@skoter.id | password | Anggota dengan pinjaman pending |

---

## 👤 Panduan Penggunaan — Anggota

### 1. Login

1. Buka **http://127.0.0.1:8000**
2. Masukkan **email** dan **password** anggota
3. Klik tombol **"Masuk"**
4. Sistem akan mengarahkan otomatis ke **Dashboard Anggota**

---

### 2. Melihat Dashboard

Setelah login, halaman **Dashboard** menampilkan:
- **Total Simpanan** — Akumulasi semua simpanan yang telah terverifikasi
- **Simpanan Pokok** — Total simpanan jenis Pokok
- **Simpanan Wajib** — Total simpanan jenis Wajib
- **Simpanan Sukarela** — Total simpanan jenis Sukarela
- **Status Pinjaman** — Apakah ada pinjaman aktif atau sedang pending
- **Riwayat Terbaru** — 5 transaksi terakhir

---

### 3. Membayar Simpanan

1. Klik menu **"Bayar Simpanan"** di sidebar kiri
2. Pilih **jenis simpanan** dengan mengklik salah satu kartu:
   - 📌 **Pokok** — Simpanan awal keanggotaan, dibayar sekali
   - 📅 **Wajib** — Dibayar rutin setiap bulan
   - 💰 **Sukarela** — Dapat dibayar kapan saja
3. Masukkan **nominal pembayaran** (minimal Rp 1.000)
4. Klik area **"Klik untuk memilih file"** untuk mengunggah bukti pembayaran
   - Format yang diterima: **JPG, PNG, PDF**
   - Ukuran maksimal: **2 MB**
5. Klik tombol **"Kirim Pembayaran"**
6. Transaksi akan masuk ke riwayat dengan status **Pending** menunggu verifikasi admin

---

### 4. Melihat Riwayat Simpanan

1. Klik menu **"Riwayat Simpanan"** di sidebar
2. Halaman menampilkan:
   - **3 kartu ringkasan** — total per jenis simpanan yang sudah terverifikasi
   - **Tabel transaksi** — daftar semua transaksi dengan kolom: Jenis, Tanggal, Nominal, Bukti, Status
3. Gunakan **tombol filter** di atas tabel untuk menyaring berdasarkan jenis simpanan:
   - `Semua` | `Pokok` | `Wajib` | `Sukarela`
4. Badge status:
   - 🟡 **Pending** — Menunggu verifikasi admin
   - 🟢 **Success** — Sudah diverifikasi

---

### 5. Simulasi Pinjaman

1. Klik menu **"Ajukan Pinjaman"** di sidebar
2. Di sisi **kanan halaman**, terdapat widget **Simulasi Angsuran** (berwarna navy)
3. Cara menggunakan simulator:
   - Ketik **jumlah pinjaman** di kolom input (contoh: `5000000`)
   - Geser **slider tenor** untuk memilih jangka waktu (1–60 bulan)
   - Hasil kalkulasi muncul **otomatis secara real-time**:
     - 💛 **Angsuran/Bulan** — Cicilan yang harus dibayar tiap bulan
     - **Total Bunga** — Total biaya bunga selama tenor
     - **Total Pengembalian** — Total yang harus dikembalikan
4. Klik **"Gunakan Angka Ini di Form"** untuk menyalin hasil simulasi ke form pengajuan

> **Rumus bunga flat:** Angsuran = (Pokok ÷ Tenor) + (Pokok × 1%)

---

### 6. Mengajukan Pinjaman

1. Klik menu **"Ajukan Pinjaman"** di sidebar
2. Isi form pengajuan di sisi kiri:
   - **Jumlah Pinjaman** — Minimal Rp 500.000
   - **Tenor** — Pilih dari dropdown (3, 6, 12, 18, 24, 36, 48, atau 60 bulan)
   - **Tujuan / Alasan Pinjaman** — Jelaskan keperluan pinjaman (minimal 20 karakter)
   - **Dokumen Pendukung** _(opsional)_ — KTP, slip gaji, dll (JPG/PNG/PDF, maks 5 MB)
3. Klik tombol **"🚀 Ajukan Pinjaman"**
4. Pengajuan masuk ke status **"Diajukan"** dan menunggu keputusan admin

---

### 7. Memantau Status Pinjaman

1. Klik menu **"Status Pinjaman"** di sidebar
2. Tabel menampilkan semua riwayat pengajuan dengan informasi:
   - Tanggal pengajuan, jumlah, tenor, angsuran/bulan, tujuan
   - **Badge status:**
     - 🟡 **Diajukan** — Menunggu keputusan admin
     - 🟢 **Disetujui** — Pinjaman disetujui
     - 🔴 **Ditolak** — Pinjaman ditolak
   - **Catatan admin** — Alasan persetujuan atau penolakan

---

### 8. Logout

Klik tombol **"Keluar"** (ikon pintu) di bagian bawah sidebar kiri.

---

## 👨‍💼 Panduan Penggunaan — Admin

### 1. Login sebagai Admin

1. Buka **http://127.0.0.1:8000**
2. Masukkan email: **admin@skoter.id** dan password: **password**
3. Klik **"Masuk"** — sistem mengarahkan ke **Dashboard Admin**

---

### 2. Dashboard Admin

Halaman dashboard menampilkan:
- **👥 Total Anggota** — Jumlah anggota terdaftar
- **🏦 Total Dana Simpanan** — Akumulasi simpanan yang terverifikasi
- **⏳ Simpanan Pending** — Jumlah simpanan belum diverifikasi _(klik untuk langsung ke halaman verifikasi)_
- **⏳ Pinjaman Pending** — Jumlah pinjaman belum diputuskan
- **💳 Total Pinjaman Aktif** — Total nilai pinjaman yang disetujui
- **Daftar Pending Terbaru** — 5 simpanan dan 5 pinjaman terbaru yang menunggu tindakan

> 💡 **Notifikasi Badge**: Angka merah di menu **Simpanan** dan **Pinjaman** di sidebar menunjukkan berapa item yang memerlukan perhatian admin.

---

### 3. Verifikasi Simpanan

#### Melihat Daftar Simpanan

1. Klik menu **"Simpanan"** di sidebar
2. Gunakan **filter** di atas tabel untuk menyaring:
   - **Status**: `⏳ Pending` | `✅ Terverifikasi` | `📋 Semua`
   - **Jenis**: `Semua` | `Pokok` | `Wajib` | `Sukarela`
3. Tabel menampilkan: Nama Anggota, Jenis, Nominal, Tanggal, Bukti, Status

#### Memverifikasi Simpanan

1. Klik tombol **"Detail & Verifikasi"** pada baris simpanan yang berstatus Pending
2. Halaman detail menampilkan:
   - **Informasi transaksi** — nama, email, jenis, nominal, tanggal, status
   - **Riwayat simpanan** — semua simpanan anggota tersebut
   - **Bukti pembayaran** — tampilan gambar langsung atau link PDF
3. Periksa bukti pembayaran dengan teliti
4. Jika valid, klik tombol **"✅ Verifikasi — Tandai Success"**
5. Klik **OK** pada dialog konfirmasi
6. Status simpanan berubah menjadi **Success** dan saldo simpanan anggota bertambah

---

### 4. Verifikasi Pinjaman

#### Melihat Daftar Pinjaman

1. Klik menu **"Pinjaman"** di sidebar
2. Gunakan **filter status**: `⏳ Pending` | `✅ Disetujui` | `❌ Ditolak` | `📋 Semua`
3. Tabel menampilkan: Nama Anggota, Jumlah, Tenor, Angsuran/Bulan, Tujuan, Tanggal, Status

#### Meninjau dan Memutuskan Pinjaman

1. Klik tombol **"Putuskan"** pada baris pinjaman yang berstatus Pending
2. Halaman detail menampilkan:

   **Kolom Kiri:**
   - Detail pinjaman (jumlah, tenor, bunga, angsuran, total pengembalian)
   - Tujuan pinjaman
   - Dokumen pendukung (jika ada)

   **Kolom Kanan:**
   - 🏦 **Ringkasan Simpanan Anggota** — saldo Pokok, Wajib, Sukarela, dan Total
   - 📊 **Rasio Pinjaman vs Simpanan** — indikator kelayakan:
     - 🟢 ≤ 3x — Rasio aman
     - 🟡 ≤ 5x — Rasio cukup tinggi
     - 🔴 > 5x — Rasio sangat tinggi
   - 📋 Riwayat 10 simpanan terakhir anggota

3. **Untuk MENYETUJUI pinjaman:**
   - Isi kolom **"Catatan Persetujuan"** (opsional, sudah terisi default)
   - Klik **"✅ Setujui Pinjaman"**
   - Klik **OK** pada dialog konfirmasi

4. **Untuk MENOLAK pinjaman:**
   - Isi kolom **"Alasan Penolakan"** (wajib diisi)
   - Klik **"❌ Tolak Pinjaman"**
   - Klik **OK** pada dialog konfirmasi

5. Status pinjaman diperbarui dan catatan admin tersimpan untuk dilihat anggota

---

## 🗃️ Struktur Database

### Tabel `users`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary key |
| name | VARCHAR | Nama lengkap |
| email | VARCHAR | Email unik |
| password | VARCHAR | Password (hashed) |
| role | ENUM | `admin` atau `anggota` |
| created_at | TIMESTAMP | Waktu registrasi |

### Tabel `simpanan`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary key |
| user_id | BIGINT | Foreign key ke users |
| jenis_simpanan | ENUM | `Pokok`, `Wajib`, `Sukarela` |
| jumlah | DECIMAL(15,2) | Nominal simpanan |
| bukti_bayar | VARCHAR | Path file bukti pembayaran |
| status | ENUM | `Pending`, `Success` |
| created_at | TIMESTAMP | Tanggal transaksi |

### Tabel `pinjaman`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary key |
| user_id | BIGINT | Foreign key ke users |
| jumlah_pinjaman | DECIMAL(15,2) | Nominal pinjaman |
| tenor | TINYINT | Jangka waktu (bulan) |
| bunga_pinjaman | DECIMAL(5,2) | Bunga % per bulan (default: 1.00) |
| tujuan_pinjaman | TEXT | Alasan pengajuan |
| dokumen_pendukung | VARCHAR | Path file dokumen |
| status_pengajuan | ENUM | `Pending`, `Approved`, `Rejected` |
| tanggal_pengajuan | DATE | Tanggal pengajuan |
| catatan_admin | TEXT | Catatan dari admin |
| created_at | TIMESTAMP | Waktu buat |

---

## 📁 Struktur Folder (Sprint 3)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── SimpananController.php
│   │   │   └── PinjamanController.php
│   │   ├── Anggota/
│   │   │   ├── DashboardController.php
│   │   │   ├── SimpananController.php
│   │   │   └── PinjamanController.php
│   │   └── Auth/
│   │       └── LoginController.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── User.php
│   ├── Simpanan.php
│   └── Pinjaman.php
database/
├── migrations/
│   ├── ..._add_role_to_users_table.php
│   ├── ..._create_simpanan_table.php
│   └── ..._create_pinjaman_table.php
└── seeders/
    └── DatabaseSeeder.php
resources/views/
├── auth/
│   └── login.blade.php
├── layouts/
│   ├── app.blade.php
│   └── partials/
│       ├── sidebar-admin.blade.php
│       └── sidebar-anggota.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── simpanan/ (index.blade.php, show.blade.php)
│   └── pinjaman/ (index.blade.php, show.blade.php)
└── anggota/
    ├── dashboard.blade.php
    ├── simpanan/ (index.blade.php, create.blade.php)
    └── pinjaman/ (index.blade.php, create.blade.php)
routes/
└── web.php
```

---

## 🔧 Troubleshooting

### ❌ Error "Class not found"
```bash
composer dump-autoload
```

### ❌ Halaman kosong / error 500
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### ❌ File upload tidak tampil
```bash
php artisan storage:link
```

### ❌ Error koneksi database
- Pastikan MySQL berjalan
- Cek konfigurasi `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD` di `.env`
- Pastikan database `skoter` sudah dibuat

### ❌ Reset semua data ke kondisi awal
```bash
php artisan migrate:fresh --seed
```

### ❌ Vite / CSS tidak termuat
```bash
npm install
npm run build
```

---

## 📜 Lisensi

Proyek ini dibuat untuk keperluan akademik mata kuliah **Pemrograman Perangkat Lunak (PPL) SI4707** — Kelompok C.

---

## 👥 Tim Pengembang

Universitas | Program Studi Sistem Informasi | 2026
