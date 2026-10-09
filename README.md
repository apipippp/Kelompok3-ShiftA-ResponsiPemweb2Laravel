# 👕 Lemari Peduli
> Platform Donasi Pakaian Bekas Layak Pakai Berkelanjutan Berbasis Laravel & RESTful API Sanctum

---

## 📌 Informasi Kelompok
- **Nomor Kelompok:** Kelompok 03
- **Shift Praktikum:** Shift A
- **Nama Repositori:** `Kelompok3-ShiftA-ResponsiPemweb2Laravel`

---

## 👥 Anggota Kelompok

| No | Nama Lengkap | NIM | Shift Awal | Shift Akhir | Jobdesk / Kontribusi | Link Video Penjelasan |
|:---:|:---|:---:|:---:|:---:|:---|:---:|
| 1 | **Afif Nur Rahman** *(Lead)* | H1H024016 | Shift C | Shift A | Modul Donasi Pakaian, RESTful API Laravel, Autentikasi Laravel Sanctum, dan Otorisasi RBAC | [YouTube/Drive](https://...) |
| 2 | **Nurul Maftuhah** | H1H024002 | Shift A | Shift A | Modul Titik Posko (*Drop-Off*), Katalog Posko Wilayah, dan Integrasi Peta Lokasi | (https://youtu.be/TFFeUvHpUVo) |
| 3 | **Muhammad Faizal Khabibi** | H1H024003 | Shift A | Shift A | Modul Laporan Penyaluran Bantuan, Dashboard Metrik Statistik, dan Landing Page Beranda | [YouTube/Drive](https://...) |

---

## 📖 Deskripsi Aplikasi

### Latar Belakang & Permasalahan
Limbah tekstil menjadi salah satu penyumbang pencemaran lingkungan yang berkembang pesat. Di sisi lain, banyak masyarakat prasejahtera, korban bencana alam, dan panti asuhan yang sangat membutuhkan pakaian bersih dan layak pakai. Banyak orang memiliki pakaian menumpuk di lemari yang masih bagus tetapi tidak tahu ke mana dan bagaimana cara menyalurkannya secara amanah dan transparan.

### Solusi yang Ditawarkan
**Lemari Peduli** adalah platform sosial terpadu yang memfasilitasi masyarakat untuk:
1. Mendonasikan pakaian bekas layak pakai secara online lengkap dengan nomor resi unik (*tracking code*).
2. Menemukan titik posko fisik (*drop-off points*) terdekat di kotanya untuk menyerahkan pakaian.
3. Melacak perjalanan pakaian yang disumbangkan mulai dari tahap verifikasi, diterima di posko, hingga dibagikan ke penerima manfaat.
4. Mempublikasikan dokumentasi dan foto serah terima bantuan secara transparan demi akuntabilitas sosial.

---

## ⚙️ Penjelasan Teknis

### 1. Teknologi (Tech Stack)
- **Backend:** Laravel 11/12 (PHP 8.4+)
- **RESTful API & Security:** Laravel Sanctum (Bearer Token Authorization)
- **Frontend:** Blade, Tailwind CSS, Alpine.js, JavaScript
- **Database:** MySQL / MariaDB (Driver InnoDB)
- **Paket / Library:** Laravel Breeze, Laravel Sanctum, Vite

### 2. Fitur Utama & Modul Bisnis
- **Autentikasi & Otorisasi (RBAC):**
  - Pemisahan hak akses menggunakan Middleware `IsAdmin` dan guard Sanctum.
  - Role `admin`: verifikasi donasi, kelola data posko, catat penyaluran bantuan.
  - Role `donatur`: ajukan pakaian, lacak tiket donasi, cetak label paket.
- **Modul Donasi Pakaian (Afif Nur Rahman):**
  - CRUD pengajuan pakaian, upload foto (maks. 2MB), generator kode resi `DON-YYYYMMDD-XXXX`.
  - Panel 1-klik verifikasi admin (`menunggu` $\rightarrow$ `diverifikasi` $\rightarrow$ `diterima` $\rightarrow$ `disalurkan`).
  - Halaman cetak label resi siap print untuk ditempel pada kardus paket pakaian.
- **Modul Titik Posko Drop-Off (Nurul Maftuhah):**
  - CRUD posko pengumpulan bagi admin, katalog posko interaktif, filter kota, dan tautan WhatsApp PIC.
- **Modul Penyaluran & Dashboard (Muhammad Faizal Khabibi):**
  - CRUD dokumentasi penyerahan bantuan pakaian ke panti/korban bencana lengkap dengan upload foto.
  - Dashboard statistik agregat (total pakaian masuk, tersalurkan, kegiatan, dan posko aktif).
  - Landing page publik informatif berstandar UI resmi (*Dark Green, Sage, Cream, Warm Brown*).

### 3. Skema Data & Relasi Eloquent
Aplikasi memiliki minimal 2 jenis relasi yang relevan:
1. **One-to-Many ($1 : N$):**
   - `users` (1 : N) `donations` (Setiap akun user dapat memiliki banyak pengajuan donasi).
   - `drop_points` (1 : N) `donations` (Setiap posko drop-off dapat menerima banyak paket donasi).
2. **One-to-One ($1 : 1$):**
   - `donations` (1 : 1) `distributions` (Satu donasi yang disalurkan dapat terhubung secara spesifik ke 1 pencatatan dokumentasi penyaluran bantuan).

---

## 📡 Dokumentasi RESTful API (Sanctum Token)

Backend Lemari Peduli menyediakan RESTful API lengkap dengan validasi **Form Request**, transformasi **API Resource**, **Pagination**, **Filtering**, dan status kode HTTP standar:

### 1. Autentikasi & Akun
| Method | Endpoint | Keterangan | Auth (Sanctum) |
|:---:|:---|:---|:---:|
| `POST` | `/api/register` | Mendaftarkan akun donatur baru & mendapatkan Bearer Token | No |
| `POST` | `/api/login` | Login user (Admin / Donatur) & mendapatkan Bearer Token | No |
| `POST` | `/api/logout` | Menghapus token aktif yang sedang digunakan | Yes (Bearer Token) |
| `GET` | `/api/user` | Mendapatkan data profil akun yang sedang login | Yes (Bearer Token) |

### 2. Modul Donasi Pakaian (Afif)
| Method | Endpoint | Keterangan | Auth (Sanctum) |
|:---:|:---|:---|:---:|
| `GET` | `/api/donations` | Mengambil daftar donasi (Pagination & filter `?status=...&search=...`) | Yes (Bearer Token) |
| `POST` | `/api/donations` | Mengajukan donasi pakaian baru (Form Request validation) | Yes (Bearer Token) |
| `GET` | `/api/donations/{id}` | Mengambil detail lengkap donasi dan relasinya | Yes (Bearer Token) |
| `PUT` | `/api/donations/{id}` | Memperbarui data donasi pending (Form Request validation) | Yes (Bearer Token) |
| `DELETE` | `/api/donations/{id}` | Membatalkan / menghapus data donasi | Yes (Bearer Token) |
| `PATCH` | `/api/donations/{id}/status` | Mengubah status verifikasi donasi (`diverifikasi`, `diterima`, `disalurkan`) | Yes (Khusus Admin) |
| `GET` | `/api/tracking/{code}` | Melacak perjalanan donasi secara publik via kode resi | No |

### 3. Modul Titik Posko Drop-Off (Nurul)
| Method | Endpoint | Keterangan | Auth (Sanctum) |
|:---:|:---|:---|:---:|
| `GET` | `/api/drop-points` | Mengambil daftar titik posko (Filter `?city=...&search=...`) | No |
| `GET` | `/api/drop-points/{id}` | Mengambil detail lengkap posko | No |
| `POST` | `/api/drop-points` | Menambah posko baru | Yes (Khusus Admin) |
| `PUT` | `/api/drop-points/{id}` | Memperbarui informasi posko | Yes (Khusus Admin) |
| `DELETE` | `/api/drop-points/{id}` | Menghapus posko | Yes (Khusus Admin) |

### 4. Modul Penyaluran Bantuan (Faizal)
| Method | Endpoint | Keterangan | Auth (Sanctum) |
|:---:|:---|:---|:---:|
| `GET` | `/api/distributions` | Mengambil laporan dokumentasi penyaluran publik (Pagination) | No |
| `GET` | `/api/distributions/{id}` | Mengambil detail dokumentasi penyaluran | No |
| `POST` | `/api/distributions` | Mencatat serah terima bantuan & upload foto bukti | Yes (Khusus Admin) |
| `PUT` | `/api/distributions/{id}` | Mengubah catatan penyaluran | Yes (Khusus Admin) |
| `DELETE` | `/api/distributions/{id}` | Menghapus catatan penyaluran | Yes (Khusus Admin) |

---

## 🚀 Panduan Instalasi Lokal

```bash
# 1. Clone repository
git clone https://github.com/apipippp/Kelompok3-ShiftA-ResponsiPemweb2Laravel.git
cd Kelompok3-ShiftA-ResponsiPemweb2Laravel

# 2. Install dependensi PHP & Node.js
composer install
npm install

# 3. Konfigurasi Environment (.env)
cp .env.example .env
php artisan key:generate
php artisan storage:link

# 4. Atur database di file .env:
#    DB_CONNECTION=mysql
#    DB_DATABASE=lemari_peduli
#    DB_USERNAME=root
#    DB_PASSWORD=

# 5. Jalankan migrasi dan seeder akun otomatis
php artisan migrate:fresh --seed

# 6. Jalankan development server
php artisan serve
npm run dev
```

---

## 🔑 Akun Uji Coba (Seeder Default)

| Role Akun | Email | Password | Wewenang & Akses |
|:---|:---|:---|:---|
| **Administrator** | `admin@lemaripeduli.com` | `password` | Mengelola data seluruh posko, verifikasi donasi, mencatat penyaluran, dan melihat metrik sistem. |
| **Donatur** | `donatur@lemaripeduli.com` | `password` | Mengajukan donasi baju, mencetak label paket, melacak tiket resi, dan melihat riwayat sendiri. |

---

## 🌐 Link Deployment Live

Website telah aktif dan dapat diakses langsung oleh dosen / asisten praktikum melalui internet:
* **URL Utama:** **[https://a3.athafa.cloud](https://a3.athafa.cloud)** (atau `http://a3.athafa.cloud`)
* **Repositori GitHub:** **[https://github.com/apipippp/Kelompok3-ShiftA-ResponsiPemweb2Laravel](https://github.com/apipippp/Kelompok3-ShiftA-ResponsiPemweb2Laravel)**
