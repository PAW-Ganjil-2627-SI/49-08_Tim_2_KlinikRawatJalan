# Sistem Informasi Klinik Rawat Jalan

Repository kelompok Tugas Besar mata kuliah **Pengembangan Aplikasi Website (PAW)** — Program Studi S1 Sistem Informasi.

## Identitas Kelompok
- **Kelas:** SI-49-08
- **Kelompok:** Tim 2 (SK02 — Klinik Rawat Jalan)
- **Organisasi:** `PAW-Ganjil-2627-SI`

## Anggota Tim & Pembagian Modul
Setiap anggota mengelola satu sub-sistem otonom yang terintegrasi dalam satu aplikasi Laravel:

| Peran | Nama Mahasiswa | Modul | Fokus Pengelolaan | Route Utama |
| :--- | :--- | :--- | :--- | :--- |
| **Individu A** | Muhamad Gaizka Prawira Darmawan | Manajemen Pasien | Profil pasien, nomor rekam medis dasar, domisili, dan kontak darurat | `/pasiens` |
| **Individu B** | Muhammad Nabil Asyraf | Dokter & Medis | Data master dokter, nomor SIP, spesialisasi, ruangan, kontak, dan foto | `/dokters` |
| **Individu C** | Najwan Arkaan Setiawan | Katalog Farmasi | Master data obat, kategori, sediaan, pabrikan, harga, dan stok | `/obats` |
| **Individu D** | Vladien Oscardo Fajarai | Ruang Poliklinik | Master ruangan poli, lokasi gedung, dan inventaris alat medis | `/polikliniks` |

## Fitur Utama
- **Autentikasi Terpusat:** Login dan Logout berbasis `username` dilengkapi middleware `guest`, `auth`, dan pembatasan percobaan login (`throttle:20,1`).
- **Role-Based Authorization (`RoleMiddleware`):**
  - **`admin`:** Akses penuh (Lihat, Detail, Tambah, Edit, dan Hapus data pada seluruh modul).
  - **`user`:** Hanya dapat melihat daftar dan detail data; percobaan akses langsung ke rute pengelolaan admin akan diblokir dengan halaman **HTTP 403 Forbidden**.
- **Dashboard & Navigasi Terintegrasi:** Layout bersama berbasis Bootstrap 5 yang menghubungkan keempat modul dalam satu antarmuka.
- **Database Migration & Seeder:** Pembentukan tabel seluruh modul serta akun bawaan secara otomatis tanpa import SQL manual.

## Teknologi yang Digunakan
- **Backend:** PHP 8.3+ & Laravel 13
- **Frontend:** Blade Templating & Bootstrap 5.3
- **Database:** MySQL (`db_klinik`)

## Akun Demo (Seeder)
| Role | Username | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `password` | CRUD Penuh (Semua Modul) |
| **User** | `user` | `password` | Read-Only (Lihat Data & Detail) |

## Cara Menjalankan di Lokal
1. Clone repository ini:
   ```bash
   git clone [https://github.com/PAW-Ganjil-2627-SI/49-08_Tim_2_KlinikRawatJalan.git](https://github.com/PAW-Ganjil-2627-SI/49-08_Tim_2_KlinikRawatJalan.git)
   cd 49-08_Tim_2_KlinikRawatJalan
   ```
2. Install seluruh dependensi Laravel:
   ```bash
   composer install
   ```
3. Salin file `.env.example` menjadi `.env`:
   ```bash
   copy .env.example .env
   ```
   *(Pengguna Mac/Linux gunakan `cp .env.example .env`)*
4. Buat database kosong bernama **`db_klinik`** di phpMyAdmin (sesuaikan `DB_USERNAME` dan `DB_PASSWORD` pada `.env` jika berbeda).
5. Generate application key, jalankan migrasi beserta seeder, buat storage link (untuk tampilan foto dokter), dan nyalakan server:
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan storage:link
   php artisan serve
   ```
6. Buka aplikasi di browser pada alamat `http://127.0.0.1:8000` lalu login menggunakan akun demo di atas.
