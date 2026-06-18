# DESIGN.md - Sistem Manajemen Koperasi Simpan Pinjam "KopVision"

## 1. Tema Visual & Atmosfer

Desain harus mencerminkan **kepercayaan finansial**, **stabilitas**, dan **transparansi**. Tidak boleh terasa seperti aplikasi hiburan atau media sosial. Antarmuka ditujukan untuk pengurus koperasi dan anggota, digunakan di laptop atau tablet dalam lingkungan kantor kecil hingga menengah. Nuansanya seperti dashboard keuangan profesional (mirip sistem akuntansi modern) namun tetap sederhana dan mudah dipahami.

## 2. Palet Warna

* **Latar Belakang Utama:** `#121212` (Mode gelap untuk kenyamanan mata dan fokus data).
* **Permukaan Kartu:** `#1E1E1E`.
* **Aksen Utama (Data Keuangan):** `#00E5FF` (Cyan) untuk saldo, grafik, dan tombol utama.
* **Aksen Pemasukan:** `#32D74B` (Hijau) untuk simpanan, pembayaran, dan arus kas positif.
* **Aksen Pengeluaran / Risiko:** `#FF453A` (Merah) untuk pinjaman bermasalah atau keterlambatan.
* **Teks Utama:** `#FFFFFF`.
* **Teks Sekunder:** `#98989D`.

## 3. Gaya Komponen

* **Kartu (Cards):**

  * `border-radius: 16px`
  * Background `#1E1E1E`
  * Padding `20px`
  * Border: `1px solid #2C2C2E`

* **Grafik (Charts):**

  * Grid: `#2C2C2E`
  * Data simpanan: `#32D74B`
  * Data pinjaman: `#00E5FF`
  * Alert tunggakan: `#FF453A`
  * Gunakan area chart untuk tren keuangan

* **Tabel Data Anggota / Transaksi:**

  * Border bawah: `1px solid #2C2C2E`
  * Hover: `#252525`
  * Kolom utama: Nama, ID Anggota, Saldo, Pinjaman, Status

* **Notifikasi / Alert:**

  * Background: `#3A1C1C`
  * Teks: `#FF453A`
  * Border kiri: `4px solid #FF453A`
  * Digunakan untuk:

    * Tunggakan
    * Pinjaman jatuh tempo
    * Anomali transaksi

## 4. Tipografi

* **Judul:** Inter Semi Bold, 24px
* **Metrik KPI (Saldo, Pinjaman, SHU):** JetBrains Mono / Fira Code, Bold, 32px
* **Isi / Label:** Inter Regular, 14px

## 5. Prinsip Layout

* **Grid:** 12 kolom
* **Spacing:** 8px system (8, 16, 24, 32)

### Struktur Dashboard:

* **Baris Atas (Ringkasan KPI):**

  * Total Simpanan
  * Total Pinjaman
  * Kas Koperasi / Saldo Bersih

* **Bagian Tengah:**

  * Grafik arus kas (8 kolom)
  * Grafik pertumbuhan anggota (4 kolom)

* **Bagian Bawah:**

  * Tabel transaksi terbaru (8 kolom)
  * Panel notifikasi & pinjaman bermasalah (4 kolom)

## 6. Fitur Utama Sistem

* **Manajemen Anggota**

  * Registrasi & profil anggota
  * Riwayat simpanan & pinjaman

* **Manajemen Simpanan**

  * Simpanan pokok, wajib, sukarela
  * Tracking saldo real-time

* **Manajemen Pinjaman**

  * Pengajuan pinjaman
  * Perhitungan bunga & cicilan
  * Status pembayaran

* **Monitoring Keuangan**

  * Arus kas masuk/keluar
  * Laporan bulanan
  * SHU (Sisa Hasil Usaha)

* **Alert Otomatis**

  * Tunggakan pembayaran
  * Pinjaman mendekati jatuh tempo
  * Aktivitas mencurigakan

## 7. Do's and Don'ts

* ✅ **Do:** Tampilkan angka dengan format mata uang lokal (Rp / Bs sesuai kebutuhan).

* ✅ **Do:** Gunakan warna hijau untuk transaksi sehat dan merah untuk risiko.

* ✅ **Do:** Prioritaskan keterbacaan angka dan transparansi data.

* ❌ **Don't:** Jangan gunakan warna mencolok berlebihan yang membingungkan arti data.

* ❌ **Don't:** Jangan menyembunyikan informasi penting seperti tunggakan.

* ❌ **Don't:** Hindari ikon tidak relevan (gunakan ikon keuangan seperti dompet, grafik, bank).

## 8. Catatan UX Tambahan

* Semua angka keuangan harus mudah dipindai (scanable).
* Hindari overload informasi dalam satu layar.
* Gunakan filter (tanggal, anggota, jenis transaksi) untuk eksplorasi data.
* Sistem harus terasa **cepat, stabil, dan dapat dipercaya**.
