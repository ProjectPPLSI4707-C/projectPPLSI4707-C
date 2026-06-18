## **Feature Specification: Modul Distribusi SHU (Sisa Hasil Usaha) untuk SKOTER** 

## **Latar Belakang** 

SKOTER (Sistem Koperasi Terpadu) saat ini telah memiliki modul: 

- Simpanan 

- Pinjaman 

- Angsuran 

- Manajemen Anggota 

- Penyewaan Alat 

- Dashboard Admin 

Namun sistem belum memiliki fitur distribusi SHU (Sisa Hasil Usaha) yang merupakan salah satu proses bisnis utama dalam koperasi. 

Fitur ini bertujuan untuk menghitung dan mendistribusikan keuntungan koperasi kepada anggota secara otomatis berdasarkan kontribusi masing-masing anggota. 

## **Tujuan Fitur** 

Membangun modul SHU yang mampu: 

1. Menghitung SHU koperasi secara otomatis. 

2. Menghitung kontribusi setiap anggota. 

- Membagikan SHU berdasarkan: 

3. 

- Jasa Modal (berdasarkan simpanan) 

4. 

5. Jasa Usaha (berdasarkan aktivitas koperasi) 

6. Menampilkan rincian SHU kepada anggota secara transparan. 

7. Menyediakan laporan SHU tahunan bagi admin. 

## **Business Rules** 

## **Definisi SHU** 

SHU (Sisa Hasil Usaha) adalah keuntungan bersih koperasi yang diperoleh setelah seluruh pendapatan dikurangi biaya operasional. 

Formula: 

1 

SHU = Total Pendapatan - Total Biaya 

## **Sumber Kontribusi Anggota** 

## **Jasa Modal** 

Kontribusi berdasarkan: 

- Simpanan Pokok • Simpanan Wajib • Simpanan Sukarela 

Semakin besar total simpanan anggota, semakin besar SHU yang diterima. 

## **Jasa Usaha** 

Kontribusi berdasarkan aktivitas koperasi: 

- Pengajuan pinjaman • Total nilai pinjaman • Pembayaran angsuran 

Semakin aktif anggota menggunakan layanan koperasi, semakin besar SHU yang diterima. 

## **Pembagian SHU** 

Admin dapat menentukan persentase pembagian. 

Contoh: 

|Komponen|Persentase|
|---|---|
|Dana Cadangan|40%|
|Jasa Modal|30%|
|Jasa Usaha|30%|



Total harus selalu 100%. 

Sistem wajib melakukan validasi. 

2 

## **Database Design** 

## **Table: shu_settings** 

Digunakan untuk menyimpan konfigurasi SHU tahunan. 

```
CREATETABLEshu_settings(
idBIGINTPRIMARYKEYAUTO_INCREMENT,
tahunYEARNOTNULL,
total_shuDECIMAL(15,2)NOTNULL,
persen_cadanganDECIMAL(5,2)NOTNULL,
persen_jasa_modalDECIMAL(5,2)NOTNULL,
persen_jasa_usahaDECIMAL(5,2)NOTNULL,
```

```
generated_atTIMESTAMPNULL,
created_atTIMESTAMPNULL,
updated_atTIMESTAMPNULL
);
```

## **Table: shu_distributions** 

Menyimpan hasil distribusi SHU setiap anggota. 

```
CREATETABLEshu_distributions(
idBIGINTPRIMARYKEYAUTO_INCREMENT,
user_idBIGINTNOTNULL,
tahunYEARNOTNULL,
jasa_modalDECIMAL(15,2)NOTNULL,
jasa_usahaDECIMAL(15,2)NOTNULL,
```

```
total_shuDECIMAL(15,2)NOTNULL,
```

```
statusENUM(
'draft',
'approved',
'distributed'
)DEFAULT'draft',
```

```
distributed_atTIMESTAMPNULL,
created_atTIMESTAMPNULL,
```

3 

```
updated_atTIMESTAMPNULL
```

```
);
```

## **Model Laravel** 

Buat model baru: 

```
ShuSetting
ShuDistribution
```

Relasi: 

```
User
hasMany(ShuDistribution::class)
ShuDistribution
belongsTo(User::class)
```

## **Service Layer** 

Buat service baru: 

```
app/Services/ShuCalculatorService.php
```

Method: 

```
calculateTotalSavings()
calculateTotalTransactions()
calculateJasaModal()
calculateJasaUsaha()
generateAnnualShu()
approveDistribution()
markAsDistributed()
```

4 

## **Perhitungan SHU** 

## **Langkah 1** 

Admin menginput: 

```
Tahun: 2026
Total SHU:
60.000.000
```

## **Langkah 2** 

Sistem menghitung total simpanan seluruh anggota. 

Contoh: 

```
Total Simpanan Koperasi
500.000.000
```

