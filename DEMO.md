# Skenario Demo

## 1. Login sebagai petugas/admin

### Akun Demo

| Email | Password | Role |
|---|---|---|
| `admin@pens.ac.id` | `password` | admin |
| `petugas1@pens.ac.id` | `password` | petugas |
| `petugas2@pens.ac.id` | `password` | petugas |

1. Buka browser dan arahkan ke `http://127.0.0.1:8000`.
2. Pengguna yang belum login akan diarahkan ke halaman `/login`.
3. Masukkan kredensial yang salah untuk melihat pesan validasi "Email atau password salah".
4. Masukkan kredensial admin:
   - **Email:** `admin@pens.ac.id`
   - **Password:** `password`
5. Klik **Login**.
6. Login berhasil. Pengguna diarahkan ke Dashboard, pesan sukses ditampilkan, dan nama admin muncul di navbar.

---

## 2. Tampilkan dashboard statistik

1. Di halaman utama `/` (Dashboard), tunjukkan 3 kartu statistik ringkasan perpustakaan:
   - **Total Buku:** 20
   - **Total Anggota:** 15
   - **Peminjaman Aktif:** (sesuai transaksi berstatus *dipinjam*)
2. Statistik diambil `DashboardController` dari `Http::get()` ke endpoint `GET /api/stats` menggunakan Laravel HTTP Client, bukan dari query langsung ke Database.
3. Tunjukkan tombol **Lihat Laporan Peminjaman** yang mengarah ke `/loans/report`.

---

## 3. Tambah kategori baru

1. Klik menu **Kategori** di navbar (`/categories`).
2. Tunjukkan daftar kategori yang sudah ada (`Novel`, `Komik`, `Sains`, `Teknologi`, `Sejarah`).
3. Klik tombol **Tambah Kategori**:
   - **Nama Kategori:** `Fiksi`
   - **Deskripsi:** `Buku tentang peristiwa khalayan atau tidak benar benar terjadi`
4. Klik **Simpan**.
5. Kategori baru muncul di tabel dan pesan sukses ditampilkan.
6. Tunjukkan bahwa menu Kategori hanya tersedia untuk pengguna dengan role `admin` dan dilindungi middleware `CheckAdminRole`.

---

## 4. Tambah buku dengan kategori
Buka `/books`, tambah 1 buku baru dengan memilih kategori dari dropdown (termasuk kategori yang baru dibuat di langkah 3), tunjukkan data tersimpan dengan nama kategori tampil benar (bukan `category_id` mentah).

1. Klik menu **Buku** di navbar (`/books`).
2. Klik tombol **Tambah Buku**:
   - **Judul:** `Bumi`
   - **Penulis:** `Tere Liye`
   - **Penerbit:** `Gramedia`
   - **Tahun Terbit:** `2000`
   - **ISBN:** `123456789`
   - **Stok:** `90`
   - **Kategori:** Pilih `Fiksi` *#(kategori "fiksi" adalah kategori yang dibuat di langkah ke 3)*
3. Klik **Simpan**.
4. Buku baru muncul di daftar dengan stok yang dimasukkan.

---

## 5. Tambah anggota baru

1. Klik menu **Anggota** di navbar (`/members`).
2. Klik **Tambah Anggota**:
   - **Nama:** `Zulman Wahid Labora`
   - **NIM:** `3125600018`
   - **Email:** `zulmanwahid@pens.ac.id`
   - **Nomor Telepon:** `082162358920`
   - **Alamat:** `Surabaya`
   - **Status:** `aktif`
3. Klik **Simpan**.
4. Anggota baru muncul di daftar.
5. Tunjukkan ketika menambah anggota dengan `nim`/`email` yang sama dengan anggota yang telah terdaftar, maka akan error, karena `nim`/`email` bersifak unik

---

## 6. Buat transaksi peminjaman

1. Klik menu **Peminjaman** di navbar (`/loans`).
2. Klik tombol **Tambah Peminjaman** (`/loans/create`).
3. Isi form peminjaman:
   - **Anggota:** Pilih `Zulman Wahid Labora`
   - **Petugas:** *terisi otomatis dari sesi login*
   - **Tanggal Pinjam:** (Tanggal hari ini, misal `2026-11-5`)
   - **Tanggal Kembali:** (7 hari ke depan yaitu `2026-11-12`)
   - **Pilih Buku:** Pilih 2 buku sekaligus (checkbox / multi-select).
4. Klik **Simpan Peminjaman**.
5. Peminjaman tercatat dengan admin yang sedang login sebagai petugas pencatat.

---

## 7. Lihat daftar peminjaman aktif
Buka `/loans`, tunjukkan transaksi baru tampil dengan status `dipinjam`, lengkap dengan nama anggota, petugas, dan daftar buku (hasil eager loading relasi, bukan ID mentah).

1. Pada tabel Peminjaman `/loans`, tunjukkan transaksi baru yang dibuat.
2. Status transaksi ditampilkan sebagai **Dipinjam**.
3. Klik tombol **Detail** pada transaksi untuk melihat rincian anggota, petugas pencatat, dan daftar buku yang dipinjam.

---

## 8. Proses pengembalian buku
Proses pengembalian transaksi yang baru dibuat di langkah 6 — lewat halaman web kalau Tugas P7 sudah dikerjakan, atau lewat `PUT /api/loans/{id}/kembalikan` di Postman kalau belum (lihat [Sebelum Demo](#sebelum-demo)). Tunjukkan status berubah jadi `dikembalikan`.

1. Pada daftar transaksi peminjaman aktif yang baru dibuat sebelumnya, klik tombol **edit**, lalu klik tombol **kembalikan**.
2. Periksa hasil pengembalian:
   - Status peminjaman berubah menjadi **Dikembalikan**.
   - Angka peminjaman aktif di Dashboard berkurang secara otomatis.

---

## 9. Tampilkan halaman laporan
Buka `/loans/report`, tunjukkan seluruh transaksi (termasuk yang baru saja diproses) tampil lengkap, dan jelaskan singkat bahwa data ini diambil dari `GET /api/loans`, bukan query Eloquent langsung dari Controller web.

1. Klik menu **Laporan** di navbar (`/loans/report`).
2. Data tabel diambil `LoanController@report` melalui HTTP request ke endpoint `GET /api/loans`bukan query Eloquent langsung dari Controller web.

---

## 10. Demo API di Postman
Jalankan langsung di Postman:
1. buka postman
2. Set Variable Collection *app-perpustakaan*, `base URL` `http://127.0.0.1:8000/api`
3. Set header `Accept` `application/JSON`
4. jalankan `GET {{base_url}}/books`
5. tunjukkan response JSON terstruktur dan pagination
6. jalankan `GET {{base_url}}/stats`
7. tunjukkan response `total_buku`, `total_anggota`, `peminjaman_aktif` sesuai data terkini.
