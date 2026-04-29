<div align="center">

# 🏔️ Tebing Lonceng
### Website Wisata & Dashboard Admin — Proyek Akhir Pemrograman Web

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org/)
[![GSAP](https://img.shields.io/badge/GSAP-3.12-88CE02?style=for-the-badge&logo=greensock&logoColor=white)](https://gsap.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

**Platform digital destinasi wisata Tebing Lonceng — dilengkapi halaman publik premium bergaya SaaS dan dashboard admin manajemen konten terintegrasi.**

[📋 Laporan Bug](https://github.com/Wisata-Tebing-Lonceng/Website-Tebing-Lonceng-dan-Dashboard-Admin/issues) · [💡 Request Fitur](https://github.com/Wisata-Tebing-Lonceng/Website-Tebing-Lonceng-dan-Dashboard-Admin/issues)

</div>

---

## 📖 Tentang Proyek

**Tebing Lonceng** adalah aplikasi web full-stack yang dibangun sebagai **Proyek Akhir Mata Kuliah Pemrograman Web (Semester 4)**. Aplikasi ini terdiri dari dua sisi utama:

- 🌐 **Sisi Pengunjung** — Halaman publik berdesain premium *SaaS-style* dengan animasi GSAP, glassmorphism, dan pemesanan tiket online multi-step.
- 🔐 **Dashboard Admin** — Panel manajemen konten lengkap untuk mengelola seluruh data website secara *real-time* tanpa menyentuh kode.

---

## ✨ Fitur Utama

### 🌍 Halaman Pengunjung (`/views/user/`)

| Fitur | Deskripsi |
|---|---|
| **Hero Section** | Video fullscreen background, animasi GSAP blur+fade, widget statistik glassmorphism |
| **Floating Navbar** | Sticky navbar adaptif — transparan saat atas, frosted glass saat scroll, dengan dropdown menu |
| **Tentang (Bento Grid)** | Layout grid dinamis yang menampilkan daya tarik, filosofi, dan keunggulan destinasi |
| **Fasilitas (Infinite Marquee)** | Ticker tanpa henti menampilkan seluruh spot & fasilitas, berhenti saat hover |
| **Homestay** | Info kabin lengkap, galeri crossfade otomatis, tombol reservasi via WhatsApp |
| **Ulasan Pengunjung** | Swiper.js carousel review bintang dari pengunjung yang sudah diverifikasi admin |
| **Pesan Tiket (Modal Multi-step)** | Modal animasi 3-langkah: pilih tanggal (Cally web component) → isi data → konfirmasi |
| **Galeri Publik** | Halaman galeri foto dari pengunjung yang telah disetujui admin |
| **Sejarah** | Halaman dedicated untuk narasi sejarah & latar belakang Tebing Lonceng |
| **Loading Screen** | Animasi loader branding dengan transisi masuk yang halus |

### 🔐 Dashboard Admin (`/views/admin/`)

| Halaman | Deskripsi |
|---|---|
| **Login** | Autentikasi session-based yang aman |
| **Overview** | Ringkasan statistik pengunjung, review, galeri, dan log aktivitas terbaru |
| **Manajemen Fasilitas** | CRUD fasilitas lengkap dengan upload foto langsung dari panel |
| **Manajemen Review** | Moderasi ulasan pengunjung — setujui / tolak / hapus, beserta filter status |
| **Manajemen Galeri** | Upload foto manual oleh admin + moderasi foto kiriman pengunjung |
| **Pengaturan Konten** | Edit seluruh teks website (hero, about, homestay, harga tiket, jam buka) tanpa sentuh kode |
| **Pengaturan Profil** | Ganti username, password, dan foto profil admin |

---

## 🛠️ Tech Stack

| Lapisan | Teknologi |
|---|---|
| **Backend** | PHP 8 (Arsitektur MVC, Vanilla — tanpa framework) |
| **Database** | MySQL 8 via PDO |
| **Styling** | Tailwind CSS 3 (local build via PostCSS + CLI) |
| **Reaktivitas UI** | Vue.js 3 (CDN lokal, Composition API `setup()`) |
| **Animasi** | GSAP 3 + ScrollTrigger (CDN lokal) |
| **Smooth Scroll** | Lenis.js (CDN lokal) |
| **Slider** | Swiper.js 11 (CDN — Web Component API) |
| **Kalender** | Cally (Web Component, CDN) |
| **Ikon** | Flaticon Uicons (Regular Rounded & Brands) |
| **Font** | Google Fonts — Inter & Instrument Serif |

---

## 📂 Struktur Proyek

```
tebing-lonceng/
│
├── 📄 index.php                    # Entry point & front controller utama (routing)
├── 🗄️ tebing_lonceng.sql           # Dump database lengkap (skema + data awal)
├── 🎨 tailwind.input.css           # File sumber Tailwind CSS
│
├── 📁 config/
│   └── database.php               # Koneksi PDO ke MySQL
│
├── 📁 controllers/                 # Lapisan logika bisnis (MVC - Controller)
│   ├── AdminController.php        # Semua aksi CRUD admin
│   ├── AuthController.php         # Login & logout admin
│   ├── HomeController.php         # Routing & data untuk halaman publik
│   └── ReviewController.php       # Submit review dari pengunjung
│
├── 📁 models/                      # Lapisan akses database (MVC - Model)
│   ├── BadWord.php                # Filter kata kasar untuk validasi ulasan
│   ├── Fasilitas.php              # Model fasilitas & spot wisata
│   ├── Gallery.php                # Model galeri foto
│   ├── Review.php                 # Model ulasan pengunjung
│   ├── Setting.php                # Model pengaturan konten website
│   └── User.php                   # Model akun admin
│
├── 📁 views/                       # Lapisan tampilan (MVC - View)
│   ├── 📁 user/                   # Halaman publik
│   │   ├── home.php               # Halaman utama (Hero, Fasilitas, Homestay, dll.)
│   │   ├── sejarah.php            # Halaman sejarah destinasi
│   │   ├── galeri.php             # Halaman galeri publik
│   │   └── loader.php             # Komponen loading screen animasi
│   │
│   └── 📁 admin/                  # Dashboard admin
│       ├── login.php              # Halaman login
│       ├── overview.php           # Dashboard overview & statistik
│       ├── dashboard.php          # Pengaturan konten website
│       ├── fasilitas.php          # Manajemen fasilitas
│       ├── reviews.php            # Manajemen & moderasi ulasan
│       ├── galleries.php          # Manajemen galeri foto
│       ├── settings.php           # Pengaturan profil admin
│       └── 📁 components/
│           └── sidebar.php        # Komponen sidebar navigasi admin
│
├── 📁 actions/                     # Endpoint AJAX / form handler
│   └── 📁 user/
│       ├── login.php              # Proses login admin
│       ├── logout.php             # Proses logout
│       ├── tambah_review.php      # Submit review pengunjung
│       ├── upload_galeri.php      # Upload foto galeri oleh pengunjung
│       └── login_galeri.php       # Autentikasi aksi galeri
│
└── 📁 assets/                      # Aset statis
    ├── 📁 css/                    # Compiled Tailwind CSS output
    ├── 📁 fonts/                  # Font lokal (fallback)
    ├── 📁 img/                    # Gambar website
    │   ├── fasilitas/             # Foto fasilitas (upload admin)
    │   ├── galleries/             # Foto galeri (admin & pengunjung)
    │   ├── why/                   # Foto bento grid "Mengapa Kami"
    │   └── admin/                 # Foto profil admin
    ├── 📁 svg/                    # Aset SVG & ikon
    ├── 📁 vd/                     # Video background (WebM)
    └── 📁 vendor/                 # Library JS lokal (Vue, GSAP, Lenis)
```

---

## 🚀 Instalasi & Cara Menjalankan

### Prasyarat

Pastikan sudah terinstal:
- [XAMPP](https://www.apachefriends.org/) (atau server PHP + MySQL lainnya)
- [Node.js](https://nodejs.org/) (untuk build Tailwind CSS)
- Git

### Langkah Instalasi

**1. Clone repositori**
```bash
git clone https://github.com/Wisata-Tebing-Lonceng/Website-Tebing-Lonceng-dan-Dashboard-Admin.git
```

**2. Pindahkan ke folder `htdocs` XAMPP**
```
C:\xampp\htdocs\tebing-lonceng\
```

**3. Buat database MySQL**
```sql
CREATE DATABASE tebing_lonceng CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**4. Import skema & data awal**

Buka **phpMyAdmin** → pilih database `tebing_lonceng` → tab **Import** → pilih file `tebing_lonceng.sql` dari root project.

**5. Sesuaikan konfigurasi database**

Edit `config/database.php`:
```php
private $host     = 'localhost';
private $dbname   = 'tebing_lonceng';
private $username = 'root';      // sesuaikan
private $password = '';          // sesuaikan
```

**6. (Opsional) Build Tailwind CSS**

Jika ingin memodifikasi styling:
```bash
npm install
npm run build   # atau: npm run dev (watch mode)
```

**7. Jalankan aplikasi**

Buka browser dan akses:
```
http://localhost/tebing-lonceng/
```

---

## 🔑 Akses Admin

Setelah import database, gunakan kredensial berikut:

```
URL   : http://localhost/tebing-lonceng/?page=admin&action=login
User  : admin
Pass  : admin123
```

> **⚠️ Penting:** Segera ganti password setelah login pertama melalui **Pengaturan → Profil Admin**.

---

## 🎨 Desain & Palet Warna

Aplikasi menggunakan sistem desain yang konsisten di seluruh halaman:

| Token | Hex | Penggunaan |
|---|---|---|
| **Charcoal** | `#1a1a1a` | Teks utama, latar gelap, elemen primer |
| **Sage** | `#6b7b62` | Aksen, warna brand, hover state |
| **Cream** | `#FBF9F6` | Latar halaman, modal, kartu terang |

**Prinsip Desain:**
- 🪟 **Glassmorphism** — Elemen frosted glass dengan `backdrop-blur` untuk kedalaman visual
- 🎬 **60fps Animations** — Seluruh animasi menggunakan GSAP + GPU acceleration (`transform-gpu`)
- 📱 **Mobile-First** — Responsive penuh dari 320px hingga 2560px
- ♿ **Accessible** — Semantic HTML, aria attributes, dan keyboard navigation

---

## 🗂️ Arsitektur Aplikasi

```
Browser Request
       │
       ▼
   index.php  ◄──── Front Controller & Router
       │
       ├──► HomeController    ──► views/user/home.php
       ├──► AdminController   ──► views/admin/*.php
       ├──► AuthController    ──► Session management
       └──► ReviewController  ──► actions/user/tambah_review.php
                │
                ▼
           Models (PDO)
                │
                ▼
          MySQL Database
```

---

## 🤝 Kontribusi

Proyek ini adalah karya akademik. Kontribusi tetap terbuka melalui:

1. *Fork* repositori ini
2. Buat branch fitur baru: `git checkout -b feature/NamaFitur`
3. *Commit* perubahan: `git commit -m 'feat: deskripsi perubahan'`
4. *Push* ke branch: `git push origin feature/NamaFitur`
5. Buka *Pull Request*

---

## 👨‍💻 Tim Pengembang

| Nama | Peran |
|---|---|
| **Natan** | Full-Stack Developer & UI/UX Designer |

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik dan didistribusikan di bawah [MIT License](LICENSE).

---

<div align="center">

Dibuat dengan ❤️ untuk **Mata Kuliah Pemrograman Web — Semester 4**

</div>
