# Sistem Manajemen Sewa Ruangan

Aplikasi web sederhana untuk mengelola penyewaan ruangan yang dibuat untuk **Tugas Mata Kuliah Basis Data Lanjut (BDL)**.

## 📋 Deskripsi

Aplikasi ini memungkinkan admin untuk mengelola data ruangan, penyewa, dan transaksi penyewaan ruangan dengan antarmuka yang clean dan modern menggunakan Tailwind CSS.

## ✨ Fitur Utama

- **Autentikasi Admin** - Login dengan username dan password (SHA-256 hashing)
- **Kelola Ruangan** - CRUD data ruangan yang tersedia
- **Kelola Penyewa** - CRUD data penyewa/client
- **Kelola Penyewaan** - Mencatat transaksi penyewaan dengan detail:
  - Ruangan yang disewa
  - Penyewa yang menyewa
  - Tanggal mulai dan selesai
  - Keterangan tambahan

## 🗂️ Struktur Folder

```
rentalBDL/
├── auth/              # Autentikasi (login, logout)
├── views/             # Halaman tampilan utama
├── actions/           # Proses CRUD (add, edit, delete)
├── config/            # Konfigurasi database
├── partials/          # Komponen reusable (header, footer)
└── setup_database.sql # Script setup database
```

## 🛠️ Teknologi

- **Backend:** PHP 8.2+
- **Database:** MySQL
- **Frontend:** HTML, Tailwind CSS (via CDN)
- **Server:** PHP Built-in Server / XAMPP

## 📦 Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/kurokana/Sewa-Ruangan.git
   cd Sewa-Ruangan
   ```

2. **Setup Database**
   - Buka phpMyAdmin atau MySQL client
   - Import file `setup_database.sql`
   - Database `rental` akan otomatis terbuat beserta tabel-tabelnya

3. **Konfigurasi Database**
   - Edit `config/db.php` jika perlu (default: localhost, root, no password)

4. **Jalankan Server**
   ```bash
   php -S localhost:8000
   ```

5. **Akses Aplikasi**
   - Buka browser: `http://localhost:8000`
   - Login default:
     - Username: `admin`
     - Password: `admin123`

## 🗄️ Database Schema

### Tabel `owner`
- `id` (PK)
- `username`
- `password` (SHA-256)

### Tabel `ruangan`
- `id_ruangan` (PK)
- `nama_ruangan`

### Tabel `penyewa`
- `id_penyewa` (PK)
- `nama_penyewa`

### Tabel `penyewaan`
- `id_penyewaan` (PK)
- `id_ruangan` (FK → ruangan)
- `id_penyewa` (FK → penyewa)
- `tanggal_mulai`
- `tanggal_selesai`
- `keterangan`

## 📝 Normalisasi Database

Database ini telah menerapkan **Second Normal Form (2NF)** dengan karakteristik:

### ✅ Memenuhi First Normal Form (1NF)
- Setiap kolom berisi nilai atomik (tidak ada array/list dalam satu kolom)
- Tidak ada duplikasi baris
- Setiap tabel memiliki primary key yang unik

### ✅ Memenuhi Second Normal Form (2NF)
- **Semua syarat 1NF terpenuhi**
- **Tidak ada partial dependency** - Semua tabel menggunakan primary key tunggal (single column), bukan primary key komposit, sehingga tidak mungkin terjadi ketergantungan parsial pada sebagian primary key
- **Setiap atribut non-key bergantung penuh** pada primary key masing-masing tabel

### Penjelasan Per Tabel:
- **Tabel `owner`, `ruangan`, `penyewa`**: Menggunakan PK tunggal (`id`, `id_ruangan`, `id_penyewa`) dengan atribut yang bergantung langsung pada PK tersebut
- **Tabel `penyewaan`**: Menggunakan PK tunggal (`id_penyewaan`) dan foreign key (`id_ruangan`, `id_penyewa`) untuk menjaga referential integrity, menghindari redundansi data

Database sudah terstruktur dengan baik dan memenuhi standar normalisasi hingga 2NF untuk menghindari anomali insert, update, dan delete.

## 👨‍💻 Dibuat Oleh

Tugas Basis Data Lanjut (BDL) - 2025

## 📄 Lisensi

Dibuat untuk keperluan akademik/pembelajaran.
