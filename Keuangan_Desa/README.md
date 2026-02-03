# Sistem Akuntansi Keuangan Desa Selokarto

Aplikasi **Sistem Akuntansi Keuangan Desa Selokarto** adalah aplikasi berbasis web yang digunakan untuk mengelola pencatatan dan pelaporan keuangan desa secara terstruktur, sederhana, dan mudah digunakan.

Aplikasi ini dibuat menggunakan **PHP Native** dan **MySQL**, dengan fokus pada kebutuhan dasar akuntansi desa/BUMDes.

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Keamanan
- Login Admin
- Logout
- Ganti Password
- Password tersimpan dengan **hashing (password_hash)**

### 📘 Akuntansi
- Chart of Account (COA)
  - Tambah akun
  - Edit akun
  - Hapus akun
  - Filter berdasarkan jenis akun
- Jurnal Umum
  - Validasi total debit = total kredit
- Buku Besar per Akun
- Laporan Laba Rugi
- Neraca
- Dashboard ringkasan keuangan


## 🛠️ Teknologi yang Digunakan

- PHP (Native)
- MySQL
- Bootstrap 5
- HTML & CSS
- XAMPP (Apache & MySQL)

---

## 📁 Struktur Folder

```
KEUANGAN_DESA
│
├── assets/
│   └── BalaiDesa.jpeg
│
├── auth/
│   ├── login.php
│   ├── proses_login.php
│   └── logout.php
│
├── pages/
│   ├── dashboard.php
│   ├── coa.php
│   ├── jurnal.php
│   ├── buku_besar.php
│   ├── laba_rugi.php
│   ├── neraca.php
│   └── ganti_password.php
│
├── cek_login.php
├── koneksi.php
├── index.php
└── README.md
```

---

## ⚙️ Cara Instalasi (Lokal / Offline)

### 1. Persiapan Server
- Install **XAMPP**
- Jalankan **Apache** dan **MySQL**

### 2. Import Database
1. Buka browser:
   http://localhost/phpmyadmin

2. Buat database baru:
   keuangan_desa

3. Klik menu **Import**

4. Pilih file:
   keuangan_desa.sql

5. Klik **Go**

---

### 3. Pasang File Website
1. Salin folder proyek ke:
   C:\xampp\htdocs\Keuangan_Desa

2. Buka browser:
   http://localhost/Keuangan_Desa

---

## 🔑 Akun Login Default

Akun awal:
- **Username**: admin@selokarto
- **Password**: pecalungan_selokarto

> Password sudah disimpan dalam bentuk hash dan dapat diubah melalui menu **Ganti Password**.

---

## 🧾 Alur Penggunaan Aplikasi

1. Login sebagai Admin
2. Kelola **Chart of Account (COA)**
3. Input **Jurnal Umum**
   - Total debit harus sama dengan total kredit
4. Sistem otomatis:
   - Mengisi Buku Besar
   - Menghitung Laba Rugi
   - Menyusun Neraca

---

## 👨‍💻 Pengembang

**Andhika Muhammad Naufal**  
Mahasiswa KKN Universitas Diponegoro  

Dikembangkan untuk:  
**Desa Selokarto**

---
