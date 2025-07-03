# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, dan sistem transaksi.

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)

## Fitur

- Katalog Produk
  - Tampilan produk dengan gambar
  - Pencarian produk
- Keranjang Belanja
  - Tambah/hapus produk
  - Update jumlah produk
  - Harga otomatis dikurangi **diskon** jika tersedia pada hari ini
- Sistem Transaksi
  - Proses checkout
  - Riwayat transaksi
  - Harga yang disimpan dalam transaksi juga sudah dipotong diskon
- Panel Admin
  - Manajemen produk (CRUD)
  - Manajemen kategori
  - Laporan transaksi
  - Export data ke PDF
  - Manajemen diskon harian (tidak boleh ada dua tanggal yang sama)
- Sistem Autentikasi
  - Login/Register pengguna
  - Manajemen akun
  - Saat login, sistem otomatis mengecek dan menyimpan diskon hari ini ke session
- UI Responsif dengan NiceAdmin template
- Dashboard Webservice
  - Menampilkan semua transaksi menggunakan API berbasis REST
  - Menampilkan data total harga, jumlah item, ongkir, dan status transaksi

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Web server (XAMPP)

## Instalasi

1. **Clone repository ini**
   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```
2. **Install dependensi**
   ```bash
   composer install
   ```
3. **Konfigurasi database**

   - Start module Apache dan MySQL pada XAMPP
   - Buat database **db_ci4** di phpmyadmin.
   - copy file .env dari tutorial https://www.notion.so/april-ns/Codeigniter4-Migration-dan-Seeding-045ffe5f44904e5c88633b2deae724d2

4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```
5. **Seeder data**
   ```bash
   php spark db:seed ProductSeeder
   ```
   ```bash
   php spark db:seed UserSeeder
   ```
6. **Jalankan server**
   ```bash
   php spark serve
   ```
7. **Akses aplikasi**
   Buka browser dan akses `http://localhost:8080` untuk melihat aplikasi.

## Struktur Proyek

Proyek menggunakan struktur MVC CodeIgniter 4:

- app/Controllers - Logika aplikasi dan penanganan request
  - AuthController.php - Autentikasi pengguna
  - ProdukController.php - Manajemen produk
  - TransaksiController.php - Proses transaksi
  - DiskonController.php` - Manajemen data diskon (CRUD) khusus admin
  - ApiController.php` - Webservice REST API untuk dashboard eksternal
- app/Models - Model untuk interaksi database
  - ProductModel.php - Model produk
  - UserModel.php - Model pengguna
  - TransactionModel.php` - Model transaksi utama
  - TransactionDetailModel.php` - Model untuk detail produk per transaksi
  - DiskonModel.php` - Model diskon per tanggal
- app/Views - Template dan komponen UI
  - v_home.php - Halaman utama
  - v_produk.php - Tampilan produk
  - v_produk_kategori.php - Halaman untuk mengedit produk
  - v_keranjang.php - Halaman keranjang
  - v_profil.php - Halaman profil untuk melihat profil dan history transaksi
  - v_checkout.php` - Halaman checkout transaksi
  - v_login.php` - Halaman login
  - v_diskon.php` - Tampilan manajemen diskon
  - diskon/create.php` dan `diskon/edit.php` - Form tambah/edit diskon
- public/img - Gambar produk dan aset
- public/NiceAdmin - Template admin
- public/dashboard-toko/index.php - Dashboard eksternal (webservice) untuk melihat data transaksi dengan jumlah item dan status
