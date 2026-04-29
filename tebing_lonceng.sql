-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2026 at 10:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tebing_lonceng`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `profile_pic`, `created_at`) VALUES
(1, 'fikri', '030806', 'assets/img/admin/admin_1776633377.jpg', '2026-04-19 14:57:51'),
(2, 'admin', 'admin123', NULL, '2026-04-29 08:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `bad_words`
--

CREATE TABLE `bad_words` (
  `id` int NOT NULL,
  `word` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bad_words`
--

INSERT INTO `bad_words` (`id`, `word`) VALUES
(1, 'anjing'),
(2, 'anjay'),
(3, 'anjir'),
(4, 'anjrit'),
(5, 'anjrot'),
(6, 'njir'),
(7, 'anying'),
(8, 'anjim'),
(9, 'asu'),
(10, 'bangsat'),
(11, 'bajingan'),
(12, 'kampret'),
(13, 'keparat'),
(14, 'sialan'),
(15, 'brengsek'),
(16, 'celeng'),
(17, 'setan'),
(18, 'iblis'),
(19, 'monyet'),
(20, 'goblok'),
(21, 'tolol'),
(22, 'bego'),
(23, 'bodoh'),
(24, 'idiot'),
(25, 'dongo'),
(26, 'dungu'),
(27, 'sinting'),
(28, 'ediot'),
(29, 'edan'),
(30, 'gila'),
(31, 'gelo'),
(32, 'kurang ajar'),
(33, 'brengsek'),
(34, 'pecundang'),
(35, 'cupu'),
(36, 'kampungan'),
(37, 'norak'),
(38, 'lemot'),
(39, 'payah'),
(40, 'sampah'),
(41, 'kontol'),
(42, 'memek'),
(43, 'ngentot'),
(44, 'ngentod'),
(45, 'pukimak'),
(46, 'puki'),
(47, 'burit'),
(48, 'semburit'),
(49, 'pantek'),
(50, 'pepek'),
(51, 'jembut'),
(52, 'itil'),
(53, 'tetek'),
(54, 'bokong'),
(55, 'colmek'),
(56, 'coli'),
(57, 'ngocok'),
(58, 'bugil'),
(59, 'telanjang'),
(60, 'bokep'),
(61, 'kontol lu'),
(62, 'memek lu'),
(63, 'pepek lu'),
(64, 'puki lu'),
(65, 'jancok'),
(66, 'jancuk'),
(67, 'cok'),
(68, 'cuk'),
(69, 'jancuk'),
(70, 'haram jadah'),
(71, 'anak haram'),
(72, 'anak sundal'),
(73, 'sundal'),
(74, 'lonte'),
(75, 'pelacur'),
(76, 'PSK'),
(77, 'lacur'),
(78, 'babi'),
(79, 'babi lu'),
(80, 'banci'),
(81, 'bencong'),
(82, 'maho'),
(83, 'homo'),
(84, 'bading'),
(85, 'waria'),
(86, 'bencil'),
(87, 'bacot'),
(88, 'mampus'),
(89, 'mampus lu'),
(90, 'modar'),
(91, 'modar lu'),
(92, 'bundir'),
(93, 'matilah'),
(94, 'bangke'),
(95, 'bangkai'),
(96, 'taik'),
(97, 'tai'),
(98, 'tai lu'),
(99, 'gabut'),
(100, 'baperan'),
(101, 'nyebelin'),
(102, 'nyampah'),
(103, 'jijik'),
(104, 'jelek banget'),
(105, 'kampret lu'),
(106, 'goblok lu'),
(107, 'tolol lu'),
(108, 'anjing lu'),
(109, 'bangsat lu'),
(110, 'bajingan banget'),
(111, 'ngentot lu'),
(112, 'sialan lu'),
(113, 'kurang ajar lu'),
(114, 'bacot lu'),
(115, 'motherfucker'),
(116, 'fuck'),
(117, 'shit'),
(118, 'asshole'),
(119, 'bastard'),
(120, 'bitch'),
(121, 'damn'),
(122, 'cunt'),
(123, 'dick'),
(124, 'pussy'),
(125, 'wtf'),
(126, 'fck'),
(127, 'fuk'),
(128, 'fvck'),
(129, 'anying'),
(130, 'bangsat'),
(131, 'g0blok'),
(132, 'k0ntol'),
(133, 'j4ncok'),
(134, 'nget0t'),
(135, 'b4nc1'),
(136, 'as5'),
(137, 'anj1ng'),
(138, 'tol0l');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int NOT NULL,
  `kategori` varchar(50) NOT NULL COMMENT 'spotfoto atau homestay',
  `judul` varchar(200) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `urutan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `kategori`, `judul`, `deskripsi`, `gambar`, `urutan`) VALUES
(1, 'spotfoto', 'Tebing Utama', 'Tebing Utama — titik pandang paling ikonik dengan pemandangan langsung ke Sungai Mahakam.', 'assets/img/2.webp', 1),
(2, 'spotfoto', 'Panorama 180°', 'Panorama 180° — spot terbuka dengan latar langit dan hamparan kota Samarinda.', 'assets/img/5.webp', 2),
(3, 'spotfoto', 'Koridor Hijau', 'Koridor Hijau — jalur yang rindang dengan estetika alami yang sempurna untuk foto.', 'assets/img/9.webp', 3),
(4, 'spotfoto', 'Spot Senja', 'Spot Senja — lokasi terbaik untuk menikmati dan mengabadikan golden hour Samarinda.', 'assets/img/11.webp', 4),
(5, 'homestay', 'Homestay 1', 'Kamar dengan pemandangan kota Samarinda yang menakjubkan.', 'assets/img/16.webp', 1),
(6, 'homestay', 'Homestay 2', 'Suasana kamar yang hangat dan nyaman.', 'assets/img/10.webp', 2),
(7, 'homestay', 'Homestay 3', 'Area santai dengan view alam yang menenangkan.', 'assets/img/8.webp', 3),
(8, 'homestay', 'Homestay 4', 'Nikmati momen terbangun di atas ketinggian.', 'assets/img/18.webp', 4);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` text,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `user_id`, `image_path`, `caption`, `status`, `created_at`) VALUES
(7, 20, 'assets/img/galeri/gallery_69f1dfe3e615e_1777459171.png', 'mudah dijangkau, trek bagus\r\ntempat bersih, terawat', 'approved', '2026-04-29 10:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `kesan` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `nama`, `kesan`, `status`, `created_at`) VALUES
(1, 1, 'Ratri Indraswari', '2x kesini waktu tahun baru, pernah juga sih pas ga tahun baru. Tapi menurutku ini spot terbaik buat lihat kembang api pas Tahun baruan.', 'approved', '2026-04-12 02:15:42'),
(2, 2, 'Angelina Sthefhany', 'Kesini bagusnya pada pagi hari atau sore hari, dari atas kita disuguhi pemandangan padatnya kota Samarinda dan lalu lintas sungai yg padat.', 'approved', '2026-04-12 02:15:42'),
(3, 1, 'Arunayza', 'Enak tempatnya, adem angin sepoi-sepoi, cocok buat santai menikmati pemandangan kota Samarinda dan sungai mahakam.', 'approved', '2026-04-12 02:15:42'),
(4, 2, 'Anastasia Dita Yustina', 'Bayar parkir 3k bayar masuk 10k. Suka suasannya tenang. Sedikit capek karna harus naik gunung dan jalan kecil. Tapi pas udah nyampe bukitnya kamu bisa liat view kota samarinda.', 'approved', '2026-04-12 02:15:42'),
(5, 1, 'Mita Hady', 'Tempatnya cukup bagus, pemandangan dan spot fotonya sangat ciamik dilihat dari kejauhan. Dari sini kita bisa lihat kota Samarinda dari atas, terutama jembatan mahkota.', 'approved', '2026-04-12 02:15:42'),
(36, NULL, 'Budi Santoso', 'Tempatnya keren banget! View kota Samarinda dari atas sini luar biasa, bisa lihat Sungai Mahakam dengan jelas. Sangat worth it harga tiket 10 ribu.', 'approved', '2025-11-03 00:22:10'),
(37, NULL, 'Dewi Rahmawati', 'Spot foto di sini bagus-bagus banget. Saya ambil foto golden hour dari Spot Senja, hasilnya keren parah. Pasti balik lagi!', 'approved', '2025-11-10 07:45:30'),
(38, NULL, 'Reza Firmansyah', 'Jalur trekking ke atas lumayan menantang tapi seru. Pas nyampe puncak semua lelah terbayar lunas sama pemandangan kotanya. Recommended!', 'approved', '2025-11-18 01:10:05'),
(39, NULL, 'Siti Nuraini', 'Saya bawa keluarga ke sini, anak-anak senang banget. Viewnya bagus, udaranya segar, dan fasilitas toiletnya lumayan bersih. Harga tiket masuk sangat terjangkau.', 'approved', '2025-11-22 06:33:20'),
(40, NULL, 'Ahmad Hidayat', 'Tebing Lonceng ini hidden gem Samarinda! Nggak nyangka ada spot secantik ini. Panorama 360 derajat kota Samarinda plus Sungai Mahakam. Wajib dikunjungi!', 'approved', '2025-11-30 23:55:45'),
(41, NULL, 'Lestari Putri', 'Datang pas sore hari, sunset dari sini gila indahnya. Langit orange kemerahan dipaduin sama lampu kota yang mulai nyala. Romantis banget buat pasangan!', 'approved', '2025-12-05 09:20:00'),
(42, NULL, 'Wahyu Nugroho', 'Udah beberapa kali ke sini, nggak pernah bosen. Tiap datang nuansanya beda-beda. Pagi hari kabut tipis bikin suasana makin estetik.', 'approved', '2025-12-11 22:30:15'),
(43, NULL, 'Nanda Permata', 'Homestay-nya cozy banget! Tidur di kayu, bangun pagi disambut view kota Samarinda dari balkon. Pengalaman yang nggak terlupakan.', 'approved', '2025-12-15 12:10:40'),
(44, NULL, 'Rizky Pratama', 'Parkir gampang, masuk murah, pemandangan mahal. Formula wisata yang pas banget. Spot Koridor Hijau paling suka buat foto aesthetic.', 'approved', '2025-12-20 02:05:55'),
(45, NULL, 'Yunita Sari', 'Pas malam tahun baru kesini rame banget tapi tetap seru! Kembang api dari atas sini keliatan dari berbagai penjuru kota. Momen yang nggak bakal dilupain.', 'approved', '2026-01-01 15:45:00'),
(46, NULL, 'Fajar Kurniawan', 'Akses jalannya sudah bagus, tidak terlalu susah dijangkau. Tempatnya terawat dan bersih. Petugasnya ramah-ramah. Dua jempol deh!', 'approved', '2026-01-07 01:15:30'),
(47, NULL, 'Mega Wulandari', 'Spot foto Tebing Utama itu favorit saya! Latar sungai Mahakam langsung di belakang, hasilnya foto kaya iklan pariwisata. Hehe. Masuk gratis anak-anak juga ya, jadi lebih hemat.', 'approved', '2026-01-13 05:40:20'),
(48, NULL, 'Hendra Wijaya', 'Trekking paginya segar banget. Udara bersih, pepohonan rindang di jalurnya. Kalau suka alam dan fotografi, tempat ini surga!', 'approved', '2026-01-19 23:00:00'),
(49, NULL, 'Putri Anggraini', 'Pertama kali ke sini sama teman-teman kantor. Semua pada takjub sama viewnya. Udah jadi agenda wajib kalau ada teman dari luar kota main ke Samarinda.', 'approved', '2026-01-25 03:55:10'),
(50, NULL, 'Eko Prabowo', 'Tempatnya unik karena bisa lihat Sungai Mahakam sekaligus skyline kota Samarinda dari satu titik. Jarang ada wisata yang kasih experience begini. Bagus!', 'approved', '2026-02-02 08:20:45'),
(51, NULL, 'Rina Marlina', 'Saya datang pas hari biasa, suasana lebih tenang. Bisa duduk santai sambil nikmatin angin dan pemandangan tanpa kerumunan. Cocok buat healing!', 'approved', '2026-02-08 06:00:00'),
(52, NULL, 'Dani Setiawan', 'Dari parkiran sampai puncak butuh sekitar 15-20 menit jalan kaki. Lumayan tapi worth it. Bawa air minum secukupnya karena cukup menguras tenaga.', 'approved', '2026-02-11 02:30:15'),
(53, NULL, 'Ayu Fitriana', 'Tempatnya instagramable banget! Setiap sudut ada aja angle bagusnya. Saya habis hampir 200 foto di sini haha. Recommend banget buat yang suka foto-foto!', 'approved', '2026-02-15 07:10:50'),
(54, NULL, 'Bagas Nurhadi', 'Pertama ke sini karena diajak teman. Sekarang jadi langganan buat ngajak orang lain. Harga tiket 10ribu tapi pengalamannya kayak mahal. Keren!', 'approved', '2026-02-19 00:45:00'),
(55, NULL, 'Citra Dewi', 'Tempat ini berhasil bikin saya terpukau. Pemandangan Mahakam dari ketinggian itu beda banget sensasinya dibanding lihat dari bawah. Salut sama pengelolaannya!', 'approved', '2026-02-23 04:00:00'),
(56, NULL, 'Dimas Aditya', 'Cocok buat liburan keluarga maupun solo traveling. Tempatnya aman, ada petugas yang jaga, dan areanya luas. Anak-anak bisa lari-larian dengan aman.', 'approved', '2026-02-27 01:30:30'),
(57, NULL, 'Elisa Handayani', 'Saya sering jogging pagi lewat jalur bawah, tapi baru pertama naik ke atas. Ternyata di atas sebagus ini! Nyesel kenapa baru cobain sekarang hehe.', 'approved', '2026-03-02 22:50:20'),
(58, NULL, 'Fandi Ahmad', 'Spot senja di sini juara! Nunggu golden hour sambil duduk di bangku kayu, langit mulai kemerahan... rasanya damai banget. Highly recommended!', 'approved', '2026-03-07 10:05:00'),
(59, NULL, 'Gita Natasya', 'Homestay-nya worth it banget. Fasilitas lengkap, bersih, dan yang paling bikin happy itu balkonnya ngadep langsung ke view kota. Pagi-pagi bisa ngopi sambil liat Samarinda.', 'approved', '2026-03-09 23:30:00'),
(60, NULL, 'Haris Maulana', 'Jalan menuju tebing sudah diperbaiki, enak buat naik. Nggak terlalu curam. Pas nyampe atas langsung dikejutin sama view yang gila. Puas banget!', 'approved', '2026-03-14 02:15:35'),
(61, NULL, 'Indri Lestari', 'Satu kata: KEREN. View 180 derajat kota Samarinda dari sini nggak ada tandingannya. Kalau mau lihat kota ini dari sudut terbaik, ini tempatnya!', 'approved', '2026-03-18 05:20:10'),
(62, NULL, 'Joko Susanto', 'Pengelolaan tempatnya makin bagus. Ada penambahan fasilitas yang bikin nyaman. Semoga terus berkembang jadi destinasi wisata unggulan Samarinda!', 'approved', '2026-03-21 01:00:00'),
(63, NULL, 'Karin Amalia', 'Datang pagi hari sebelum jam 8, matahari belum terlalu terik, udaranya sejuk, dan pengunjung masih sepi. Momen yang sempurna buat menikmati alam!', 'approved', '2026-03-23 23:45:00'),
(64, NULL, 'Lukman Hakim', 'Ini destinasi wisata lokal yang patut dibanggakan. Samarinda punya permata tersembunyi di Tebing Lonceng. Kalau punya tamu dari luar kota, pasti saya bawa ke sini!', 'approved', '2026-03-27 06:00:00'),
(65, NULL, 'Maya Andriani', 'Koridor Hijau-nya estetik banget buat foto! Cahaya mataharinya nyaring ke sela-sela daun. Vibesnya kayak hutan mini di tengah kota. Cantik!', 'approved', '2026-03-30 03:30:00'),
(66, NULL, 'Novan Saputra', 'Murah meriah tapi viewnya premium. Tiket 10 ribu buat pengalaman lihat Samarinda dari ketinggian. Ini definisi wisata yang nggak perlu mahal tapi berkesan!', 'approved', '2026-04-01 02:00:00'),
(67, NULL, 'Oktavia Rahayu', 'Sempat khawatir jalurnya licin pas musim hujan, tapi ternyata masih aman karena ada pegangan. Petugasnya juga sigap kasih info dan bantu pengunjung. Suka!', 'approved', '2026-04-03 07:30:00'),
(68, NULL, 'Panji Wiratama', 'Romantis banget buat kencan sore hari! Bawa bekal makanan, duduk di Spot Senja, tunggu sunset bareng. Pasangan saya sampai minta balik lagi minggu depan haha.', 'approved', '2026-04-05 09:00:00'),
(69, NULL, 'Qorina Fadilah', 'Saya ke sini dalam rangka liburan sekolah bareng keluarga. Anak saya umur 8 tahun masuk gratis, lumayan hemat. Tempatnya aman dan nyaman untuk anak-anak.', 'approved', '2026-04-07 01:00:00'),
(70, NULL, 'Rafi Nugraha', 'View jembatan Mahkota dari atas sini kelihatan sangat jelas. Kota Samarinda terlihat begitu hidup dari ketinggian Tebing Lonceng. Amazing!', 'approved', '2026-04-08 02:45:00'),
(71, NULL, 'Sinta Maharani', 'Pengen balik terus ke sini. Setiap datang di waktu berbeda, nuansanya selalu lain. Pagi beda, sore beda, malam beda. Tebing Lonceng nggak pernah ngebosenin!', 'approved', '2026-04-09 08:00:00'),
(72, NULL, 'Tama Suryanto', 'Pertama ke sini karena liat di TikTok. Eh beneran seindah yang di video! Bahkan lebih bagus aslinya. Langsung follow akun sosmednya dan rekomenin ke teman-teman.', 'approved', '2026-04-10 04:30:00'),
(73, NULL, 'Uci Wulandari', 'Tempat wisata yang menggabungkan alam, sejarah, dan estetika. Belajar tentang sejarah Gunung Lonceng sekaligus nikmatin pemandangan. Edukasi dan rekreasi dalam satu paket!', 'approved', '2026-04-11 03:00:00'),
(74, NULL, 'Vino Permana', 'Saya bawa kamera DSLR ke sini, hasilnya memuaskan banget! Golden hour dari Spot Senja itu magis. Pencahayaannya sempurna untuk fotografi landscape.', 'approved', '2026-04-12 09:30:00'),
(75, NULL, 'Winda Kurnia', 'Pengelola tempatnya sangat responsif dan ramah. Waktu saya tanya jalur terbaik buat foto sunset, langsung diarahkan dengan detail. Pelayanan bintang lima!', 'approved', '2026-04-13 06:15:00'),
(76, NULL, 'Xander Pratama', 'Tebing Lonceng itu bukan cuma tempat foto, tapi tempat buat refleksi diri. Duduk sendirian di Tebing Utama sambil lihat Mahakam mengalir... rasanya tenang banget.', 'approved', '2026-04-14 00:00:00'),
(77, NULL, 'Yani Safitri', 'Buat pecinta sunrise, datanglah sebelum jam 6. Pemandangan langit pagi dari Tebing Lonceng itu... nggak ada kata-kata yang cukup. Harus dialami sendiri!', 'approved', '2026-04-14 22:00:00'),
(78, NULL, 'Zaki Alfaridzi', 'Pernah bawa klien dari Jakarta ke sini. Mereka sampai bilang ini salah satu spot terbaik yang pernah mereka kunjungi di Kalimantan. Bangga punya wisata sebagus ini di Samarinda!', 'approved', '2026-04-16 05:00:00'),
(79, NULL, 'Aditya Kusuma', 'Setelah naik lumayan capek, tapi pas lihat viewnya langsung hilang capeknya. Ada bangku-bangku buat duduk istirahat. Fasilitas cukup memadai untuk ukuran wisata alam.', 'approved', '2026-04-17 02:00:00'),
(80, NULL, 'Bella Oktaviani', 'Suka banget sama konsep wisata berbasis masyarakat lokal ini. Tiket masuknya langsung mendukung warga Mangkupalas. Wisata yang bermanfaat untuk semua!', 'approved', '2026-04-18 01:30:00'),
(81, NULL, 'Candra Prasetyo', 'View malamnya underrated banget! Kota Samarinda malam hari penuh lampu, kelihatan dari atas sini kayak permata. Sayang kurang banyak yang tahu kalau buka sampai jam 11 malam.', 'approved', '2026-04-19 13:00:00'),
(82, NULL, 'Dara Puspita', 'Cocok banget buat refreshing dari rutinitas kota. Udaranya berbeda banget sama di bawah, segar dan nggak panas. Bisa betah berlama-lama di sini!', 'approved', '2026-04-20 02:30:00'),
(83, NULL, 'Erwin Mahendra', 'Tempatnya instagramable dan tiktokable! Konten yang diambil di sini selalu dapat banyak like. Teman-teman pada tanya lokasinya setelah saya posting. Hehe.', 'approved', '2026-04-21 07:00:00'),
(84, NULL, 'Fira Azzahra', 'Barusan ke sini dan langsung jatuh cinta sama tempatnya. Dari Koridor Hijau sampai Tebing Utama, semuanya punya karakter foto yang beda. Mau balik lagi besok!', 'approved', '2026-04-22 08:45:00'),
(85, NULL, 'Galih Setiabudi', 'Saran buat yang mau ke sini: bawa sunscreen kalau siang, dan bawa jaket tipis kalau mau nunggu sunset. Anginnya kencang tapi pemandangannya sebanding!', 'approved', '2026-04-23 09:30:00'),
(86, NULL, 'Hana Mulyani', 'Ini pertama kali saya ke destinasi wisata berbasis komunitas dan saya sangat terkesan. Konsepnya berkelanjutan dan berdampak positif untuk warga lokal. Support local!', 'approved', '2026-04-24 04:00:00'),
(87, NULL, 'Irfan Maulana', 'Jarak dari pusat kota nggak jauh, jalanan sudah bagus, parkir aman. Nggak ada alasan lagi buat orang Samarinda yang belum ke sini. Wajib dikunjungi!', 'approved', '2026-04-25 00:15:00'),
(88, NULL, 'Jesika Andriani', 'Tempat yang bikin kamu sadar betapa indahnya kota Samarinda dari sudut pandang yang berbeda. Panorama 180 derajatnya bikin takjub. Keren abis!', 'approved', '2026-04-26 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('acc1_content', 'Gunung Lonceng adalah saksi bisu perjuangan di tepian Sungai Mahakam. Dahulu, puncak ini merupakan titik intai strategis para pejuang untuk memantau pergerakan kapal yang masuk ke Samarinda.'),
('acc1_title', 'Sejarah Singkat'),
('acc2_content', 'Tempat ini lahir dari semangat gotong royong warga Mangkupalas. Bagi kami, Tebing Lonceng bukan sekadar objek wisata, melainkan rumah bersama untuk tumbuh dan berdaya.'),
('acc2_title', 'Pemberdayaan Warga'),
('acc3_content', 'Nikmati cara terbaik melihat Samarinda dari ketinggian. Dengan panorama megah dan berbagai spot foto ikonik, lengkapi petualangan Anda bersama kami.'),
('acc3_title', 'Pesona Ketinggian'),
('hero_subtitle', 'Rasakan ketenangan di puncak tertinggi Tebing Lonceng, destinasi ekowisata di Samarinda.'),
('hero_title', 'Menjadi bagian, Dari sudut Kalimantan'),
('hs_acc1_content', '<p>Kabin kayu minimalis yang modern dan bersih. Dilengkapi dengan kasur double bed, AC, area duduk santai dekat jendela, teko listrik (kettle), air mineral, kopi/teh, perlengkapan ibadah, dan nakas.</p>'),
('hs_acc1_title', 'Fasilitas Kamar & Interior'),
('hs_acc2_content', '<p>Fasilitas mandi yang bersih dengan lantai keramik putih, kloset duduk yang dilengkapi shower spray (bidet), serta bak mandi dan gayung.</p>'),
('hs_acc2_title', 'Kamar Mandi'),
('hs_acc3_content', '<ul class=\\\"list-disc pl-4 space-y-1\\\"><li>Check-in 14.00 WITA, Check-out 12.00 WITA.</li><li>Pembayaran lunas 100% sebelum check-in.</li><li>Deposit Rp100.000 & KTP asli sebagai jaminan.</li><li>Dilarang membawa hewan, sajam, miras, narkoba, & makanan berbau tajam.</li></ul>'),
('hs_acc3_title', 'Aturan & Kebijakan'),
('hs_acc4_content', '<p>Bangunan rumah panggung berbahan kayu dengan balkon kecil. Lokasi sangat privat dan sempurna untuk menikmati pemandangan city light Samarinda dari ketinggian.</p>'),
('hs_acc4_title', 'Eksterior & Lingkungan'),
('hs_stat_kabin', '1'),
('hs_stat_privasi', '100'),
('hs_stat_rating', '4.9'),
('hs_title', 'Kenyamanan di Balik Tebing Lonceng.'),
('hs_wa_link', 'https://wa.me/6281234567890?text=Halo%20Tebing%20Lonceng,%20saya%20ingin%20reservasi%20Homestay'),
('open_days', 'SENIN - MINGGU'),
('open_hours', '07.00 - 23.00'),
('page_visits', '443'),
('sejarah_text', 'Tebing Lonceng, awalnya dikenal oleh masyarakat lokal sebagai \'Batu Berdering\', memiliki sejarah panjang yang membentang lebih dari dua abad.'),
('ticket_price', '10.000'),
('ticket_price_child', 'Gratis'),
('ticket_price_student', '10.000'),
('ticket_quota', '100'),
('why_img1', 'assets/img/1.webp'),
('why_img2', 'assets/img/why/why_2_1776999127.webp'),
('why_img3', 'assets/img/3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `statistik_pengunjung`
--

CREATE TABLE `statistik_pengunjung` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `statistik_pengunjung`
--

INSERT INTO `statistik_pengunjung` (`id`, `tanggal`, `jumlah`, `created_at`) VALUES
(1, '2026-03-29', 378, '2026-04-28 21:44:29'),
(2, '2026-03-30', 101, '2026-04-28 21:44:29'),
(3, '2026-03-31', 56, '2026-04-28 21:44:29'),
(4, '2026-04-01', 181, '2026-04-28 21:44:29'),
(5, '2026-04-02', 277, '2026-04-28 21:44:29'),
(6, '2026-04-03', 121, '2026-04-28 21:44:29'),
(7, '2026-04-04', 372, '2026-04-28 21:44:29'),
(8, '2026-04-05', 362, '2026-04-28 21:44:29'),
(9, '2026-04-06', 183, '2026-04-28 21:44:29'),
(10, '2026-04-07', 200, '2026-04-28 21:44:29'),
(11, '2026-04-08', 75, '2026-04-28 21:44:29'),
(12, '2026-04-09', 228, '2026-04-28 21:44:29'),
(13, '2026-04-10', 100, '2026-04-28 21:44:29'),
(14, '2026-04-11', 217, '2026-04-28 21:44:29'),
(15, '2026-04-12', 299, '2026-04-28 21:44:29'),
(16, '2026-04-13', 187, '2026-04-28 21:44:29'),
(17, '2026-04-14', 127, '2026-04-28 21:44:29'),
(18, '2026-04-15', 236, '2026-04-28 21:44:29'),
(19, '2026-04-16', 266, '2026-04-28 21:44:29'),
(20, '2026-04-17', 212, '2026-04-28 21:44:29'),
(21, '2026-04-18', 301, '2026-04-28 21:44:29'),
(22, '2026-04-19', 242, '2026-04-28 21:44:29'),
(23, '2026-04-20', 62, '2026-04-28 21:44:29'),
(24, '2026-04-21', 215, '2026-04-28 21:44:29'),
(25, '2026-04-22', 207, '2026-04-28 21:44:29'),
(26, '2026-04-23', 86, '2026-04-28 21:44:29'),
(27, '2026-04-24', 120, '2026-04-28 21:44:29'),
(28, '2026-04-25', 215, '2026-04-28 21:44:29'),
(29, '2026-04-26', 249, '2026-04-28 21:44:29'),
(30, '2026-04-27', 131, '2026-04-28 21:44:29'),
(31, '2026-04-28', 180, '2026-04-28 21:44:29'),
(32, '2026-03-01', 6407, '2026-04-28 21:44:29'),
(33, '2026-02-01', 5745, '2026-04-28 21:44:29'),
(34, '2026-01-01', 2650, '2026-04-28 21:44:29'),
(35, '2025-12-01', 6493, '2026-04-28 21:44:29'),
(36, '2025-11-01', 6904, '2026-04-28 21:44:29'),
(37, '2025-10-01', 2385, '2026-04-28 21:44:29'),
(38, '2025-09-01', 2862, '2026-04-28 21:44:29'),
(39, '2025-08-01', 5542, '2026-04-28 21:44:29'),
(40, '2025-07-01', 6326, '2026-04-28 21:44:29'),
(41, '2025-06-01', 5042, '2026-04-28 21:44:29'),
(42, '2025-05-01', 2906, '2026-04-28 21:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `PASSWORD`, `created_at`) VALUES
(1, 'Ratri Indraswari', 'ratri@email.com', '$2y$10$abcdefghijklmnopqrstuuVGZQwXyZ1234567890abcdefghijklm', '2026-04-12 02:15:42'),
(2, 'Angelina Sthefhany', 'angel@email.com', '$2y$10$abcdefghijklmnopqrstuuVGZQwXyZ1234567890abcdefghijklm', '2026-04-12 02:15:42'),
(6, 'Natan', 'natan@gmail.com', '$2y$10$XBV86A/pkz3HDbRCLjanS.nhyDFf1ZkOwNdv/WjuvZd3vsNtUxfG6', '2026-04-12 11:25:44'),
(8, 'Fkriar', 'fkriar@gmail.com', '$2y$10$8UlL3xryTJq/LJMc/b4/peSAsS2fqpsKTjy/dOJL7oGgwnFup7bJy', '2026-04-19 03:12:36'),
(9, 'Natanhitam', 'natanhitam@gmail.com', '$2y$10$1ciUk25.CWkkUER3W7E4/uLEKr1JJdCOGBqlvn20hm9OD1MQ4w0pC', '2026-04-20 06:38:22'),
(10, 'Fikri', 'fikri', '$2y$10$CAyI6v1nsjIpVBVNxRqZTuy4QLu6WTQUstb0p2jjMTZTny0.d2Pd2', '2026-04-23 02:39:57'),
(11, 'Rahman', 'rahman', '$2y$10$AsCXsQ3bEtda2JUtCIpoi.Z/JwH1ndt7Xq8Bp/6guxNhF8YHWk1Y6', '2026-04-23 03:14:27'),
(12, 'Admin System', 'admin_review@system', '', '2026-04-24 02:49:35'),
(13, 'Fikrikuliah', 'fikrikuliah@gmail.com', '$2y$10$txETB6JoAViNm4oQVNtCWO9F/QVECfbybmVFtesGhLgL/TjOm8Dqm', '2026-04-24 03:39:16'),
(14, '123213', '123213@gmail.com', '$2y$10$.fYGGaeXqGGSCtyY96VcX.a8jKqcnNLCV9jEA7bUlB0ucxm2RMAYi', '2026-04-24 13:10:02'),
(15, 'Halo', 'halo@gmail.com', '$2y$10$VQDSzNEwIqBMfGty9shZu.wCfkXs/6k52uc0p3Ulrqt5B6vH2dqWi', '2026-04-26 16:58:54'),
(16, 'Fikri', 'fikri@gmail.com', '$2y$10$jEXIQmaMNF4w4zSC8u1Rv.kBjV94ljzMGTjfqXw6t21W1HZTntfh.', '2026-04-27 12:09:54'),
(17, 'Kuliah', 'kuliah@gmail.com', '$2y$10$lvcjpkx8NN.om/x.rbPPfeR/gm8LEswbkQX06.wBq6MGeYzRe5.oK', '2026-04-28 13:25:31'),
(18, 'Sadikinsamir', 'sadikinsamir@gmail.com', '$2y$10$uQFqN.oS/G5bFGoGUxWcquEer1sX4UWVAo20BOCw9ARTyNrwMwjI6', '2026-04-29 08:41:05'),
(19, 'Arunayza', 'Arunayza@gmail.com', '$2y$10$R8U9jbQjEAPA1Rx4egNele7it//0mIjdBgHqSOkOH0pmIGRVcO4Wa', '2026-04-29 10:10:59'),
(20, 'Sabiladinal', 'sabiladinal@gmail.com', '$2y$10$KQD1vquhwyPlYNvTeMwZte3yul0AzfdstyRff/qazd9uxbYZYmlc6', '2026-04-29 10:39:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_ibfk_1` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tanggal` (`tanggal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