## **Langkah 3** 

Sistem menghitung total transaksi usaha. 

Contoh: 

```
Total Aktivitas
1.000.000.000
```

## **Langkah 4** 

Hitung Jasa Modal 

Dana: 

5 

```
30% × 60.000.000
= 18.000.000
```

Formula: 

```
(Total Simpanan Anggota /
Total Simpanan Seluruh Anggota)
× Dana Jasa Modal
```

## **Langkah 5** 

Hitung Jasa Usaha 

Dana: 

```
30% × 60.000.000
= 18.000.000
```

Formula: 

```
(Total Transaksi Anggota /
Total Transaksi Seluruh Anggota)
× Dana Jasa Usaha
```

## **Langkah 6** 

Hitung Total SHU Anggota 

Formula: 

```
SHU Anggota =
Jasa Modal + Jasa Usaha
```

6 

## **Workflow Sistem** 

## **Admin** 

## **Generate SHU** 

1. Login Admin 

2. Buka menu SHU 

3. Input konfigurasi SHU 

4. Input total SHU tahunan 

5. Klik Generate 

6. Sistem menghitung seluruh anggota 

7. Sistem menyimpan hasil ke database 

8. Status = Draft 

## **Approve SHU** 

1. Admin membuka hasil distribusi 

2. Review hasil perhitungan 

3. Klik Approve 

4. Status berubah menjadi Approved 

## **Distribusikan SHU** 

1. Klik Distribusikan 

2. Status berubah menjadi Distributed 

3. SHU tampil pada akun anggota 

## **Dashboard Admin** 

Tambahkan widget baru: 

```
Total SHU Tahun Berjalan
Rp 60.000.000
```

```
SHU Sudah Didistribusikan
Rp 45.000.000
```

7 

```
Anggota Penerima SHU
150 Orang
```

## **Menu Admin Baru** 

```
Admin
│
├── Dashboard
├── Simpanan
├── Pinjaman
├── Angsuran
├── Penyewaan Alat
├── Anggota
└── SHU
```

Submenu: 

```
SHU
├── Konfigurasi SHU
├── Generate SHU
├── Distribusi SHU
└── Laporan SHU
```

## **Dashboard Anggota** 

Tambahkan kartu baru: 

```
SHU Tahun Ini
Rp 1.500.000
```

## **Menu Anggota Baru** 

```
Anggota
│
```

```
├── Dashboard
├── Simpanan
```

8 

```
├── Pinjaman
├── Angsuran
├── Penyewaan Alat
├── SHU Saya
└── Profil
```

## **Halaman SHU Saya** 

Menampilkan: 

## **Ringkasan** 

```
Tahun: 2026
Jasa Modal:
Rp 500.000
Jasa Usaha:
Rp 1.000.000
Total SHU:
Rp 1.500.000
```

## **Riwayat SHU** 

|Tahun|Total SHU|
|---|---|
|2026|Rp1.500.000|
|2025|Rp1.200.000|



## **API Endpoints** 

## **Admin** 

```
GET /admin/shu
POST /admin/shu/generate
```

9 

```
POST /admin/shu/approve
```

```
POST /admin/shu/distribute
```

```
GET /admin/shu/report
```

## **Anggota** 

```
GET /anggota/shu
```

```
GET /anggota/shu/history
```

## **Notifications** 

Saat SHU didistribusikan: 

```
Selamat!
```

```
SHU tahun 2026 telah dibagikan.
Total SHU Anda:
Rp1.500.000
```

Notifikasi tampil pada dashboard anggota. 

## **Reporting** 

Admin dapat: 

- Export PDF Distribusi SHU 

- Export Excel Distribusi SHU 

- Filter berdasarkan tahun 

- Melihat Top 10 penerima SHU terbesar 

10 

## **Acceptance Criteria** 

## **Admin** 

- Dapat mengatur konfigurasi SHU 

- Dapat menghasilkan distribusi SHU otomatis 

- Dapat menyetujui distribusi SHU 

- Dapat melihat laporan SHU 

## **Anggota** 

- Dapat melihat SHU yang diterima 

- Dapat melihat detail perhitungan 

- Dapat melihat riwayat SHU 

## **Sistem** 

- Perhitungan SHU otomatis 

- Validasi total persentase = 100% 

- Tidak boleh ada distribusi SHU ganda pada tahun yang sama 

- Seluruh proses tersimpan dalam database 

- Mendukung minimal 1000 anggota tanpa penurunan performa signifikan 

## **Future Enhancement** 

1. Distribusi SHU langsung ke saldo simpanan sukarela. 

2. Integrasi tanda tangan digital RAT. 

3. Simulasi prediksi SHU menggunakan data historis. 

4. Dashboard analitik kontribusi anggota. 

5. Grafik distribusi SHU per tahun. 

11 

