# Aplikasi Ecommerce Laravel

Ini adalah aplikasi ecommerce sederhana yang dibuat dengan Laravel. 
Fitur-fitur: otentikasi user dnegan Breeze, manajemen produk, keranjang belanja, dan integrasi pembayaran dengan Midtrans.

## Tech Stack yang Dipake

- **Laravel 10**: 
- **MySQL**: 
- **TailwindCSS**: 
- **Blade**: 
- **Vanilla JS**: 
- **Midtrans**: 

## Fitur

- **Otentikasi Pengguna**: Auth Laravel Breeze.
- **Manajemen Produk**: Seller bisa tambah, edit, atau hapus produk melalui admin panel.
- **Keranjang Belanja**: User bisa tambah barang ke keranjang, cek out, dan lihat total belanja.
- **Manajemen Order**: Pembeli bisa liat histori pembelian.
- **Integrasi Pembayaran**: Pembayaran dengan Midtrans Sandbox.

## Cara Install

1. **Clone Repo**: Clone repo ini ke local
   ```bash
    https://github.com/mangunkars26/ecommerce-midtrans

2. Install Dependensi: Masuk ke folder project terus install dependensi pake Composer.

3. Konfigurasi Environment: Duplikat file .env.example jadi .env dan sesuaikan konfigurasi database sama detail lainnya.
4. Generate Key: Generate application key buat Laravel.
5. Set Up Database: Buat database baru di MySQL (sesuaikan dengan nama database yang di .env) terus migrate tabelnya.
6. Install Node Modules: Kalo pake Tailwind atau asset lain, jangan lupa install node module-nya terus compile asset. 
7. Jalankan Aplikasinya: Terakhir, jalankan aplikasi.
8. Selesai: Buka browser terus akses aplikasi di http://localhost:8000.

##  Midtrans
Midtrans ini payment gateway yang dipake buat proses pembayaran di aplikasi ini. Pake Midtrans, transaksi jadi lebih aman dan gampang karena udah support banyak metode pembayaran, kayak transfer bank, e-wallet, sama kartu kredit.  

1. Cara Konfigurasi Midtrans
2. Daftar akun di Midtrans.
3. Setelah akun aktif, ambil API key dari dashboard Midtrans.
4. Masukkan API key ke file .env di bagian ini:
```bash
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
```
4. Selesai
