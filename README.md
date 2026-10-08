# 👕 Lemari Peduli - Web Donasi Pakaian Bekas Layak Pakai

Platform berbasis web untuk memfasilitasi masyarakat dalam mendonasikan pakaian layak pakai, mencari titik posko pengumpulan (*drop-off points*), serta memantau transparansi penyaluran bantuan kepada yang membutuhkan.

Proyek ini dikembangkan oleh **Tim 3 (Shift A)** untuk memenuhi tugas akhir Praktikum Pemrograman Web II.

---

## 🧭 Prinsip Utama: "Bebas Berkreasi Tanpa Saling Ganggu"

Agar setiap anggota bisa bebas mendesain UI, menambah logika, dan mengeksplorasi ide tanpa takut merusak kodingan teman lain, proyek ini menerapkan pemisahan file secara tegas:

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                       ZONA KERJA MANDIRI (100% BEBAS)                       │
├──────────────────────┬──────────────────────┬───────────────────────────────┤
│   AFIF NUR RAHMAN    │    NURUL MAFTUHAH    │    M. FAIZAL KHABIBI          │
│                      │                      │                               │
│ • DonationController │ • DropPointController│ • DistributionController      │
│ • Model Donation     │ • Model DropPoint    │ • Model Distribution          │
│ • views/donations/*  │ • views/drop_points/*│ • views/distributions/*       │
│ • migration donations│ • migration drop_pts │ • views/welcome.blade.php     │
│ • IsAdmin Middleware │                      │ • Dashboard Analytics/Statistik│
│ • UserSeeder (RBAC)  │                      │                               │
└──────────────────────┴──────────────────────┴───────────────────────────────┘
                                       │
                                       ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│                    ZONA BERSAMA (IKUTI ATURAN TAMBAH BARIS)                  │
├─────────────────────────────────────────────────────────────────────────────┤
│ 1. routes/web.php              --> Cukup tambah 1-2 baris rute sendiri      │
│ 2. layouts/navigation.blade.php--> Cukup selipkan 1 link menu navbar        │
│ 3. database/seeders/DatabaseSeeder.php --> Panggil seeder masing-masing     │
└─────────────────────────────────────────────────────────────────────────────┘
```

---

## 👥 Detail Pembagian Tugas & Tanggung Jawab

| NIM | Nama | Modul Utama | Tanggung Jawab & Fitur | Branch Git |
| :--- | :--- | :--- | :--- | :--- |
| **H1H024016** | **Afif Nur Rahman** *(Lead)* | **Donasi Pakaian & RBAC** | • Inisiasi Project Laravel & Breeze<br>• Setup RBAC (Middleware `IsAdmin` & UserSeeder)<br>• CRUD Pengajuan Donasi Baju<br>• Upload foto pakaian & tracking tiket donasi | `feat/donasi-afif` |
| **H1H024002** | **Nurul Maftuhah** | **Posko Drop-Off** | • CRUD Titik Posko Pengumpulan Baju<br>• Informasi alamat, kontak PIC, jam operasional<br>• Tampilan katalog posko untuk donatur publik<br>• Upload foto posko / integrasi Google Maps | `feat/posko-nurul` |
| **H1H024003** | **Muhammad Faizal Khabibi** | **Penyaluran, Dashboard & Landing Page** | • CRUD Laporan Penyaluran Bantuan<br>• Upload foto bukti penyerahan ke penerima<br>• Desain Landing Page Publik (`welcome.blade.php`)<br>• Dashboard Ringkasan Admin (Rekapitulasi data & statistik) | `feat/penyaluran-faizal` |

---

## 🎨 Standar Desain UI & Palet Warna (Color Palette)

Agar seluruh tampilan web seragam dan estetis (bertema ramah lingkungan & sosial), gunakan standar warna berikut yang **sudah terkonfigurasi di `tailwind.config.js`**:

| Preview | Nama Warna | Kode Hex | Class Tailwind | Panduan & Peran Desain |
| :---: | :--- | :--- | :--- | :--- |
| 🟢 | **Dark Green** | `#355834` | `bg-dark-green`, `text-dark-green` | **Warna Utama**: Header, navbar, teks judul, tombol utama (*Primary Button*). |
| 🌿 | **Sage Green** | `#7BAE7F` | `bg-sage`, `text-sage`, `border-sage` | **Warna Pendukung**: Tombol sekunder, hover state, badge aktif, card border. |
| 🌾 | **Cream** | `#F8F4E8` | `bg-cream`, `text-cream` | **Background Utama**: Warna latar belakang halaman/web agar tidak silau. |
| 🪵 | **Warm Brown** | `#8B6F47` | `bg-warm-brown`, `text-warm-brown` | **Aksen Hangat**: Label kategori, footer, garis aksen, badge info posko. |
| ⚪ | **White** | `#FFFFFF` | `bg-white`, `text-white` | **Latar Konten**: Background kartu (*card*), modal box, input form, teks tombol gelap. |

### Contoh Penggunaan Class Tailwind di Blade:
```html
<!-- Background Halaman -->
<div class="min-h-screen bg-cream text-gray-800">

    <!-- Tombol Utama (Primary Button) -->
    <button class="bg-dark-green text-white px-4 py-2 rounded-lg hover:bg-sage transition">
        Donasikan Sekarang
    </button>

    <!-- Tombol Sekunder / Aksen -->
    <button class="bg-sage text-white px-4 py-2 rounded-lg hover:bg-dark-green transition">
        Lihat Posko
    </button>

    <!-- Kartu Konten (Card) -->
    <div class="bg-white rounded-xl shadow-sm border border-sage/30 p-6">
        <h3 class="text-xl font-bold text-dark-green">Nama Posko</h3>
        <p class="text-warm-brown font-medium">Banyumas, Jawa Tengah</p>
    </div>
</div>
```
---

## 📂 Bagian File, Langkah Kerja & Ruang Kreasi Per Anggota

### 1. Afif Nur Rahman — Modul Donasi Pakaian & Hak Akses (RBAC)
*Alur: Autentikasi & Otorisasi role (Admin vs Donatur) + Donatur mengisi form pengajuan donasi pakaian $\rightarrow$ dapat kode tracking $\rightarrow$ pantau status.*

* **File Milik Afif (Bebas diotak-atik):**
  - `app/Http/Middleware/IsAdmin.php` (Proteksi hak akses admin)
  - `database/seeders/UserSeeder.php` (Akun awal admin & donatur)
  - `database/migrations/xxxx_create_donations_table.php`
  - `app/Models/Donation.php`
  - `app/Http/Controllers/DonationController.php`
  - Folder `resources/views/donations/` (`index.blade.php`, `create.blade.php`, `show.blade.php`, `edit.blade.php`)

* **Langkah-Langkah Kerja Utama:**
  1. Setup awal proyek Laravel + Breeze Blade & migrasi tabel `users` dengan kolom `'role'`.
  2. Buat middleware `IsAdmin`:
     ```bash
     php artisan make:middleware IsAdmin
     ```
     Cek `$request->user()->role === 'admin'`. Daftarkan alias `'admin'` di `bootstrap/app.php`.
  3. Buat `UserSeeder` berisi akun default Admin dan Donatur, lalu panggil di `DatabaseSeeder.php`.
  4. Buat migration tabel `donations` dan jalankan `php artisan migrate`.
  5. Buat controller: `php artisan make:controller DonationController --resource`.
  6. Buat fitur `create` & `store` untuk menampung input donatur (nama, jenis pakaian, jumlah, kondisi, upload gambar).
  7. Buat fitur `show` untuk halaman tracking detail status pakaian berdasarkan kode tracking.
  8. Buat method update status donasi yang nantinya hanya bisa diakses oleh admin (`menunggu` $\rightarrow$ `diterima` $\rightarrow$ `disalurkan`).

* **Ide Kreasi Bebas yang Boleh Ditambahkan Afif:**
  - Tambahkan generate kode resi otomatis (misal: `DON-202610-001`).
  - Tambahkan tombol cetak label donasi / tanda terima (PDF/Print view) untuk ditempel di kardus paket pakaian.
  - Tambahkan preview gambar secara real-time sebelum submit donasi (menggunakan JavaScript sederhana).
---

### 2. Nurul Maftuhah — Modul Titik Posko (*Drop-Off Points*)
*Alur: Masyarakat ingin tahu ke posko mana mereka bisa mengantar atau mengirim pakaian.*

* **File Milik Nurul (Bebas diotak-atik):**
  - `database/migrations/xxxx_create_drop_points_table.php`
  - `app/Models/DropPoint.php`
  - `app/Http/Controllers/DropPointController.php`
  - Folder `resources/views/drop_points/` (`index.blade.php`, `create.blade.php`, `edit.blade.php`, `public.blade.php`)

* **Langkah-Langkah Kerja Utama:**
  1. Buat model & migration: `php artisan make:model DropPoint -mcr`.
  2. Isi kolom migration `drop_points` (nama posko, alamat, kota, kontak PIC, jam buka, foto posko, url gmaps).
  3. Buat view form tambah posko (`create.blade.php`) & form edit posko (`edit.blade.php`) khusus admin.
  4. Buat halaman daftar posko untuk admin (tabel dengan tombol Edit & Hapus).
  5. Buat halaman publik daftar posko (tampilan grid kartu posko yang rapi untuk pengunjung web/donatur).

* **Ide Kreasi Bebas yang Boleh Ditambahkan Nurul:**
  - Tambahkan tombol pintasan **"Chat WhatsApp PIC"** yang langsung membuka link `https://wa.me/nomorHP` saat diklik oleh donatur.
  - Sematkan iframe Google Maps atau tombol link langsung ke Google Maps lokasi posko.
  - Tambahkan fitur pencarian posko berdasarkan filter kota (misal: "Purwokerto", "Banyumas", dll.).

---

### 3. Muhammad Faizal Khabibi — Modul Penyaluran, Dashboard & Landing Page
*Alur: Dokumentasi pakaian yang diserahkan ke panti asuhan/bencana + perancangan Landing Page publik dan Dashboard ringkasan admin.*

* **File Milik Faizal (Bebas diotak-atik):**
  - `database/migrations/xxxx_create_distributions_table.php`
  - `app/Models/Distribution.php`
  - `app/Http/Controllers/DistributionController.php`
  - Folder `resources/views/distributions/` (`index.blade.php`, `create.blade.php`, `edit.blade.php`, `gallery.blade.php`)
  - `resources/views/welcome.blade.php` (Landing Page depan website)
  - `resources/views/dashboard.blade.php` (Dashboard ringkasan statistik admin)

* **Langkah-Langkah Kerja Utama:**
  1. Buat model, migration, dan controller penyaluran:
     ```bash
     php artisan make:model Distribution -mcr
     ```
  2. Isi kolom migration `distributions` (nama penerima bantuan, tanggal serah terima, total potong baju, foto dokumentasi, keterangan).
  3. Buat form CRUD pencatatan penyaluran bantuan pakaian ke panti/korban bencana lengkap dengan upload foto serah terima.
  4. Rancang `resources/views/welcome.blade.php` sebagai landing page utama publik yang memuat ajakan mendonasikan pakaian dan galeri foto transparansi penyaluran.
  5. Rancang halaman Dashboard Admin yang memuat kartu ringkasan statistik (contoh: total donasi masuk, total baju tersalurkan, total posko aktif).

* **Ide Kreasi Bebas yang Boleh Ditambahkan Faizal:**
  - Tambahkan galeri foto penyaluran interaktif (modal pop-up foto dokumentasi penyaluran pakaian).
  - Tampilkan kartu ringkasan total pakaian terkumpul dan total pakaian tersalurkan di landing page (menggunakan query agregat `Donation::sum('quantity')` dan `Distribution::sum('items_count')`).
  - Desain tampilan visual Dashboard Admin dengan kartu-kartu metrik yang modern.
---

## 🤝 Aturan Mengedit Zona Bersama (Agar Tidak Terjadi Konflik Kode)

Hanya ada 2 file utama yang akan disentuh bersama. Ikuti aturan penambahan ini:

### 1. File `routes/web.php`
Jangan menimpa baris milik teman. Cukup letakkan kode kalian pada blok yang telah disepakati:

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DropPointController;
use App\Http\Controllers\DistributionController;

// 1. HALAMAN PUBLIK (Bebas Diakses Siapa Saja)
Route::get('/', function () { return view('welcome'); }); // Faizal
Route::get('/posko', [DropPointController::class, 'publicIndex'])->name('posko.public'); // Nurul
Route::get('/laporan', [DistributionController::class, 'publicIndex'])->name('laporan.public'); // Faizal
Route::get('/tracking', [DonationController::class, 'trackForm'])->name('donations.track'); // Afif

// 2. HALAMAN KHUSUS USER LOGIN (Donatur & Admin)
Route::middleware(['auth'])->group(function () {
    // Afif: CRUD Donasi Pakaian Donatur
    Route::resource('donations', DonationController::class);
});

// 3. HALAMAN KHUSUS ADMIN (Dilindungi Middleware Faizal)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Nurul: Kelola Posko
    Route::resource('drop-points', DropPointController::class);

    // Faizal: Kelola Laporan Penyaluran
    Route::resource('distributions', DistributionController::class);

    // Afif: Verifikasi & Ganti Status Donasi Masuk
    Route::patch('/donations/{id}/status', [DonationController::class, 'updateStatus'])->name('donations.status');
});

require __DIR__.'/auth.php';
```

---

### 2. File `resources/views/layouts/navigation.blade.php` (Navbar)
Di bagian daftar menu navbar (`<!-- Navigation Links -->`), masing-masing anggota cukup menyisipkan **satu tag link** miliknya sendiri:

```blade
<!-- Menu Afif -->
<x-nav-link :href="route('donations.index')" :active="request()->routeIs('donations.*')">
    {{ __('Donasi Saya') }}
</x-nav-link>

<!-- Menu Nurul -->
<x-nav-link :href="route('posko.public')" :active="request()->routeIs('posko.*')">
    {{ __('Titik Posko') }}
</x-nav-link>

<!-- Menu Faizal -->
<x-nav-link :href="route('laporan.public')" :active="request()->routeIs('laporan.*')">
    {{ __('Laporan Penyaluran') }}
</x-nav-link>
```

---

## 🗄️ Spesifikasi Skema Database Lengkap

### 1. Modifikasi Tabel `users` (Oleh Afif saat inisiasi)
Lokasi: `database/migrations/0001_01_01_000000_create_users_table.php`
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('phone')->nullable();
    $table->enum('role', ['admin', 'donatur'])->default('donatur'); // <- Baris penting ini
    $table->rememberToken();
    $table->timestamps();
});
```

### 2. Tabel `donations` (Afif)
```php
Schema::create('donations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('tracking_code')->unique(); // e.g. DON-202610-0001
    $table->string('clothing_type'); // Kaos, Kemeja, Celana, Jaket, Seragam
    $table->integer('quantity'); // Jumlah (pcs)
    $table->enum('condition', ['sangat_baik', 'layak_pakai']);
    $table->string('photo')->nullable(); // Lokasi path upload foto
    $table->enum('delivery_method', ['antar_sendiri', 'ekspedisi']);
    $table->enum('status', ['menunggu', 'diterima', 'disalurkan', 'dibatalkan'])->default('menunggu');
    $table->text('notes')->nullable();
    $table->timestamps();
});
```

### 3. Tabel `drop_points` (Nurul)
```php
Schema::create('drop_points', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Nama Posko (e.g. Posko Utama GOR)
    $table->text('address'); // Alamat jalan
    $table->string('city'); // Kota/Kabupaten
    $table->string('pic_name'); // Nama penanggung jawab
    $table->string('pic_phone'); // Nomor WhatsApp PIC
    $table->string('operating_hours'); // e.g. 08.00 - 16.00 WIB
    $table->string('photo')->nullable(); // Foto posko
    $table->string('maps_url')->nullable(); // URL tautan Google Maps
    $table->timestamps();
});
```

### 4. Tabel `distributions` (Faizal)
```php
Schema::create('distributions', function (Blueprint $table) {
    $table->id();
    $table->string('recipient_name'); // Nama panti asuhan / korban bencana
    $table->date('distribution_date'); // Tanggal penyerahan
    $table->integer('items_count'); // Total potong baju yang diserahkan
    $table->string('proof_photo'); // Foto penyerahan bantuan
    $table->text('description'); // Catatan kegiatan
    $table->timestamps();
});
```

---

## 🛠️ Panduan Eksekusi Teknis

### Tahap A: Setup Awal Proyek (Khusus Afif Nur Rahman)

Jalankan perintah ini di terminal:
```bash
# 1. Buat project Laravel baru
composer create-project laravel/laravel lemari-peduli
cd lemari-peduli

# 2. Pasang Laravel Breeze Blade
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build

# 3. Hubungkan penyimpanan berkas upload (Wajib agar upload gambar tidak 404)
php artisan storage:link

# 4. Tambahkan kolom 'role' pada migrasi users (lihat skema users di atas)
# 5. Salin file README.md ini ke dalam folder root lemari-peduli/

# 6. Inisialisasi Git & Push ke GitHub
git init
git add .
git commit -m "chore: initial setup laravel breeze blade, rbac role, and readme"
git branch -M main
git remote add origin https://github.com/apipippp/PemwebII-LemariPeduli.git
git push -u origin main
```

*Setelah push berhasil, buka halaman repo di GitHub:*
- Buka **Settings** $\rightarrow$ **Collaborators** $\rightarrow$ Klik **Add people**.
- Masukkan username GitHub **Nurul** dan **Faizal**.

---

### Tahap B: Panduan Lengkap Setup di Laptop Anggota (Khusus Nurul & Faizal)

Ikuti panduan langkah demi langkah ini dari awal sampai proyek siap dijalankan di laptop kalian:

#### 1. Terima Undangan Kolaborator GitHub (Wajib Pertama Kali!)
> ⚠️ **PENTING:** Jika kalian belum klik accept invitation, kalian **TIDAK AKAN BISA** melakukan `git push` nanti (akan error *Permission denied / 403*).
1. Buka email kalian atau langsung buka browser ke alamat:
   👉 **[https://github.com/apipippp/PemwebII-LemariPeduli/invitations](https://github.com/apipippp/PemwebII-LemariPeduli/invitations)**
2. Pastikan sudah login ke akun GitHub masing-masing.
3. Klik tombol hijau **Accept invitation**.

---

#### 2. Clone Repository ke Komputer Lokal
Buka terminal (Git Bash, Command Prompt, atau Terminal VS Code) di folder tempat kalian biasa menyimpan tugas kuliah:
```bash
git clone https://github.com/apipippp/PemwebII-LemariPeduli.git
cd PemwebII-LemariPeduli
```

---

#### 3. Install Dependensi (Composer & NPM)
Karena folder `vendor` dan `node_modules` sengaja diabaikan oleh Git, kalian wajib menginstalnya di lokal:
```bash
# Install library backend Laravel
composer install

# Install library frontend & Tailwind CSS
npm install
```

---

#### 4. Konfigurasi Environment (`.env`) & Storage
1. Salin template `.env.example` menjadi file `.env`:
   ```bash
   # Di Windows (Git Bash / PowerShell / CMD):
   cp .env.example .env
   ```
2. Buat kunci keamanan aplikasi (*Application Key*):
   ```bash
   php artisan key:generate
   ```
3. Hubungkan folder publik ke storage (wajib agar gambar posko / bukti donasi bisa tampil):
   ```bash
   php artisan storage:link
   ```

---

#### 5. Siapkan Database MySQL Lokal
1. Buka aplikasi **XAMPP** atau **Laragon**, pastikan service **MySQL** sudah dinyalakan (*Start*).
2. Buka browser dan masuk ke phpMyAdmin: `http://localhost/phpmyadmin`.
3. Klik menu **Databases** / **Basis Data**, ketik nama: `lemari_peduli`, lalu klik **Create**.
4. Buka file `.env` di VS Code masing-masing, pastikan baris database sudah sesuai:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lemari_peduli
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *(Jika MySQL kalian memakai password, sesuaikan `DB_PASSWORD`)*.
5. Jalankan migrasi tabel awal:
   ```bash
   php artisan migrate
   ```

---

#### 6. Menjalankan Server Aplikasi
Buka **dua tab terminal** di VS Code pada folder proyek:
* **Terminal 1** (Server Laravel):
  ```bash
  php artisan serve
  ```
* **Terminal 2** (Compiler Frontend Vite):
  ```bash
  npm run dev
  ```
Buka browser di alamat `http://127.0.0.1:8000`. Jika halaman selamat datang Laravel dan tombol **Log in** & **Register** muncul, setup awal berhasil 100%!

---

### Tahap C: Alur Lengkap Dari Mulai Koding Sampai Nge-Push ke GitHub (Nurul & Faizal)

> ⚠️ **HUKUM UTAMA:** JANGAN PERNAH MENGETIK KODE ATAU COMMIT DI BRANCH `main`. Selalu gunakan branch fitur masing-masing agar pekerjaan kalian aman dan tidak tertimpa.

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                             ALUR SIKLUS FITUR                               │
│                                                                             │
│  1. git checkout -b feat/nama-fitur   (Buat branch baru)                    │
│  2. Koding fitur & tes di browser                                           │
│  3. git add . && git commit -m "..." (Simpan progres)                       │
│  4. git push origin feat/nama-fitur   (Kirim ke GitHub)                     │
│  5. Buka GitHub Web -> Create Pull Request -> Merge                         │
│  6. Balik ke main -> git pull origin main (Ambil update terbaru)            │
└─────────────────────────────────────────────────────────────────────────────┘
```

#### Langkah 1: Buat Branch Baru Sebelum Mengetik Kode
Sebelum mengedit file apapun, buat branch baru sesuai tugas kalian:
* **Nurul**:
  ```bash
  git checkout -b feat/posko-nurul
  ```
* **Faizal**:
  ```bash
  git checkout -b feat/penyaluran-faizal
  ```
* *Cara cek kalian sedang di branch mana:*
  ```bash
  git branch
  ```
  *(Pastikan tanda bintang `*` berada di branch fitur kalian, bukan di `main`)*.

---

#### Langkah 2: Koding Fitur di File Milik Sendiri
- Kerjakan file Model, Migration, Controller, dan Blade sesuai pembagian tugas di atas (Zona Mandiri).
- Jika membuat migrasi database baru:
  ```bash
  php artisan migrate
  ```

---

#### Langkah 3: Simpan Progres (Commit) dan Kirim ke GitHub (Push)
Jika kodingan sudah selesai atau ingin menyimpan progres:
1. Cek file apa saja yang berubah:
   ```bash
   git status
   ```
2. Tambahkan semua perubahan ke daftar siap simpan (*staging*):
   ```bash
   git add .
   ```
3. Simpan dengan pesan jelas:
   ```bash
   git commit -m "feat: membuat tampilan form dan logika controller posko"
   ```
4. Kirim branch kalian ke GitHub:
   * **Nurul**:
     ```bash
     git push origin feat/posko-nurul
     ```
   * **Faizal**:
     ```bash
     git push origin feat/penyaluran-faizal
     ```
   *(Jika diminta login GitHub di browser, klik **Authorize / Sign in with Browser**)*.

---

#### Langkah 4: Buat Pull Request (PR) & Gabungkan ke `main` (Lewat Web GitHub)
1. Buka browser ke repository:
   👉 **[https://github.com/apipippp/PemwebII-LemariPeduli](https://github.com/apipippp/PemwebII-LemariPeduli)**
2. Kalian akan melihat kotak kuning bertuliskan:
   > *"feat/posko-nurul had recent pushes"* $\rightarrow$ Klik tombol hijau **Compare & pull request**.
3. Beri deskripsi singkat tentang apa saja yang baru dibuat.
4. Klik tombol hijau **Create pull request**.
5. Setelah halaman me-refresh, klik tombol hijau **Merge pull request** $\rightarrow$ klik **Confirm merge**.
6. Status akan berubah menjadi ungu (**Merged**). Kode kalian sekarang sudah resmi masuk ke branch utama (`main`)!

---

#### Langkah 5: Rutinitas Sebelum Mulai Koding di Hari Berikutnya (Ambil Update Teman)
Setiap kali kalian atau teman selesai menggabungkan fitur ke `main`, lakukan langkah ini di laptop kalian sebelum mulai ngoding lagi:

```bash
# 1. Pindah ke branch main
git checkout main

# 2. Tarik update terbaru dari teman yang sudah ada di GitHub
git pull origin main

# 3. Pindah kembali ke branch fitur kalian
git checkout <nama-branch-kalian>

# 4. Satukan perubahan terbaru dari main ke dalam branch kalian
git merge main

# 5. Jika teman kalian menambahkan tabel baru di database, jalankan:
php artisan migrate
```

## 🎯 Panduan Persiapan Presentasi & Penguasaan Materi

Saat ujian praktikum, asisten praktikum menguji pemahaman masing-masing anggota:

* **Afif Nur Rahman**:
  - Mampu menjelaskan alur pengajuan donasi pakaian, validasi tipe file upload gambar pada `DonationController`, serta cara kerja otorisasi **Role-Based Access Control (RBAC)** melalui middleware `IsAdmin` dan pemisahan hak akses admin vs donatur.
* **Nurul Maftuhah**:
  - Mampu menjelaskan fungsi CRUD lokasi posko, validasi form input alamat/PIC, serta bagaimana data posko ditampilkan ke publik/donatur.
* **Muhammad Faizal Khabibi**:
  - Mampu menjelaskan fungsi CRUD laporan penyaluran bantuan pakaian ke masyarakat, perancangan Landing Page publik, serta perhitungan ringkasan data statistik pada Dashboard Admin.

---

## 🌐 Link Deployment Live (Praktikum)

Website telah berhasil di-deploy ke server aaPanel dan dapat diakses langsung oleh dosen/asisten praktikum secara online melalui internet:
* **URL Utama**: [https://a3.athafa.cloud](https://a3.athafa.cloud) (atau [http://a3.athafa.cloud](http://a3.athafa.cloud))
* **Kredensial Akun Uji Coba**:
  - **Administrator**: `admin@lemaripeduli.com` | Password: `password`
  - **Donatur**: `donatur@lemaripeduli.com` | Password: `password`
