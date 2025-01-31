# Lapor Kampus

**Lapor Kampus** adalah sistem aplikasi berbasis website yang dirancang untuk mempermudah mahasiswa dalam menyampaikan pengaduan terkait permasalahan kampus. Dengan aplikasi ini, mahasiswa dapat melaporkan berbagai isu akademik, fasilitas, hingga permasalahan administratif secara transparan dan efisien.

## Fitur Utama
- **Pelaporan Mudah**: Mahasiswa dapat mengajukan laporan dengan cepat. 
- **Melihat Laporan Lain**: Mahasiswa bisa melihat semua laporan dari mahasiswa lain di kampus yang sama.
- **Manajemen Laporan**: Admin dapat mengelola, dan memantau berbagai data terkait aplikasi.
- **Dashboard Untuk Petugas**: Dashboard untuk petugas juga telah disediakan guna mempermudah mereka untuk menangani laporan yang ada.
- **Status Laporan**: Pengguna dapat melihat pembaruan terkait status laporan mereka.

## Teknologi yang Digunakan
Aplikasi ini dibangun menggunakan **Laravel 11** dan **Filament Admin**, yang memberikan pengalaman pengguna yang cepat, aman, dan modern.

## Instalasi
### Persyaratan
- PHP **8.2** atau lebih baru
- Composer
- Node.js dan NPM (untuk Vite)
- Database (MySQL, PostgreSQL, atau SQLite)

### Langkah Instalasi
1. **Clone repositori**:
   ```bash
   git clone https://github.com/username/sistenm_pengaduan_mahasiswa.git
   cd sistem_pengaduan_mahasiswa
   ```
2. **Instal dependensi**:
   ```bash
   composer install
   npm install
   ```
3. **Konfigurasi lingkungan**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Atur database**:
   - Sesuaikan konfigurasi database di file `.env`
   - Jalankan migrasi:
     ```bash
     php artisan migrate
     ```
5. **Jalankan server**:
   ```bash
   php artisan serve
   ```
   Untuk menjalankan Vite:
   ```bash
   npm run dev
   ```
6. **Akses aplikasi** di [http://localhost:8000](http://localhost:8000)

## Kontribusi
Kami terbuka untuk kontribusi! Jika Anda ingin menambahkan fitur atau memperbaiki bug, silakan buat _pull request_ atau ajukan _issue_ di repositori ini.


