# PERPUSTAKAAN DIGITAL KAMPUS (PENS BACA)

Sebuah aplikasi Sistem Perpustakaan Digital Kampus yang dikelola petugas/admin untuk mengelola buku, anggota, dan transaksi peminjaman. Aplikasi ini dibuat untuk memudahkan pengelolaan ataupun manajemen di dalam suatu perpustakaan sehingga lebih efisien, aman, dan terstruktur.

Aplikasi ini dijalankan secara lokal, data tersimpan pada komputer pribadi/lokal dengan menggunakan lokal database dan juga serverhost lokal. Aplikasi ini dibuat menggunakan framework laravel agar lebih efisien dan memudahkan dalam pembuatan aplikasi.

## Perbedaan Model, View, dan Controller
MVC adalah pola arsitektur perangkat lunak yang memisahkan aplikasi menjadi tiga komponen utama: data/logika bisnis (Model), antarmuka pengguna (View), dan penghubung alur data (Controller).

Model -> bagian Mengelola data, aturan bisnis, dan relasi tabel database
View -> Menampilkan antarmuka (UI) kepada pengguna
Controller -> Menerima request, memproses logika, dan menghubungkan Model ke View



## 1. Clone Repository & Masuk ke Direktori Proyek

Buka terminal (Git Bash, PowerShell, atau CMD), arahkan ke direktori kerja , lalu lakukan *clone* repositori:

```bash
git clone https://github.com/Oxadew/<nama-repository>.git
cd <nama-repository>
```
> **Catatan:** Ganti `<nama-repository>` sesuai dengan nama repositori proyek .

---

## 2. Install Dependency

Unduh seluruh paket PHP yang dibutuhkan oleh Laravel menggunakan Composer:

```bash
composer install
```

---

## 3. Setup File `.env` & Konfigurasi API Internal

Buka file `.env`, lalu sesuaikan konfigurasi **Database PostgreSQL** dan **Internal API URL** agar controller Dashboard dan generator Laporan dapat berkomunikasi dengan layanan REST API di port terpisah:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:ma1jZfmhBV80SjPFANSyQ+tTa/G3i++sgXf057m7BQs=
APP_DEBUG=true
APP_URL=http://localhost
# Konfigurasi URL API Internal 
INTERNAL_API_URL=http://127.0.0.1:8011

# Konfigurasi Seeder Data awal menggunakan area Id bukan US
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=id_ID

# Konfigurasi Database PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=db-perpustakaan
DB_USERNAME=postgres
DB_PASSWORD=12345

```

---

## 4. Migrate & Seed Database

Jalankan perintah migrasi untuk membuat seluruh struktur tabel sekaligus mengisi data awal (*seeder* akun pengguna dan data contoh):

```bash
php artisan migrate --seed
```

*Jika perlu mengulang struktur database dari awal dan menghapus seluruh tabel lama, jalankan: `php artisan migrate:fresh --seed`. sehingga isi database akan di reset kembali dari data awal seeder*

---

## 5. Menjalankan Dua Server Secara Bersamaan

Karena *built-in development server* milik PHP (`php artisan serve`) bersifat *single-threaded* (model eksekusi program yang hanya menggunakan satu jalur eksekusi (thread) dan memproses instruksi satu per satu secara berurutan), aplikasi akan mengalami *deadlock* atau *timeout* apabila server di port `8000` melakukan HTTP request ke port dirinya sendiri saat memuat halaman Dashboard maupun Laporan.

Oleh karena itu,  **wajib menjalankan dua instance server pada dua jendela terminal yang terpisah**:

### Terminal 1 — Server Utama (Frontend Web & Blade Views)
```bash
php artisan serve --port=8000
```

### Terminal 2 — Server Internal API (Endpoint Data Dashboard & Laporan)
```bash
php artisan serve --port=8011
```

---

## 6. Akses Aplikasi

Setelah kedua server di atas berstatus *running* tanpa error:
1. Buka browser.
2. Kunjungi alamat **`http://127.0.0.1:8000`**.
3. Seluruh permintaan data pada halaman **Dashboard** dan **Laporan** akan diteruskan secara otomatis ke `http://127.0.0.1:8011/api`.