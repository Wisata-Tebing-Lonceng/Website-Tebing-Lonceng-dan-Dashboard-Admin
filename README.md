<div align="center">

# 🏔️ Tebing Lonceng
### Website Wisata & Dashboard Admin

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-CDN-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org/)
[![GSAP](https://img.shields.io/badge/GSAP-3.15-88CE02?style=for-the-badge&logo=greensock&logoColor=white)](https://gsap.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

**Website profil destinasi wisata Tebing Lonceng yang dilengkapi dengan sistem manajemen konten dan dashboard admin terintegrasi.**

[🌐 Demo Live](#) · [📋 Laporan Bug](https://github.com/Wisata-Tebing-Lonceng/Website-Tebing-Lonceng-dan-Dashboard-Admin/issues) · [💡 Request Fitur](https://github.com/Wisata-Tebing-Lonceng/Website-Tebing-Lonceng-dan-Dashboard-Admin/issues)

</div>

---

## 📖 Deskripsi

**Tebing Lonceng** adalah sebuah website profil destinasi wisata alam yang dibangun sebagai Proyek Akhir mata kuliah Pemrograman Web. Aplikasi ini memiliki dua sisi utama:

- **Sisi Pengunjung (User)** — Halaman publik dengan desain premium *SaaS-style* yang menampilkan informasi lengkap tentang destinasi, fasilitas, galeri, paket homestay, hingga sistem pemesanan tiket online.
- **Sisi Admin** — Dashboard manajemen konten yang lengkap untuk mengelola seluruh data website secara *real-time* tanpa perlu menyentuh kode program.

---

## ✨ Fitur Utama

### 🌍 Halaman Pengunjung
| Fitur | Deskripsi |
|---|---|
| **Hero Section Animasi** | Video background dengan teks animasi GSAP (blur + fade-in) dan widget statistik glassmorphism |
| **Tentang Kami (Bento Grid)** | Layout grid dinamis yang menampilkan daya tarik dan sejarah destinasi |
| **Fasilitas (Infinite Carousel)** | Komidi putar tanpa akhir yang menampilkan seluruh spot dan fasilitas |
| **Galeri Publik** | Halaman galeri foto dari pengunjung yang sudah disetujui admin |
| **Homestay** | Info detail kabin, fasilitas kamar, galeri crossfade otomatis, dan tombol pesan via WhatsApp |
| **Ulasan Pengunjung** | Carousel swiper review dengan rating bintang |
| **Pemesanan Tiket Online** | Modal multi-step dengan pemilihan tanggal menggunakan web component kalender |
| **Sejarah** | Halaman dedicated untuk sejarah Tebing Lonceng |

### 🔐 Dashboard Admin
| Fitur | Deskripsi |
|---|---|
| **Overview & Statistik** | Ringkasan data kunjungan, review, dan galeri dalam satu tampilan |
| **Manajemen Fasilitas** | CRUD fasilitas lengkap dengan upload gambar langsung dari panel |
| **Manajemen Review** | Moderasi ulasan pengunjung (setujui / tolak / hapus) |
| **Manajemen Galeri** | Upload foto admin, moderasi foto kiriman pengunjung |
| **Pengaturan Konten** | Edit seluruh teks website (hero, sejarah, homestay, info tiket) tanpa sentuh kode |
| **Pengaturan Profil** | Ganti username, password, dan foto profil admin |
| **Autentikasi** | Sistem login session-based yang aman |

---

## 🛠️ Tech Stack

| Lapisan | Teknologi |
|---|---|
| **Backend** | PHP 8 (MVC Architecture, Vanilla) |
| **Database** | MySQL 8 |
| **Frontend Styling** | Tailwind CSS (via CDN) |
| **Interaktivitas UI** | Vue.js 3 (via CDN, Composition API) |
| **Animasi** | GSAP 3 + ScrollTrigger + ScrollSmoother |
| **Slider** | Swiper.js 11 (Web Components) |
| **Kalender** | Cally (Web Component) |
| **Ikon** | Flaticon Uicons (Regular Rounded & Brands) |
| **Font** | Google Fonts — Inter & Instrument Serif |

---

## 📂 Struktur Proyek

```
tebing-lonceng/
├── 📄 index.php                  # Entry point & router utama
├── 🗄️ tebing_lonceng.sql         # File dump database
│
├── 📁 config/
│   └── database.php              # Koneksi PDO ke MySQL
│
├── 📁 controllers/               # Logika bisnis aplikasi
│   ├── AdminController.php       # CRUD admin (fasilitas, review, galeri, settings)
│   ├── AuthController.php        # Login & logout admin
│   ├── HomeController.php        # Routing halaman publik
│   └── ReviewController.php      # Submit review dari pengunjung
│
├── 📁 models/                    # Lapisan akses database
│   ├── BadWord.php               # Filter kata kasar untuk ulasan
│   ├── Fasilitas.php             # Model fasilitas & spot wisata
│   ├── Gallery.php               # Model galeri foto
│   ├── Review.php                # Model ulasan pengunjung
│   ├── Setting.php               # Model pengaturan konten website
│   └── User.php                  # Model akun admin
│
├── 📁 views/                     # Template tampilan (HTML/PHP)
│   ├── 📁 user/                  # Halaman untuk pengunjung
│   │   ├── home.php              # Halaman utama (Hero, About, Fasilitas, Homestay, Reviews)
│   │   ├── sejarah.php           # Halaman sejarah destinasi
│   │   ├── galeri.php            # Halaman galeri publik
│   │   └── loader.php            # Komponen loading screen animasi
│   │
│   └── 📁 admin/                 # Halaman dashboard admin
│       ├── login.php             # Halaman login admin
│       ├── overview.php          # Dashboard overview & statistik
│       ├── dashboard.php         # Manajemen konten utama
│       ├── fasilitas.php         # Manajemen fasilitas
│       ├── reviews.php           # Manajemen ulasan
│       ├── galleries.php         # Manajemen galeri
│       └── settings.php          # Pengaturan profil admin
│
├── 📁 actions/                   # Endpoint AJAX (file action terpisah)
│
└── 📁 assets/                    # Aset statis
    └── 📁 img/                   # Gambar website
        ├── fasilitas/            # Foto fasilitas (upload admin)
        ├── galleries/            # Foto galeri (upload admin & pengunjung)
        ├── why/                  # Foto bento grid "Mengapa Kami"
        └── admin/                # Foto profil admin
```

---

## 🚀 Instalasi & Cara Menjalankan

### Prasyarat
Pastikan Anda sudah menginstall:
- [XAMPP](https://www.apachefriends.org/) (atau server PHP + MySQL lainnya)
- Git

### Langkah-Langkah

**1. Clone repositori ini**
```bash
git clone https://github.com/Wisata-Tebing-Lonceng/Website-Tebing-Lonceng-dan-Dashboard-Admin.git
```

**2. Pindahkan ke folder `htdocs`**
```bash
# Salin folder project ke htdocs XAMPP Anda
# Contoh: C:\xampp\htdocs\tebing-lonceng
```

**3. Buat database MySQL**
```sql
CREATE DATABASE tebing_lonceng;
```

**4. Import skema & data awal**

Buka **phpMyAdmin**, pilih database `tebing_lonceng`, klik tab **Import**, lalu pilih file `tebing_lonceng.sql` dari root folder project.

**5. Sesuaikan konfigurasi database**

Edit file `config/database.php` dan sesuaikan dengan kredensial database Anda:
```php
private $host     = 'localhost';
private $dbname   = 'tebing_lonceng';
private $username = 'root';      // sesuaikan
private $password = '';          // sesuaikan
```

**6. Jalankan aplikasi**

Buka browser dan akses:
```
http://localhost/tebing-lonceng/
```

---

## 🔑 Akses Admin

Setelah import database, gunakan kredensial berikut untuk masuk ke dashboard admin:

```
URL   : http://localhost/tebing-lonceng/?page=admin&action=login
User  : admin
Pass  : admin123
```

> **⚠️ Penting:** Segera ganti password admin setelah login pertama melalui menu **Pengaturan → Profil Admin**.

---

## 📸 Tangkapan Layar

| Halaman Utama | Dashboard Admin |
|:---:|:---:|
| *(Hero Section)* | *(Overview)* |

| Fasilitas Carousel | Homestay Section |
|:---:|:---:|
| *(Infinite Marquee)* | *(Crossfade Gallery)* |

---

## 🎨 Palet Warna Desain

| Nama | Hex | Penggunaan |
|---|---|---|
| **Charcoal** | `#1a1a1a` | Teks utama, latar gelap |
| **Sage** | `#6b7b62` | Aksen, highlight, warna brand |
| **Cream** | `#FBF9F6` | Latar halaman, elemen terang |

---

## 🤝 Kontribusi

Project ini adalah proyek akademik. Namun jika ingin berkontribusi:

1. *Fork* repositori ini
2. Buat branch fitur baru (`git checkout -b feature/NamaFitur`)
3. *Commit* perubahan Anda (`git commit -m 'feat: tambahkan fitur X'`)
4. *Push* ke branch (`git push origin feature/NamaFitur`)
5. Buka *Pull Request*

---

## 👨‍💻 Tim Pengembang

| Nama | Peran |
|---|---|
| **Natan** | Full-Stack Developer, UI/UX Designer |

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik. Didistribusikan di bawah [MIT License](LICENSE).

---

<div align="center">

Dibuat dengan ❤️ untuk **Mata Kuliah Pemrograman Web — Semester 4**

</div>
