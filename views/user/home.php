<?php
// views/user/home.php
// $reviews and $badWordsList supplied by HomeController
?>
<!DOCTYPE html>
<html lang="id" data-theme="lofi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tebing Lonceng</title>
    
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendor/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="assets/vendor/uicons-brands/css/uicons-brands.css">
    <link rel="stylesheet" href="assets/vendor/uicons-solid-rounded/css/uicons-solid-rounded.css">

    <!-- JS -->
    <script src="assets/vendor/vue.global.prod.js"></script>
    <script src="assets/vendor/gsap.min.js"></script>
    <script src="assets/vendor/ScrollTrigger.min.js"></script>
    <script src="assets/vendor/lenis.min.js"></script>
    <script src="assets/vendor/swiper-element-bundle.min.js"></script>
    <script type="module" src="assets/vendor/cally.js"></script>
<!-- Tailwind v4 & DaisyUI CDN -->
    <!-- Vue.js 3 CDN -->
    <!-- Fonts -->
    <!-- GSAP core -->
    <!-- Cally Calendar Web Component -->
    <!-- Swiper Web Components -->
    <style>
        body { background-color: #FBF9F6; color: #1a1a1a; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        /* Light Glassmorphism Navbar */
        .glass-nav {
            background: rgba(251, 249, 246, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        /* Background Blob (Canvas Morphing Concept via CSS) */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.3;
        }

        /* Marquee Animation */
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 25s linear infinite; }

        /* Navbar Active Pill - Light mode */
        .nav-link.active {
            background-color: rgba(0, 0, 0, 0.05) !important;
            color: #1a1a1a !important;
        }

        /* Hide Vue templates before Vue is ready */
        [v-cloak] { display: none !important; }

        /* Hero Stat Widget — Staggered entrance animation */
        @keyframes heroStatIn {
            from {
                opacity: 0;
                transform: translateY(18px);
                filter: blur(4px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }
        .hero-stat-item { opacity: 0; }

        /* Global Arrow Rotation on Button/Link Hover */
        a:hover .fi-rr-arrow-right,
        button:hover .fi-rr-arrow-right,
        .group:hover .fi-rr-arrow-right {
            transform: rotate(-45deg) !important;
        }
        .fi-rr-arrow-right {
            display: inline-block;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        /* ── Swiper Testimonials Custom Styling ── */
        swiper-container.review-swiper {
            --swiper-theme-color: #1a1a1a;
            --swiper-pagination-color: #c5a27d;
            --swiper-pagination-bullet-inactive-color: #1a1a1a;
            --swiper-pagination-bullet-inactive-opacity: 0.15;
            --swiper-pagination-bullet-size: 8px;
            --swiper-pagination-bullet-horizontal-gap: 6px;
            --swiper-navigation-size: 16px;
            padding: 20px 0 60px 0;
            overflow: visible;
        }
        swiper-container.review-swiper swiper-slide {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0.6;
            transform: scale(0.9);
            pointer-events: none;
        }
        swiper-container.review-swiper swiper-slide.swiper-slide-active {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
            z-index: 10;
        }
        swiper-container.review-swiper swiper-slide.swiper-slide-active .review-inner-card {
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            border-color: rgba(0,0,0,0.05);
        }

        /* ── DaisyUI input + textarea global override ── */
        .input, .textarea, .select {
            background-color: #FBF9F6;
            border-color: rgba(0,0,0,0.08);
            color: #1a1a1a;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input:focus, .input:focus-within, .textarea:focus, .select:focus {
            border-color: rgba(107,123,98,0.5) !important;
            box-shadow: 0 0 0 3px rgba(107,123,98,0.08) !important;
            outline: none !important;
        }

        /* ── DaisyUI Badge ── */
        .badge {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.625rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border-radius: 9999px;
        }
        .badge-primary { background: #1a1a1a; color: #FBF9F6; border: none; }
        .badge-secondary { background: rgba(107,123,98,0.1); color: #6b7b62; border: 1px solid rgba(107,123,98,0.2); }

        /* ── DaisyUI Loading ── */
        .loading { color: #6b7b62; }

        /* ── DaisyUI Dropdown ── */
        .dropdown-content {
            background-color: #FBF9F6;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.10);
        }

        /* ── DaisyUI Menu items ── */
        .menu li > a:hover, .menu li > button:hover {
            background-color: rgba(107,123,98,0.08);
            color: #1a1a1a;
        }

        /* ══════════════════════════════════════════════════════
           CALLY CALENDAR — Cream / Sage / Charcoal Theme
           ══════════════════════════════════════════════════════ */
        calendar-date {
            --color-accent:         #6b7b62;
            --color-text-on-accent: #FBF9F6;
            background:   #FBF9F6;
            color:        #1a1a1a;
            font-family:  'Inter', sans-serif;
            padding:      1.5rem;
            display:      block;
            width:        100%;
        }

        /* All day buttons */
        calendar-date::part(button) {
            font-family:  'Inter', sans-serif;
            font-size:    0.875rem;
            color:        #1a1a1a;
            border-radius: 0.625rem;
            transition:   background 0.18s ease, color 0.18s ease;
            cursor:       pointer;
        }
        calendar-date::part(button):hover {
            background: rgba(107,123,98,0.12);
            color:      #6b7b62;
        }

        /* Today's date */
        calendar-date::part(today) {
            border:       1.5px solid rgba(107,123,98,0.6);
            color:        #6b7b62;
            font-weight:  700;
        }

        /* Selected date */
        calendar-date::part(selected) {
            background:  #1a1a1a;
            color:       #FBF9F6;
            font-weight: 700;
            border:      none;
        }
        calendar-date::part(selected):hover {
            background: #6b7b62;
        }

        /* Days outside current month */
        calendar-date::part(outside-month) {
            color:          rgba(26,26,26,0.18);
            pointer-events: none;
        }

        /* Month / Year heading */
        calendar-date::part(heading) {
            font-family:    'Instrument Serif', serif;
            font-size:      1.1rem;
            font-weight:    400;
            color:          #1a1a1a;
            letter-spacing: 0.01em;
        }

        /* Weekday labels (Sen, Sel, …) */
        calendar-date::part(weekday) {
            font-family:    'Inter', sans-serif;
            font-size:      0.6rem;
            font-weight:    800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color:          rgba(26,26,26,0.30);
        }

        /* Hide default <details> disclosure arrow */
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details > summary::marker { display: none; }

        /* Dropdown content panel */
        .nav-dropdown-content {
            position: absolute;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            background: rgba(251, 249, 246, 0.75);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border: 1px solid rgba(0, 0, 0, 0.07);
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0,0,0,0.04);
            min-width: 11rem;
            padding: 0.5rem;
            z-index: 200;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        details[open] .nav-dropdown-content { display: flex; }
        .nav-dropdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.6rem 1rem;
            border-radius: 0.75rem;
            color: #1a1a1a;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.2s;
            white-space: nowrap;
            text-decoration: none;
        }
        .nav-dropdown-item:hover { background: rgba(0, 0, 0, 0.05); }
    </style>

</head>
<body class="antialiased selection:bg-sage selection:text-base">

<?php include 'loader.php'; ?>

<!-- VUE APP MOUNT -->
<div id="app" class="relative">

    <!-- Global Background Blobs -->
    <div class="bg-blob w-[500px] h-[500px] bg-sage top-[-100px] left-[-100px]"></div>
    <div class="bg-blob w-[400px] h-[400px] bg-clay top-[40vh] right-[-100px] opacity-20"></div>

    <!-- FLOATING NAVBAR -->
    <div class="fixed top-0 left-0 right-0 z-50 px-4 transition-all duration-500" :class="isScrolled ? 'py-4' : 'py-6 lg:py-8'" id="navbar-wrapper">
        <div class="max-w-7xl mx-auto">
            <div class="navbar rounded-full px-6 transition-all duration-500 border backdrop-blur-xl" 
                 :class="[isScrolled ? 'bg-white/80 border-black/5 shadow-md' : 'bg-black/30 border-white/10 shadow-lg']" id="navbar">
                <div class="navbar-start w-auto lg:w-1/3">
                    <!-- Desktop Nav -->
                    <div class="hidden lg:flex flex-row items-center gap-1 font-medium text-sm transition-colors duration-500">

                        <!-- Beranda -->
                        <a href="#beranda" @click.prevent="scrollToSection('beranda')" class="px-5 py-2 rounded-full transition-all duration-300 whitespace-nowrap" :class="getNavClass('beranda')">Beranda</a>

                        <!-- Tentang Dropdown -->
                        <details class="dropdown relative">
                            <summary class="px-5 py-2 rounded-full transition-all duration-300 whitespace-nowrap cursor-pointer inline-flex items-center gap-1.5" :class="isScrolled ? 'text-charcoal/80 hover:bg-black/5' : 'text-white/80 hover:bg-white/10'">
                                Tentang <i class="fi fi-rr-angle-small-down text-[10px]"></i>
                            </summary>
                            <div class="nav-dropdown-content">
                                <a href="#about" @click.prevent="scrollToSection('about')" class="nav-dropdown-item">Cerita</a>
                                <a href="views/user/sejarah.php" class="nav-dropdown-item">Sejarah <i class="fi fi-rr-arrow-up-right text-[10px]"></i></a>
                            </div>
                        </details>

                        <!-- Fasilitas -->
                        <a href="#fasilitas" @click.prevent="scrollToSection('fasilitas')" class="px-5 py-2 rounded-full transition-all duration-300 whitespace-nowrap" :class="getNavClass('fasilitas')">Fasilitas</a>

                        <!-- Eksplorasi Dropdown -->
                        <details class="dropdown relative">
                            <summary class="px-5 py-2 rounded-full transition-all duration-300 whitespace-nowrap cursor-pointer inline-flex items-center gap-1.5" :class="isScrolled ? 'text-charcoal/80 hover:bg-black/5' : 'text-white/80 hover:bg-white/10'">
                                Eksplorasi <i class="fi fi-rr-angle-small-down text-[10px]"></i>
                            </summary>
                            <div class="nav-dropdown-content">
                                <a href="#reviews" @click.prevent="scrollToSection('reviews')" class="nav-dropdown-item">Ulasan</a>
                                <a href="views/user/galeri.php" class="nav-dropdown-item">Galeri <i class="fi fi-rr-arrow-up-right text-[10px]"></i></a>
                            </div>
                        </details>

                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden btn-circle transition-colors duration-500" :class="[isScrolled ? 'text-charcoal' : 'text-white']">
                            <i class="fi fi-rr-menu-burger"></i>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-50 p-3 shadow-xl bg-white/97 backdrop-blur-xl rounded-[1.5rem] w-56 border border-black/5 gap-1 font-medium text-charcoal" style="z-index: 9999;">
                            <li><a href="#beranda" @click.prevent="scrollToSection('beranda')" class="px-4 py-3 hover:bg-black/5 rounded-xl transition-all duration-300">Beranda</a></li>
                            <li>
                                <details>
                                    <summary class="px-4 py-3 hover:bg-black/5 rounded-xl transition-all duration-300 font-medium">Tentang</summary>
                                    <ul class="pl-2">
                                        <li><a href="#about" @click.prevent="scrollToSection('about')" class="px-4 py-2.5 hover:bg-black/5 rounded-xl transition-all duration-300">Cerita</a></li>
                                        <li><a href="views/user/sejarah.php" class="px-4 py-2.5 hover:bg-black/5 rounded-xl transition-all duration-300">Sejarah</a></li>
                                    </ul>
                                </details>
                            </li>
                            <li><a href="#fasilitas" @click.prevent="scrollToSection('fasilitas')" class="px-4 py-3 hover:bg-black/5 rounded-xl transition-all duration-300">Fasilitas</a></li>
                            <li>
                                <details>
                                    <summary class="px-4 py-3 hover:bg-black/5 rounded-xl transition-all duration-300 font-medium">Eksplorasi</summary>
                                    <ul class="pl-2">
                                        <li><a href="#reviews" @click.prevent="scrollToSection('reviews')" class="px-4 py-2.5 hover:bg-black/5 rounded-xl transition-all duration-300">Ulasan</a></li>
                                        <li><a href="views/user/galeri.php" class="px-4 py-2.5 hover:bg-black/5 rounded-xl transition-all duration-300">Galeri</a></li>
                                    </ul>
                                </details>
                            </li>
                            <li class="mt-2 pt-2 border-t border-black/5">
                                <button @click="openTicketModal(); $event.target.blur();" class="btn bg-charcoal hover:bg-sage text-white rounded-xl font-bold w-full h-12 shadow-md">
                                    Pesan Tiket <i class="fi fi-rr-arrow-right text-[10px] ml-1"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="navbar-center hidden lg:flex lg:w-1/3 justify-center">
                    <a href="#beranda" @click.prevent="scrollToSection('beranda')" class="text-2xl font-serif tracking-tight group transition-colors duration-500" :class="[isScrolled ? 'text-charcoal' : 'text-white']">Tebing<span class="italic opacity-80 group-hover:opacity-100 transition-opacity">Lonceng</span></a>
                </div>
                <!-- Mobile Center: Logo centered between hamburger and edge -->
                <div class="navbar-center flex-1 lg:hidden justify-center">
                     <a href="#beranda" @click.prevent="scrollToSection('beranda')" class="text-lg font-serif tracking-tight group transition-colors duration-500" :class="[isScrolled ? 'text-charcoal' : 'text-white']">Tebing<span class="italic opacity-80 group-hover:opacity-100 transition-opacity">Lonceng</span></a>
                </div>
                
                <div class="navbar-end hidden lg:flex w-1/3 justify-end gap-2">
                    <button @click="openTicketModal" class="btn border-none rounded-full btn-sm lg:btn-md font-bold px-7 transition-all duration-500 flex items-center gap-2 group hover:scale-105" :class="[isScrolled ? 'bg-charcoal hover:bg-sage text-white shadow-[0_10px_20px_rgba(0,0,0,0.1)]' : 'bg-white hover:bg-white text-charcoal shadow-[0_10px_20px_rgba(255,255,255,0.1)]']">
                        Pesan Tiket 
                        <span class="w-6 h-6 rounded-full flex items-center justify-center transition-colors" :class="[isScrolled ? 'bg-white/10 group-hover:bg-white/20' : 'bg-charcoal/5 group-hover:bg-charcoal/10']">
                            <i class="fi fi-rr-arrow-right text-xs"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
            <main class="relative z-10">
        
        <!-- HERO SECTION (Fullscreen Video + Premium SaaS Overlay) -->
        <section id="beranda" class="min-h-screen w-full relative flex items-center justify-center overflow-hidden text-white">
            
            <!-- Fullscreen Video Background -->
            <video autoplay muted loop playsinline loading="lazy" class="absolute inset-0 w-full h-full object-cover z-0 scale-105 pointer-events-none transform-gpu gs-parallax-bg">
                <source src="assets/vd/tebing-lonceng-vd.webm" type="video/webm">
            </video>
            
            <!-- Dark Overlay -->
            <div class="absolute inset-0 z-0 bg-black/55"></div>

            <!-- Content Container -->
            <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex flex-col items-center justify-center h-full min-h-screen pb-32 pt-20">
                
                <div class="w-full flex flex-col items-center justify-center text-center mt-auto mb-auto px-2 sm:px-0">
                    <!-- Eyebrow (Opening Hours) -->
                    <p class="text-white text-[10px] sm:text-xs font-bold tracking-[0.15em] sm:tracking-[0.2em] uppercase mb-5 sm:mb-6 flex items-center gap-2 gs-hero-text bg-white/10 backdrop-blur-md px-3 sm:px-5 py-2 rounded-full border border-white/20 max-w-full text-center leading-relaxed">
                        <i class="fi fi-rr-clock-three"></i> <?= htmlspecialchars($settings['open_days'] ?? 'Buka Setiap Hari') ?>: <?= htmlspecialchars($settings['open_hours'] ?? '08:00 – 18:00') ?>
                    </p>

                    <!-- Main Headline -->
                    <h1 class="w-full tracking-tight mb-5 sm:mb-8 gs-hero-text font-serif text-white drop-shadow-2xl" style="line-height: 1.05; font-size: clamp(1.5rem, 5.5vw + 0.5rem, 7.5rem);">
                        <?php 
                        $title = $settings['hero_title'] ?? 'Melangkah Menuju, Keheningan.';
                        $parts = explode(',', $title);
                        echo htmlspecialchars(trim($parts[0]));
                        if (isset($parts[1])):
                        ?>
                        <br>
                        <span class="italic text-white/75 font-light"><?= htmlspecialchars(trim($parts[1])) ?></span>
                        <?php endif; ?>
                    </h1>

                    <?php if (!empty($settings['hero_subtitle'])): ?>
                    <p class="text-white/80 font-medium text-sm sm:text-base md:text-xl max-w-2xl mb-10 gs-hero-text drop-shadow-md px-2 sm:px-0">
                        <?= nl2br(htmlspecialchars($settings['hero_subtitle'])) ?>
                    </p>
                    <?php endif; ?>

                    <!-- Action Button -->
                    <div class="gs-hero-text">
                        <button @click="openTicketModal" class="btn bg-white text-charcoal hover:bg-sage hover:text-white border-none rounded-full px-10 shadow-[0_20px_40px_rgba(0,0,0,0.3)] font-bold transition-all flex items-center gap-3 h-14 group">
                            Jelajahi Sekarang 
                            <span class="w-6 h-6 rounded-full bg-charcoal/10 group-hover:bg-white/20 flex items-center justify-center transition-colors">
                                <i class="fi fi-rr-arrow-right text-xs"></i>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Floating Glassmorphism Widget (Wide, Center Bottom) -->
                <div class="absolute bottom-8 md:bottom-12 left-1/2 -translate-x-1/2 gs-hero-text hidden lg:flex w-full max-w-5xl px-6">
                    <!-- Stats Panel -->
                    <div class="bg-white/12 backdrop-blur-2xl border border-white/20 rounded-[2rem] p-6 shadow-[0_30px_60px_rgba(0,0,0,0.25)] flex items-center justify-between text-white w-full">
                        
                        <!-- Item 1: Lokasi -->
                        <div class="flex items-center gap-4 px-4 flex-1 hero-stat-item" style="animation: heroStatIn 0.7s cubic-bezier(0.16,1,0.3,1) both; animation-delay: 0.2s;">
                            <div class="w-12 h-12 rounded-full bg-white/10 text-white flex items-center justify-center border border-white/20">
                                <i class="fi fi-rr-map-marker text-lg"></i>
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-sm font-bold text-white mb-0.5">Kutai Kartanegara</span>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-white/60 font-bold">Kalimantan Timur</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="w-px h-12 bg-white/15 flex-shrink-0"></div>

                        <!-- Item 2: Elevasi -->
                        <div class="flex items-center gap-4 px-4 flex-1 justify-center hero-stat-item" style="animation: heroStatIn 0.7s cubic-bezier(0.16,1,0.3,1) both; animation-delay: 0.35s;">
                            <div class="flex flex-col text-center">
                                <span class="text-3xl font-serif mb-0.5">150<span class="text-sm font-sans text-white/50">m</span></span>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-white/60 font-bold">Elevasi</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="w-px h-12 bg-white/15 flex-shrink-0"></div>

                        <!-- Item 3: Cuaca -->
                        <div class="flex items-center gap-4 px-4 flex-1 justify-center hero-stat-item" style="animation: heroStatIn 0.7s cubic-bezier(0.16,1,0.3,1) both; animation-delay: 0.5s;">
                            <div class="flex flex-col text-center">
                                <span class="text-3xl font-serif mb-0.5">22<span class="text-sm font-sans text-white/50">°C</span></span>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-white/60 font-bold">Rata-rata</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="w-px h-12 bg-white/15 flex-shrink-0"></div>

                        <!-- Item 4: Tiket Masuk -->
                        <div class="flex items-center gap-4 px-4 flex-1 justify-end text-right hero-stat-item" style="animation: heroStatIn 0.7s cubic-bezier(0.16,1,0.3,1) both; animation-delay: 0.65s;">
                            <div class="flex flex-col">
                                <span class="text-3xl font-serif mb-0.5"><?= htmlspecialchars($settings['ticket_price'] ?? '15.000') ?></span>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-white/60 font-bold">Tiket Masuk</span>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-white/10 text-white flex items-center justify-center border border-white/20">
                                <i class="fi fi-rr-ticket text-lg"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- THE STORY (Horizontal Scroll Assembly) -->
        <section id="about" class="pt-16 sm:pt-24 lg:pt-32 pb-8 sm:pb-12 lg:pb-16 relative z-20 bg-[#fbf9f6] overflow-hidden hz-wrapper scroll-mt-20">
            
            <!-- Single Large Centered Blob -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 pointer-events-none w-[110vw] h-[110vw] max-w-[900px] max-h-[900px] opacity-25 mix-blend-multiply text-sage blur-[80px]">
                <svg viewBox="0 0 100 100" class="w-full h-full animate-[spin_50s_linear_infinite]" preserveAspectRatio="none">
                    <path fill="currentColor" d="M50,10 C75,10 90,30 90,50 C90,72 72,90 50,90 C28,90 10,72 10,50 C10,28 25,10 50,10 Z" />
                </svg>
            </div>

            <!-- Section Title -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 gs-bento-title text-center relative z-10">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif text-charcoal leading-[0.95]">
                    Lebih dari sekadar tebing. <br><span class="italic text-charcoal/35">Sebuah mahakarya.</span>
                </h2>
                <?php if (!empty($settings['sejarah_text'])): ?>
                <p class="text-charcoal/60 text-base md:text-lg lg:text-xl font-medium leading-relaxed text-center max-w-2xl mx-auto mt-4 sm:mt-6">
                    <?= nl2br(htmlspecialchars($settings['sejarah_text'])) ?>
                </p>
                <?php endif; ?>
            </div>

            <!-- Horizontal Container -->
            <div class="hz-container w-full md:w-max flex flex-col md:flex-row md:flex-nowrap md:h-[62vh] px-4 sm:px-6 lg:px-10 pb-0 items-center justify-center overflow-visible gap-3 sm:gap-4 md:gap-0">
                
                <!-- CARD 1: Sejarah (Magazine Cover) -->
                <div class="hz-panel-wrapper w-full md:w-[30rem] h-[42vh] sm:h-[50vh] md:h-full flex-shrink-0 md:mx-3 flex items-center justify-center">
                    <div id="gs-card-sejarah" class="w-full h-full rounded-[2rem] relative overflow-hidden group shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-black/5 bg-white flex flex-col p-3 transition-transform duration-500 hover:-translate-y-2">
                        
                        <!-- Header row -->
                        <div class="flex justify-between items-center px-4 py-3 flex-shrink-0">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-charcoal/40"><i class="fi fi-rr-book-alt mr-1.5"></i>Cerita Kami</span>
                            <span class="w-2 h-2 rounded-full bg-sage/50"></span>
                        </div>

                        <!-- Image (fills remaining space) -->
                        <div class="flex-1 w-full relative rounded-[1.5rem] overflow-hidden min-h-0">
                            <img src="<?= htmlspecialchars($settings['why_img1'] ?? 'assets/img/2.webp') ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Tebing Lonceng" loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-transparent to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5 text-white">
                                <h2 class="font-serif text-3xl leading-tight mb-1"><?= htmlspecialchars($settings['acc1_title'] ?? 'Batu Berdering') ?></h2>
                                <p class="text-white/60 text-xs flex items-center gap-1.5"><i class="fi fi-rr-marker"></i><?= htmlspecialchars($settings['acc1_content'] ?? 'Samarinda, Kaltim') ?></p>
                            </div>
                        </div>

                        <!-- CTA -->
                        <a href="views/user/sejarah.php" class="flex-shrink-0 mt-2.5 h-12 w-full rounded-[1rem] bg-charcoal/5 hover:bg-charcoal text-charcoal hover:text-white flex items-center justify-between px-5 transition-colors duration-300 group/cta">
                            <span class="text-[10px] font-bold uppercase tracking-widest">Pelajari Sejarah</span>
                            <i class="fi fi-rr-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD 2: Ulasan (Split Reviews) -->
                <div class="hz-panel-wrapper w-full md:w-[30rem] h-[42vh] sm:h-[50vh] md:h-full flex-shrink-0 md:mx-3 flex items-center justify-center">
                    <div class="w-full h-full rounded-[2rem] bg-white shadow-[0_8px_30px_rgba(0,0,0,0.05)] border border-black/5 flex flex-col overflow-hidden transition-transform duration-500 hover:-translate-y-2">
                        
                        <!-- Review 1 -->
                        <div class="flex-1 flex flex-col items-center justify-center text-center px-8 py-6 relative min-h-0">
                            <div class="w-9 h-9 rounded-xl bg-sage/10 text-sage flex items-center justify-center mb-4 border border-sage/10 flex-shrink-0">
                                <i class="fi fi-rr-quote-right text-xs"></i>
                            </div>
                            <p class="text-base font-serif italic leading-relaxed text-charcoal/75 mb-4">
                                &ldquo;Memandang kota dari keheningan hutan malam hari sungguh luar biasa.&rdquo;
                            </p>
                            <span class="font-bold text-charcoal text-xs">Ratri Indrawati</span>
                            <span class="text-[9px] text-sage font-bold uppercase tracking-widest mt-0.5">Pengunjung</span>
                        </div>

                        <!-- Divider -->
                        <div class="h-px mx-6 bg-black/5 flex-shrink-0"></div>

                        <!-- Review 2 -->
                        <div class="flex-1 flex flex-col items-center justify-center text-center px-8 py-6 relative min-h-0">
                            <div class="w-9 h-9 rounded-xl bg-clay/10 text-clay flex items-center justify-center mb-4 border border-clay/10 flex-shrink-0">
                                <i class="fi fi-rr-quote-right text-xs"></i>
                            </div>
                            <p class="text-base font-serif italic leading-relaxed text-charcoal/75 mb-4">
                                &ldquo;Arsitektur membaur sempurna di tengah alam. Sangat nyaman.&rdquo;
                            </p>
                            <span class="font-bold text-charcoal text-xs">Sari Dewi</span>
                            <span class="text-[9px] text-clay font-bold uppercase tracking-widest mt-0.5">Pengunjung</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Statistik (Bento) -->
                <div class="hz-panel-wrapper w-full md:w-[28rem] h-[42vh] sm:h-[50vh] md:h-full flex-shrink-0 md:mx-3 flex items-center justify-center">
                    <div class="w-full h-full rounded-[2rem] bg-white shadow-[0_8px_30px_rgba(0,0,0,0.05)] border border-black/5 p-3 flex flex-col gap-3 transition-transform duration-500 hover:-translate-y-2">
                        
                        <!-- Main stat -->
                        <div class="flex-1 bg-[#fbf9f6] rounded-[1.5rem] border border-black/5 flex flex-col justify-center items-center text-center relative overflow-hidden min-h-0 p-6">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-sage/8 rounded-bl-full pointer-events-none"></div>
                            <div class="w-10 h-10 rounded-full bg-sage/10 text-sage flex items-center justify-center mb-4 flex-shrink-0">
                                <i class="fi fi-rr-users"></i>
                            </div>
                            <h2 class="text-6xl font-serif text-charcoal leading-none tracking-tighter mb-1"><?= number_format($settings['page_visits'] ?? 10500) ?></h2>
                            <p class="text-charcoal/40 font-bold text-[10px] tracking-widest uppercase">Total Pengunjung</p>
                        </div>

                        <!-- Mini stats row -->
                        <div class="flex gap-3 flex-shrink-0 h-[30%]">
                            <div class="flex-1 bg-[#fbf9f6] rounded-[1.25rem] border border-black/5 flex flex-col justify-center items-center p-4">
                                <i class="fi fi-rr-star text-clay mb-2 text-base"></i>
                                <span class="text-xl font-serif text-charcoal">4.8</span>
                                <span class="text-[9px] font-bold text-charcoal/40 uppercase tracking-widest">Rating</span>
                            </div>
                            <div class="flex-1 bg-charcoal rounded-[1.25rem] flex flex-col justify-center items-center p-4 text-white">
                                <i class="fi fi-rr-camera text-sage mb-2 text-base"></i>
                                <span class="text-xl font-serif">15+</span>
                                <span class="text-[9px] font-bold text-white/50 uppercase tracking-widest">Spot Foto</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: Eksplorasi (Gallery) -->
                <div class="hz-panel-wrapper w-full md:w-[30rem] h-[42vh] sm:h-[50vh] md:h-full flex-shrink-0 md:mx-3 flex items-center justify-center">
                    <div class="w-full h-full rounded-[2rem] bg-white shadow-[0_8px_30px_rgba(0,0,0,0.05)] border border-black/5 p-3 flex flex-col group transition-transform duration-500 hover:-translate-y-2">
                        
                        <!-- Image -->
                        <div class="flex-1 rounded-[1.5rem] overflow-hidden relative min-h-0">
                            <img src="<?= htmlspecialchars($settings['why_img2'] ?? 'assets/img/9.webp') ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Alam Tebing Lonceng" loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition-colors duration-500"></div>
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-bold text-charcoal tracking-widest uppercase">
                                    <i class="fi fi-rr-sparkles text-sage"></i> Eksplorasi
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="flex-shrink-0 px-2 pt-4 pb-2 flex items-end justify-between gap-4">
                            <div>
                                <h3 class="text-charcoal text-xl font-serif leading-tight mb-2"><?= htmlspecialchars($settings['acc2_title'] ?? 'Menyatu dengan Alam Bebas.') ?></h3>
                                <div class="flex flex-wrap gap-1.5">
                                    <span class="px-2.5 py-1 rounded-full bg-[#fbf9f6] border border-black/5 text-charcoal/60 text-[9px] font-bold uppercase tracking-wide"><?= htmlspecialchars($settings['acc2_content'] ?? 'View Point, Camping, Cafe') ?></span>
                                </div>
                            </div>
                            <a href="#fasilitas" class="flex-shrink-0 w-10 h-10 rounded-full bg-charcoal/5 hover:bg-sage text-charcoal hover:text-white flex items-center justify-center transition-colors">
                                <i class="fi fi-rr-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 5: Lokasi / Maps -->
                <div class="hz-panel-wrapper w-full md:w-[50vw] h-[42vh] sm:h-[50vh] md:h-full flex-shrink-0 md:mx-3 flex items-center justify-start relative group">
                    <div class="gs-morph-map w-full md:w-[30rem] h-full rounded-[2rem] relative overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-black/5 bg-white p-2 transition-transform duration-500 hover:-translate-y-2">
                        <div class="w-full h-full rounded-[1.5rem] relative overflow-hidden">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6446711280446!2d117.14593617496467!3d-0.5345631994602018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f903394186d%3A0xc52a1a192e9072d!2sWisata%20tebing%20lonceng!5e0!3m2!1sid!2sid!4v1777060800960!5m2!1sid!2sid"
                                class="absolute inset-0 w-full h-full grayscale-[20%] opacity-90 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700"
                                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                            <!-- Floating card -->
                            <div class="absolute bottom-4 left-4 right-4 md:right-auto md:w-72 bg-white/95 backdrop-blur-md rounded-2xl p-5 border border-black/5 shadow-xl transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-sage/10 rounded-full text-[9px] font-bold text-sage tracking-widest uppercase mb-3 border border-sage/15">
                                    <i class="fi fi-rr-map-marker"></i> Lokasi
                                </span>
                                <h3 class="text-charcoal font-serif text-xl leading-tight mb-1">Wisata Tebing Lonceng</h3>
                                <p class="text-charcoal/50 text-xs">Samarinda, Kalimantan Timur</p>
                                <a href="https://maps.google.com/maps?ll=-0.534563,117.145936&z=15&t=m&hl=id&gl=ID&mapclient=embed&cid=14207137839352656685"
                                   target="_blank"
                                   class="mt-3 w-full h-9 rounded-xl bg-charcoal text-white hover:bg-sage text-[10px] font-bold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
                                    Buka di Peta <i class="fi fi-rr-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>



        <!-- HOMESTAY HIGHLIGHT SECTION — Split Layout & Gallery -->
        <section id="homestay" class="py-12 sm:py-16 lg:py-28 bg-[#fbf9f6] relative font-sans border-t border-black/5 overflow-hidden">
            
            <div class="max-w-[1400px] mx-auto px-4 lg:px-8 relative z-10">
                
                <!-- SECTION 1: Top Split Layout -->
                <div class="bg-gradient-to-br from-[#e9ece6] to-[#f4f5f0] rounded-[1.5rem] sm:rounded-[2rem] lg:rounded-[2.5rem] p-5 sm:p-6 lg:p-12 mb-6 sm:mb-8 shadow-sm border border-black/5 gs-hs-top">
                    <div class="flex flex-col lg:flex-row gap-8 sm:gap-12 lg:gap-16 items-stretch">
                        
                        <!-- Left: Text & Details -->
                        <div class="w-full lg:w-1/2 flex flex-col">
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/50 rounded-full text-[10px] font-black text-charcoal/60 tracking-[0.2em] uppercase mb-8 border border-black/5 w-max shadow-sm gs-hs-stagger">
                                <i class="fi fi-rr-bed text-sage"></i> Akomodasi Premium
                            </div>
                            
                            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-serif text-charcoal leading-[1.1] mb-6 sm:mb-8 gs-hs-stagger">
                                <?= $settings['hs_title'] ?? 'Kenyamanan di Balik<br><span class="italic text-sage">Tebing Lonceng.</span>' ?>
                            </h2>
                            


                            <!-- Stats / Mini Info -->
                            <div class="flex flex-wrap items-center gap-6 md:gap-10 mb-10 pt-6 border-t border-black/10 gs-hs-stagger">
                                <div>
                                    <div class="text-4xl font-serif text-charcoal leading-none mb-1"><?= htmlspecialchars($settings['hs_stat_rating'] ?? '4.9') ?></div>
                                    <div class="flex text-sage text-[10px] mb-2">
                                        <i class="fi fi-sr-star"></i><i class="fi fi-sr-star"></i><i class="fi fi-sr-star"></i><i class="fi fi-sr-star"></i><i class="fi fi-sr-star"></i>
                                    </div>
                                    <div class="text-[9px] font-black text-charcoal/40 uppercase tracking-widest">Rating</div>
                                </div>
                                <div class="w-px h-12 bg-black/10 hidden sm:block"></div>
                                <div>
                                    <div class="text-4xl font-serif text-charcoal leading-none mb-3"><?= htmlspecialchars($settings['hs_stat_kabin'] ?? '6') ?><span class="text-lg font-sans text-charcoal/50 ml-1">Unit</span></div>
                                    <div class="text-[9px] font-black text-charcoal/40 uppercase tracking-widest">Kabin Tersedia</div>
                                </div>
                                <div class="w-px h-12 bg-black/10 hidden sm:block"></div>
                                <div>
                                    <div class="text-4xl font-serif text-charcoal leading-none mb-3"><?= htmlspecialchars($settings['hs_stat_privasi'] ?? '100') ?><span class="text-lg font-sans text-charcoal/50 ml-1">%</span></div>
                                    <div class="text-[9px] font-black text-charcoal/40 uppercase tracking-widest">Privasi</div>
                                </div>
                            </div>
                            
                            <!-- CTA -->
                            <div class="mt-auto gs-hs-stagger">
                                <a href="<?= htmlspecialchars($settings['hs_wa_link'] ?? 'https://wa.me/6281234567890?text=Halo%20Tebing%20Lonceng,%20saya%20ingin%20reservasi%20Homestay') ?>" target="_blank"
                                   class="btn bg-charcoal hover:bg-black text-white rounded-full px-8 h-14 font-bold border-none shadow-xl w-full sm:w-max flex items-center justify-center gap-2 group transition-all duration-300">
                                    Reservasi via WhatsApp <i class="fi fi-brands-whatsapp text-xl group-hover:scale-110 transition-transform"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Right: Single Photo -->
                        <div class="w-full lg:w-1/2 min-h-[400px] lg:min-h-0 rounded-[2rem] overflow-hidden relative shadow-lg gs-hs-img">
                            <img src="<?= htmlspecialchars($settings['why_img3'] ?? 'assets/img/18.webp') ?>" class="absolute inset-0 w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" alt="Homestay Exterior">
                            <div class="absolute top-6 right-6 bg-white/80 backdrop-blur-md px-4 py-2 rounded-full flex items-center gap-2 shadow-sm border border-white">
                                <i class="fi fi-rr-map-marker text-sage"></i>
                                <span class="text-xs font-bold text-charcoal">Puncak Lonceng</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Bottom GSAP Infinite Photo Slider (13 Photos) -->
                <div class="bg-charcoal rounded-[2.5rem] overflow-hidden relative h-[500px] lg:h-[650px] shadow-2xl gs-hs-bottom">
                    <!-- Text Overlay -->
                    <div class="absolute top-8 left-8 lg:top-16 lg:left-16 z-30 pointer-events-none">
                        <div class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-bold text-white uppercase tracking-widest border border-white/20 mb-4">
                            Galeri Penginapan
                        </div>
                        <h3 class="text-3xl sm:text-4xl lg:text-6xl font-serif text-white leading-tight drop-shadow-lg">
                            Dibuat untuk <br>
                            <span class="text-white/80 italic">Kenyamanan Maksimal</span>
                        </h3>
                        <p class="text-white/60 text-sm max-w-sm mt-4 font-light hidden md:block drop-shadow-md">
                            Tempat sempurna untuk melarikan diri dari hiruk-pikuk. Didesain untuk kehangatan, privasi, dan ketenangan eksklusif.
                        </p>
                    </div>

                    <!-- GSAP Infinite Crossfade/Slider Container -->
                    <div class="absolute inset-0 w-full h-full z-10" id="hs-gallery-container">
                        <?php
                            // Create array of 13 photo paths
                            $hsPhotos = [
                                'assets/img/homestay/469390718_17862767727280973_2912449291745634007_n.webp',
                                'assets/img/homestay/469392789_17862767697280973_8318963987170591255_n.webp',
                                'assets/img/homestay/469393397_17862767688280973_7043710755400830458_n.webp',
                                'assets/img/homestay/469393547_17862767745280973_7677774158370740605_n.webp',
                                'assets/img/homestay/469398378_17862767784280973_4058428778361421462_n.webp',
                                'assets/img/homestay/469398380_17862767679280973_8502226815926224758_n.webp',
                                'assets/img/homestay/469399130_17862767793280973_1765742043319571219_n.webp',
                                'assets/img/homestay/469399969_17862767775280973_7662738207444512433_n.webp',
                                'assets/img/homestay/469400792_17862767757280973_3024967700740938499_n.webp',
                                'assets/img/homestay/469400857_17862767706280973_2611578547626869705_n.webp',
                                'assets/img/homestay/469401815_17862767766280973_4030987913658677620_n.webp',
                                'assets/img/homestay/469401819_17862767736280973_3505665011052635112_n.webp',
                                'assets/img/homestay/469497021_17862767718280973_1991406275268222293_n.webp'
                            ];
                            foreach($hsPhotos as $index => $photo):
                        ?>
                        <div class="absolute inset-0 w-full h-full hs-gallery-slide opacity-0 overflow-hidden" style="visibility: hidden;">
                            <!-- The image inside a wrapper so we can scale it while clipping -->
                            <img src="<?= $photo ?>" class="w-full h-full object-cover hs-gallery-img" alt="Gallery Photo <?= $index + 1 ?>">
                            <!-- Dark gradient overlay for text readability -->
                            <div class="absolute inset-0 bg-gradient-to-b from-[#0e110d]/70 via-transparent to-[#0e110d]/40"></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Progress indicators -->
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex gap-2 p-3 bg-black/20 backdrop-blur-md rounded-full border border-white/10">
                        <?php foreach($hsPhotos as $index => $photo): ?>
                        <div class="w-1.5 h-1.5 lg:w-2 lg:h-2 rounded-full bg-white/30 hs-gallery-dot transition-all duration-300"></div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </section>


        <!-- THE EXPERIENCE (Horizontal Marquee & Glass Cards) -->
        <!-- ══════════════════════════════════════════════════════════════ -->
        <!-- THE EXPERIENCE — Bento Grid                                   -->
        <!-- ══════════════════════════════════════════════════════════════ -->
        <!-- ══════════════════════════════════════════════════════════════ -->
        <!-- THE EXPERIENCE — Infinite Cards                               -->
        <!-- ══════════════════════════════════════════════════════════════ -->
        <section id="fasilitas" class="border-t border-black/5 relative py-16 sm:py-24 lg:py-32 overflow-hidden font-sans">
            <?php
                $carouselCards = array_values($fasilitas ?? []);
                if (empty($carouselCards)) {
                    $carouselCards = [
                        ['gambar' => 'assets/img/2.webp',  'nama' => 'Tebing Utama',  'deskripsi' => 'Titik pandang ikonik setinggi 150m — sempurna untuk bersantai.'],
                        ['gambar' => 'assets/img/5.webp',  'nama' => 'Panorama 180°', 'deskripsi' => 'Hamparan latar kota Samarinda dari ketinggian yang memukau.'],
                        ['gambar' => 'assets/img/9.webp',  'nama' => 'Koridor Hijau', 'deskripsi' => 'Jalur rindang nan alami menuju puncak tebing.'],
                        ['gambar' => 'assets/img/11.webp', 'nama' => 'Spot Senja',    'deskripsi' => 'Area lapang terbuka menanti golden hour.'],
                        ['gambar' => 'assets/img/3.webp',  'nama' => 'Cafe Alam',     'deskripsi' => 'Nikmati kopi hangat di tengah sejuknya udara perbukitan.'],
                    ];
                }
                
                // Duplicate array to ensure infinite seamless scrolling fills the screen
                $infiniteCards = array_merge($carouselCards, $carouselCards, $carouselCards);
            ?>

            <div class="text-center mb-10 sm:mb-16 relative z-20 gs-ulasan px-4 sm:px-6">
                <p class="text-sage text-xs font-black tracking-[0.3em] uppercase mb-4">Fasilitas & Spot</p>
                <h2 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-serif text-charcoal mb-4 sm:mb-6 leading-tight max-w-4xl mx-auto">
                    Eksplorasi Ruang <span class="italic text-sage/80">Ikonik.</span>
                </h2>
                <p class="text-charcoal/60 text-base md:text-lg lg:text-xl font-medium leading-relaxed text-center max-w-2xl mx-auto">Beragam spot eksklusif yang dirancang untuk memanjakan visual dan menghadirkan ketenangan.</p>
            </div>

            <!-- Infinite Scroll Container -->
            <div class="relative w-full flex items-center overflow-hidden h-[450px] md:h-[500px]" id="infinite-container">
                <!-- Fade Gradients at Edges for a premium look -->
                <div class="absolute left-0 top-0 bottom-0 w-16 md:w-40 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 bottom-0 w-16 md:w-40 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
                
                <!-- The Marquee Track -->
                <div class="flex gs-infinite-track whitespace-nowrap w-max py-4">
                    <!-- Set 1 -->
                    <div class="flex gap-6 md:gap-8 pr-6 md:pr-8 flex-shrink-0">
                        <?php foreach($carouselCards as $idx => $f): ?>
                            <div class="group relative w-[280px] h-[400px] md:w-[320px] md:h-[460px] rounded-[2.5rem] overflow-hidden flex-shrink-0 bg-gray-200 cursor-pointer shadow-xl hover:shadow-2xl transition-all duration-500 transform-gpu gs-infinite-card border border-black/5">
                                
                                <!-- Background Image -->
                                <img src="<?= htmlspecialchars($f['gambar'] ?? '') ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" alt="<?= htmlspecialchars($f['nama'] ?? '') ?>" loading="lazy" decoding="async">
                                
                                <!-- Top Gradient Overlay (Frosted Glass Base for Text) -->
                                <div class="absolute top-0 left-0 right-0 h-3/5 bg-gradient-to-b from-[#1a2018]/80 via-[#1a2018]/30 to-transparent z-10 pointer-events-none mix-blend-multiply transition-opacity duration-500 group-hover:opacity-90"></div>
                                <div class="absolute top-0 left-0 right-0 h-1/2 bg-gradient-to-b from-black/40 to-transparent z-10 pointer-events-none"></div>
                                
                                <!-- Content Layer -->
                                <div class="absolute inset-0 z-20 p-6 md:p-8 flex flex-col pointer-events-none">
                                    
                                    <!-- Top Left Texts -->
                                    <div class="pr-12 md:pr-14"> <!-- Leave space for cutout -->
                                        <h3 class="text-white text-2xl md:text-3xl font-serif font-medium mb-1 drop-shadow-md whitespace-normal leading-tight"><?= htmlspecialchars($f['nama'] ?? '') ?></h3>
                                        <p class="text-white/80 text-xs md:text-sm font-light leading-relaxed line-clamp-2 drop-shadow-sm mb-4 whitespace-normal">
                                            <?= htmlspecialchars($f['deskripsi'] ?? '') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Set 2 (Duplicate for looping) -->
                    <div class="flex gap-6 md:gap-8 pr-6 md:pr-8 flex-shrink-0" aria-hidden="true">
                        <?php foreach($carouselCards as $idx => $f): ?>
                            <div class="group relative w-[280px] h-[400px] md:w-[320px] md:h-[460px] rounded-[2.5rem] overflow-hidden flex-shrink-0 bg-gray-200 cursor-pointer shadow-xl hover:shadow-2xl transition-all duration-500 transform-gpu gs-infinite-card border border-black/5">
                                
                                <!-- Background Image -->
                                <img src="<?= htmlspecialchars($f['gambar'] ?? '') ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" alt="<?= htmlspecialchars($f['nama'] ?? '') ?>" loading="lazy" decoding="async">
                                
                                <!-- Top Gradient Overlay (Frosted Glass Base for Text) -->
                                <div class="absolute top-0 left-0 right-0 h-3/5 bg-gradient-to-b from-[#1a2018]/80 via-[#1a2018]/30 to-transparent z-10 pointer-events-none mix-blend-multiply transition-opacity duration-500 group-hover:opacity-90"></div>
                                <div class="absolute top-0 left-0 right-0 h-1/2 bg-gradient-to-b from-black/40 to-transparent z-10 pointer-events-none"></div>
                                
                                <!-- Content Layer -->
                                <div class="absolute inset-0 z-20 p-6 md:p-8 flex flex-col pointer-events-none">
                                    
                                    <!-- Top Left Texts -->
                                    <div class="pr-12 md:pr-14"> <!-- Leave space for cutout -->
                                        <h3 class="text-white text-2xl md:text-3xl font-serif font-medium mb-1 drop-shadow-md whitespace-normal leading-tight"><?= htmlspecialchars($f['nama'] ?? '') ?></h3>
                                        <p class="text-white/80 text-xs md:text-sm font-light leading-relaxed line-clamp-2 drop-shadow-sm mb-4 whitespace-normal">
                                            <?= htmlspecialchars($f['deskripsi'] ?? '') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 flex justify-center w-full z-20 relative">
                <div class="flex items-center gap-4 text-xs font-bold tracking-widest text-gray-400 uppercase">
                    <i class="fi fi-rr-arrow-left text-sage opacity-50"></i>
                    <span>Infinite Scroll</span>
                    <i class="fi fi-rr-arrow-right text-sage opacity-50"></i>
                </div>
            </div>
        </section>


        <!-- THE PROOF (Ulasan) — Infinite Marquee + Submission Form -->

        <section id="reviews" class="pt-16 sm:pt-24 lg:pt-32 pb-20 sm:pb-28 lg:pb-40 bg-base overflow-hidden relative">

            <?php
                // DB columns: id, nama, kesan, created_at
                $baseReviews = !empty($reviews) ? $reviews : [
                    ['nama' => 'Ratri Indrawati', 'kesan' => 'Memandang kota dari keheningan hutan malam hari sungguh luar biasa.'],
                    ['nama' => 'Budi Santoso',    'kesan' => 'Pemandangan senja adalah karya seni alam yang tak ternilai harganya.'],
                    ['nama' => 'Sari Dewi',       'kesan' => 'Arsitektur membaur sempurna di tengah alam. Sangat nyaman.'],
                    ['nama' => 'Andi Pratama',    'kesan' => 'Sangat sepadan. Kopi di cafe-nya nikmat dan viewnya luar biasa!'],
                    ['nama' => 'Rina Anggraini',  'kesan' => 'Spot fotonya luar biasa banyak dan sangat estetik. Wajib balik!'],
                    ['nama' => 'Dwi Susanto',     'kesan' => 'Cocok untuk healing dari hiruk pikuk kota. Suasananya damai.'],
                    ['nama' => 'Maya Sari',       'kesan' => 'Homestay eksklusifnya sangat nyaman dan privat. Recommended!'],
                ];
                
                // Duplicate reviews to create enough cards for a full 360-degree circle (7 * 3 = 21 cards)
                // Reducing total cards while keeping a massive radius spreads them out enormously.
                $reviewsData = [];
                for ($i = 0; $i < 4; $i++) {
                    $reviewsData = array_merge($reviewsData, $baseReviews);
                }
                $totalArch = count($reviewsData);
            ?>

            <!-- ── Swiper Testimonials (Infinite Scroll & Centered) ── -->
            <div class="w-full max-w-6xl mx-auto mt-6 sm:mt-10 z-10 relative px-4 sm:px-6">
                
                <div class="text-center relative mb-12 sm:mb-20 px-4 sm:px-6">

                    <div class="relative z-10 gs-arch-text flex flex-col items-center">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-clay/10 rounded-full text-[10px] font-black text-clay tracking-[0.2em] uppercase mb-4 border border-clay/20 shadow-sm">
                            <i class="fi fi-rr-star"></i> Ulasan Pengunjung
                        </div>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif text-charcoal tracking-tight text-center mb-4">Kesan Mereka</h3>
                        <p class="text-charcoal/60 text-base md:text-lg lg:text-xl font-medium leading-relaxed text-center max-w-2xl">
                            Kumpulan momen indah yang diabadikan oleh para pengunjung di Tebing Lonceng.
                        </p>
                    </div>
                </div>

                <div class="relative w-full mt-10 gs-arch-ring">
                    <swiper-container 
                        init="false"
                        class="review-swiper"
                        id="reviewSwiper"
                    >
                        <?php foreach($baseReviews as $idx => $rev): ?>
                        <swiper-slide class="py-12">
                            <div class="review-inner-card relative bg-white rounded-[2rem] p-8 md:p-12 flex flex-col items-center justify-center text-center h-full min-h-[320px] shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_15px_40px_rgba(0,0,0,0.08)] hover:-translate-y-2 transition-transform duration-500 border border-black/5 group">

                                <!-- Quote Text -->
                                <div class="flex-grow flex flex-col justify-center w-full">
                                    <p class="text-[17px] md:text-[19px] font-serif italic leading-relaxed text-charcoal/80 mb-6">
                                        &ldquo;<?= htmlspecialchars($rev['kesan'] ?? '') ?>&rdquo;
                                    </p>
                                </div>

                                <!-- User Info -->
                                <div class="flex flex-col items-center flex-shrink-0 mt-auto pt-4 border-t border-black/5 w-2/3">
                                    <span class="font-bold text-charcoal text-sm md:text-[15px]"><?= htmlspecialchars($rev['nama'] ?? '') ?></span>
                                    <span class="text-[10px] text-sage font-bold uppercase tracking-widest mt-1">Pengunjung</span>
                                </div>
                            </div>
                        </swiper-slide>
                        <?php endforeach; ?>
                    </swiper-container>
                </div>
            </div>

            <!-- ── Review Submission Form ── -->
            <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 mt-20 gs-review-form">
                <div class="bg-white rounded-[2rem] sm:rounded-[2.5rem] border border-black/5 shadow-[0_20px_60px_rgba(0,0,0,0.07)] p-6 sm:p-8 md:p-12">

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- ── STATE: LOGGED IN — Tampilkan form ulasan ── -->
                    <!-- User info bar + logout -->
                    <div class="flex items-center justify-between mb-8 pb-6 border-b border-black/5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-sage/10 text-sage flex items-center justify-center font-bold text-xl border border-sage/15 font-serif">
                                <?= strtoupper(substr($_SESSION['user_nama'] ?? 'U', 0, 1)) ?>
                            </div>
                            <div>
                                <p class="font-bold text-charcoal text-sm leading-tight"><?= htmlspecialchars($_SESSION['user_nama'] ?? '') ?></p>
                                <p class="text-charcoal/40 text-xs mt-0.5"><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></p>
                            </div>
                        </div>
                        <a href="actions/user/logout.php"
                           class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-charcoal/40 hover:text-charcoal transition-colors px-4 py-2 rounded-full hover:bg-black/5 border border-transparent hover:border-black/8">
                            <i class="fi fi-rr-exit"></i> Keluar
                        </a>
                    </div>

                    <div class="text-center mb-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-sage/10 rounded-full text-[10px] font-black text-sage tracking-[0.2em] uppercase mb-4 border border-sage/15">
                            <i class="fi fi-rr-pencil text-[10px]"></i> Bagikan Pengalaman
                        </div>
                        <h3 class="text-3xl md:text-4xl font-serif text-charcoal mb-3">Tulis Ulasan</h3>
                        <p class="text-charcoal/50 text-sm">Cerita Anda menginspirasi pengunjung berikutnya.</p>
                    </div>

                    <?php if (!empty($_SESSION['auth_error'])): ?>
                        <div class="mb-6 px-4 py-3 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-sm text-center font-medium">
                            <?= htmlspecialchars($_SESSION['auth_error']) ?>
                            <?php unset($_SESSION['auth_error']); ?>
                        </div>
                    <?php endif; ?>

                    <form id="review-form" action="actions/user/tambah_review.php" method="POST" class="flex flex-col gap-6">
                        <!-- Rating Removed -->
                        <input type="hidden" name="rating" value="5" />
                        
                        <!-- Textarea -->
                        <div>
                            <label class="text-[10px] uppercase font-bold tracking-widest text-charcoal/50 mb-2 block">Kesan & Pesan</label>
                            <textarea name="kesan" class="textarea w-full bg-charcoal/[0.02] border border-black/10 rounded-2xl text-charcoal placeholder:text-charcoal/30 focus:border-sage focus:bg-white transition-colors resize-none text-base md:text-lg font-serif italic leading-relaxed min-h-[140px] p-5 shadow-inner" placeholder="&ldquo;Ceritakan momen tak terlupakan Anda di Tebing Lonceng...&rdquo;" required minlength="20"></textarea>
                        </div>
                        <!-- Error message -->
                        <div id="review-error-msg" class="hidden px-4 py-3 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-sm text-center font-medium"></div>
                        <!-- Submit -->
                        <button type="submit" id="review-submit-btn" class="w-full h-14 bg-charcoal hover:bg-sage text-white rounded-2xl font-bold tracking-wide transition-all duration-300 flex items-center justify-center gap-3 shadow-lg group">
                            <span id="review-btn-text">Kirim Ulasan</span>
                            <i class="fi fi-rr-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>
                    <!-- Success state (pending approval) -->
                    <div id="review-success" class="hidden text-center py-6">
                        <div class="w-16 h-16 bg-clay/10 text-clay rounded-full flex items-center justify-center mb-4 mx-auto text-2xl"><i class="fi fi-rr-time-past"></i></div>
                        <h4 class="text-2xl font-serif text-charcoal mb-2">Ulasan Diterima!</h4>
                        <p class="text-charcoal/50 text-sm max-w-xs mx-auto leading-relaxed">Terima kasih atas ulasan Anda. Ulasan sedang <strong class="text-clay">menunggu persetujuan admin</strong> sebelum ditampilkan kepada publik.</p>
                    </div>

                <?php else: ?>
                    <!-- ── STATE: GUEST — Tampilkan login gate ── -->
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-clay/10 rounded-full text-[10px] font-black text-clay tracking-[0.2em] uppercase mb-4 border border-clay/20">
                            <i class="fi fi-rr-lock text-[10px]"></i> Login untuk Mengulas
                        </div>
                        <h3 class="text-3xl md:text-4xl font-serif text-charcoal mb-3">Tulis Ulasan</h3>
                        <p class="text-charcoal/50 text-sm">Masuk dengan email Anda — akun dibuat otomatis jika belum terdaftar.</p>
                    </div>

                    <?php if (!empty($_SESSION['auth_error'])): ?>
                        <div class="mb-6 px-4 py-3 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-sm text-center font-medium">
                            <?= htmlspecialchars($_SESSION['auth_error']) ?>
                            <?php unset($_SESSION['auth_error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="actions/user/login.php" method="POST" class="flex flex-col gap-5">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <label class="text-[10px] uppercase font-black tracking-widest text-charcoal/40 mb-2 block">Email</label>
                                <label class="input w-full bg-[#fbf9f6] border border-black/8 rounded-2xl text-charcoal focus-within:border-sage/60 transition-colors">
                                    <svg class="h-[1em] opacity-40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                                    <input type="email" name="email" placeholder="email@anda.com" required class="bg-transparent text-charcoal placeholder:text-charcoal/30" />
                                </label>
                            </div>
                            <div class="flex-1">
                                <label class="text-[10px] uppercase font-black tracking-widest text-charcoal/40 mb-2 block">Password</label>
                                <label class="input w-full relative bg-[#fbf9f6] border border-black/8 rounded-2xl text-charcoal focus-within:border-sage/60 transition-colors">
                                    <svg class="h-[1em] opacity-40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Min. 6 karakter" required minlength="6" class="bg-transparent w-full text-charcoal placeholder:text-charcoal/30 pr-10" />
                                    <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-charcoal/40 hover:text-charcoal transition-colors">
                                        <i :class="showPassword ? 'fi fi-rr-eye-crossed' : 'fi fi-rr-eye'"></i>
                                    </button>
                                </label>
                            </div>
                        </div>
                        <p class="text-charcoal/35 text-xs text-center -mt-1">
                            <i class="fi fi-rr-info mr-1"></i>Belum punya akun? Daftar otomatis saat pertama login.
                        </p>
                        <button type="submit" class="w-full h-14 bg-charcoal hover:bg-sage text-white rounded-2xl font-bold tracking-wide transition-all duration-300 flex items-center justify-center gap-3 shadow-lg group">
                            <i class="fi fi-rr-user text-sm"></i>
                            <span>Masuk &amp; Lanjut Ulasan</span>
                            <i class="fi fi-rr-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>
                <?php endif; ?>

                </div>
            </div>

        </section>

        <!-- CTA GALERI KOMUNITAS -->
        <section id="cta-galeri" class="py-8 sm:py-12 relative font-sans border-t border-black/5 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="bg-gradient-to-r from-sage/10 to-[#f4f5f0] rounded-[1.5rem] sm:rounded-[2.5rem] lg:rounded-[3rem] p-6 sm:p-10 md:p-14 border border-sage/15 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 sm:gap-8 relative overflow-hidden group">
                    <!-- Decor -->
                    <div class="absolute right-0 top-0 w-64 h-64 bg-sage/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/4 pointer-events-none group-hover:scale-125 transition-transform duration-1000"></div>
                    
                    <div class="flex-1 max-w-2xl relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-sage/10 rounded-full text-[10px] font-black text-sage tracking-[0.2em] uppercase mb-4 sm:mb-5 border border-sage/20">
                            <i class="fi fi-rr-camera"></i> Galeri Komunitas
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-serif text-charcoal leading-tight mb-3 sm:mb-4">
                            Punya kenangan visual yang tak terlupakan?
                        </h2>
                        <p class="text-charcoal/60 text-base md:text-lg lg:text-xl font-medium leading-relaxed">
                            Bagikan jepretan terbaik Anda di Tebing Lonceng. Momen Anda berharga dan bisa menginspirasi banyak pengunjung lainnya.
                        </p>
                    </div>
                    
                    <div class="relative z-10 flex-shrink-0 w-full sm:w-auto">
                        <a href="views/user/galeri.php" class="btn bg-charcoal hover:bg-sage text-white rounded-full px-6 sm:px-8 h-12 sm:h-14 font-bold border-none shadow-[0_15px_30px_rgba(0,0,0,0.15)] flex items-center justify-center gap-3 transition-all duration-300 group/btn w-full sm:w-auto">
                            Bagikan Momen Anda 
                            <i class="fi fi-rr-arrow-up-right text-sm group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- THE SOCIAL MEDIA PROMO -->

        <!-- ══════════════════════════════════════════════════════════════ -->
        <section id="social-media" class="py-10 sm:py-16 lg:py-20 font-sans px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto bg-[#133c2a] rounded-[2rem] sm:rounded-[3rem] p-6 sm:p-10 md:p-16 lg:p-20 flex flex-col md:flex-row items-center justify-between gap-8 sm:gap-12 overflow-hidden relative shadow-2xl">
                
                <!-- Blurred Background Image -->
                <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
                    <img src="assets/img/2.webp" class="w-full h-full object-cover blur-xl scale-110 opacity-40 mix-blend-luminosity" alt="Background Blur">
                </div>

                <!-- Left Content -->
                <div class="flex-1 text-white z-10 relative">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif mb-4 sm:mb-6 leading-tight">
                        Tetap Terhubung <br>dengan <span class="italic text-sage">Kami.</span>
                    </h2>
                    <p class="text-white/80 font-medium text-sm sm:text-base md:text-lg max-w-md mb-6 sm:mb-10 leading-relaxed">
                        Ikuti perjalanan visual kami, dapatkan info terbaru, dan bagikan momen liburan Anda di Tebing Lonceng.
                    </p>
                    <a href="https://www.instagram.com/tebinglonceng_official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="inline-flex items-center gap-3 bg-white text-[#133c2a] px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold text-sm uppercase tracking-widest hover:bg-sage transition-all duration-300 group shadow-xl">
                        Ikuti Instagram
                        <i class="fi fi-rr-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Right Mockup: Dual Phones — hidden on small mobile, visible from sm -->
                <div class="flex-shrink-0 z-10 relative w-full sm:w-[320px] md:w-[400px] h-[320px] sm:h-[420px] md:h-[550px] hidden sm:flex justify-center mt-8 md:mt-0">
                    
                    <!-- Back Phone (Image) -->
                    <div class="absolute right-0 md:-right-8 top-8 sm:top-12 md:top-24 mockup-phone border-white/60 bg-black shadow-2xl transform rotate-12 hover:rotate-6 transition-transform duration-700 w-[160px] sm:w-[200px] md:w-[240px] z-10 opacity-80 hover:opacity-100">
                      <div class="mockup-phone-camera"></div>
                      <div class="mockup-phone-display">
                        <img alt="Instagram Tebing Lonceng" src="assets/img/phone/Screen Shot 2026-04-25 at 20.52.57.png" class="w-full h-full object-cover" />
                      </div>
                    </div>

                    <!-- Front Phone (Video) -->
                    <div class="absolute left-4 sm:left-8 md:left-0 top-0 mockup-phone border-white bg-black shadow-2xl transform -rotate-6 hover:rotate-0 transition-transform duration-700 w-[190px] sm:w-[240px] md:w-[280px] z-20">
                      <div class="mockup-phone-camera"></div>
                      <div class="mockup-phone-display">
                        <video autoplay loop muted playsinline class="w-full h-full object-cover">
                            <source src="assets/vd/promo.webm" type="video/mp4">
                        </video>
                      </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <!-- THE CALL (Minimalist Footer) -->
    <footer class="bg-base border-t border-charcoal/10 pt-12 sm:pt-16 lg:pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-charcoal mb-6 sm:mb-8 gs-ulasan">Siap untuk <span class="italic text-sage">Eksplorasi?</span></h2>

            <!-- DaisyUI 3D Hover Card -->
            <div class="hover-3d mb-10 gs-ulasan w-full max-w-2xl">
                <figure class="w-full rounded-2xl overflow-hidden shadow-2xl">
                    <img src="assets/img/card/card.png" alt="Tebing Lonceng Card" class="w-full h-auto" />
                </figure>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

            <button @click="openTicketModal" class="btn bg-charcoal hover:bg-sage text-base border-none rounded-full px-12 py-4 h-auto text-lg shadow-2xl font-bold transition-all mb-12 gs-ulasan">
                Pesan Tiket Kunjungan
            </button>

            <!-- Ticket Pricing Row -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-6 sm:gap-10 md:gap-16 lg:gap-24 border-t border-charcoal/10 pt-8 sm:pt-12 mb-12 sm:mb-20 w-full gs-ulasan">
                <div class="flex flex-col items-center">
                    <span class="text-charcoal font-serif text-3xl md:text-4xl mb-1">Rp <?= htmlspecialchars($settings['ticket_price'] ?? '10.000') ?></span>
                    <span class="text-charcoal/40 text-[10px] md:text-xs font-bold uppercase tracking-widest">Wisatawan Umum</span>
                </div>
                <div class="w-12 h-px md:w-px md:h-12 bg-charcoal/10"></div>
                <div class="flex flex-col items-center">
                    <span class="text-charcoal font-serif text-3xl md:text-4xl mb-1">Rp <?= htmlspecialchars($settings['ticket_price_student'] ?? '5.000') ?></span>
                    <span class="text-charcoal/40 text-[10px] md:text-xs font-bold uppercase tracking-widest">Pelajar / Mahasiswa</span>
                </div>
                <div class="w-12 h-px md:w-px md:h-12 bg-charcoal/10"></div>
                <div class="flex flex-col items-center">
                    <span class="text-charcoal font-serif text-3xl md:text-4xl mb-1"><?= (isset($settings['ticket_price_child']) && strtolower($settings['ticket_price_child']) === 'gratis') ? 'Gratis' : 'Rp ' . htmlspecialchars($settings['ticket_price_child'] ?? '0') ?></span>
                    <span class="text-charcoal/40 text-[10px] md:text-xs font-bold uppercase tracking-widest">Anak Usia &lt; 5 Tahun</span>
                </div>
            </div>

            <div class="w-full flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0 border-t border-charcoal/10 pt-6 sm:pt-8 text-charcoal/50 text-xs font-bold tracking-widest uppercase">
                <p>Tebing Lonceng Resort © <?= date('Y') ?></p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-charcoal transition-colors">Instagram</a>
                    <a href="#" class="hover:text-charcoal transition-colors">WhatsApp</a>
                    <a href="#" class="hover:text-charcoal transition-colors">Maps</a>
                </div>
            </div>
        </div>
    </footer>



    <!-- VUE TICKET MODAL -->
    <Transition name="fade">
        <div v-if="isTicketModalOpen" class="fixed inset-0 flex items-center justify-center bg-charcoal/60 backdrop-blur-sm p-4" style="z-index: 9999;" @click="closeTicketModal">
            <div class="bg-[#FBF9F6] w-full max-w-lg rounded-[1.5rem] sm:rounded-[2rem] md:rounded-[2.5rem] p-5 sm:p-8 md:p-12 shadow-2xl relative" @click.stop="showCalendar = false">
                <button @click="isTicketModalOpen = false" class="absolute top-6 right-6 w-10 h-10 bg-charcoal/5 rounded-full text-charcoal/50 hover:bg-charcoal/10 hover:text-charcoal flex items-center justify-center transition-colors">
                    <i class="fi fi-rr-cross"></i>
                </button>
                
                <!-- STEP 1: PILIH WAKTU -->
                <div v-if="ticketStep === 1">
                    <p class="text-sage font-bold tracking-widest uppercase text-xs mb-2">Langkah 1/2</p>
                    <h3 class="text-4xl font-serif text-charcoal mb-2">Pesan Tiket</h3>
                    <p class="text-charcoal/60 font-light text-sm mb-8">Pilih jadwal kunjungan Anda ke Tebing Lonceng.</p>
                    
                    <div class="flex flex-col gap-6">
                        <div>
                            <label class="text-[10px] uppercase font-bold tracking-widest text-charcoal/50">Tanggal Kunjungan</label>

                            <!-- Trigger: styled input button -->
                            <button
                                type="button"
                                @click.stop="showCalendar = !showCalendar"
                                class="w-full mt-2 flex items-center gap-3 border-b border-charcoal/20 py-3 text-left transition-colors focus:outline-none group"
                                :class="ticketForm.date ? 'border-sage' : 'border-charcoal/20'"
                            >
                                <i class="fi fi-rr-calendar text-charcoal/40 group-hover:text-sage transition-colors text-lg"></i>
                                <span class="text-lg flex-1" :class="ticketForm.date ? 'text-charcoal font-medium' : 'text-charcoal/30'">
                                    {{ ticketForm.date
                                        ? new Date(ticketForm.date + 'T00:00:00').toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })
                                        : 'Pilih tanggal kunjungan' }}
                                </span>
                                <i class="fi fi-rr-angle-small-down text-charcoal/40 transition-transform duration-300" :class="showCalendar ? 'rotate-180' : ''"></i>
                            </button>

                            <!-- Popup Calendar (absolute, floating) -->
                            <div
                                v-if="showCalendar"
                                class="absolute z-50 mt-2 left-0 right-0 flex justify-center"
                                @click.stop
                            >
                                <div class="bg-[#FBF9F6] rounded-[1.5rem] shadow-2xl border border-black/8 overflow-hidden">
                                    <calendar-date
                                        class="cally"
                                        @change="ticketForm.date = $event.target.value; showCalendar = false"
                                    >
                                        <svg aria-label="Previous" class="fill-current size-4" slot="previous" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M15.75 19.5 8.25 12l7.5-7.5"></path></svg>
                                        <svg aria-label="Next" class="fill-current size-4" slot="next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path></svg>
                                        <calendar-month></calendar-month>
                                    </calendar-date>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold tracking-widest text-charcoal/50">Jumlah Pengunjung</label>
                            <input type="number" v-model="ticketForm.guests" min="1" class="w-full mt-2 border-b border-charcoal/20 bg-transparent py-2 text-charcoal outline-none focus:border-sage transition-colors text-lg">
                        </div>
                    </div>
                    
                    <button @click="ticketStep = 2" :disabled="!ticketForm.date || !ticketForm.guests" class="w-full mt-10 bg-charcoal text-base py-4 rounded-full hover:bg-sage transition-colors disabled:opacity-50 font-bold disabled:cursor-not-allowed">
                        Lanjut ke Identitas <i class="fi fi-rr-arrow-right ml-2 text-sm"></i>
                    </button>
                </div>
                
                <!-- STEP 2: DATA DIRI -->
                <div v-else-if="ticketStep === 2">
                    <p class="text-sage font-bold tracking-widest uppercase text-xs mb-2">Langkah 2/2</p>
                    <h3 class="text-4xl font-serif text-charcoal mb-2">Data Pemesan</h3>
                    <p class="text-charcoal/60 font-light text-sm mb-8">Tiket resmi akan dikirimkan secara otomatis ke email ini.</p>
                    
                    <div class="flex flex-col gap-6">
                        <div>
                            <label class="text-[10px] uppercase font-bold tracking-widest text-charcoal/50">Nama Lengkap</label>
                            <input type="text" v-model="ticketForm.name" class="w-full mt-2 border-b border-charcoal/20 bg-transparent py-2 text-charcoal outline-none focus:border-sage transition-colors text-lg">
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold tracking-widest text-charcoal/50">Alamat Email Aktif</label>
                            <input type="email" v-model="ticketForm.email" class="w-full mt-2 border-b border-charcoal/20 bg-transparent py-2 text-charcoal outline-none focus:border-sage transition-colors text-lg" placeholder="contoh@gmail.com">
                        </div>
                    </div>
                    
                    <div class="flex gap-4 mt-10">
                        <button @click="ticketStep = 1" class="w-16 h-14 border border-charcoal/20 text-charcoal rounded-full hover:bg-charcoal/5 transition-colors font-bold flex items-center justify-center">
                            <i class="fi fi-rr-arrow-left"></i>
                        </button>
                        <button @click="submitTicket" :disabled="!ticketForm.name || !ticketForm.email || isSubmitting" class="flex-1 bg-clay text-base h-14 rounded-full hover:brightness-110 transition-colors font-bold flex justify-center items-center disabled:opacity-70 disabled:cursor-wait">
                            <span v-if="isSubmitting" class="loading loading-spinner loading-sm"></span>
                            <span v-else>Konfirmasi Pesanan</span>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: SUCCESS STATE -->
                <div v-else-if="ticketStep === 3" class="text-center py-6 flex flex-col items-center">
                    <div class="w-24 h-24 bg-sage text-base rounded-full flex items-center justify-center mb-6 text-4xl shadow-xl shadow-sage/30">
                        <i class="fi fi-rr-check"></i>
                    </div>
                    <h3 class="text-4xl font-serif text-charcoal mb-4">Tiket Terkirim!</h3>
                    <p class="text-charcoal/60 font-light text-base mb-10 max-w-xs leading-relaxed">E-ticket berhasil diterbitkan dan dikirim ke email <br><b class="text-charcoal">{{ticketForm.email}}</b>. Sampai jumpa di lokasi!</p>
                    <button @click="isTicketModalOpen = false" class="w-full bg-charcoal text-base py-4 rounded-full hover:bg-sage transition-colors font-bold">Tutup Jendela</button>
                </div>
            </div>
        </div>
    </Transition>

</div>

<!-- VUE & GSAP LOGIC -->
<script>
    const { createApp, ref, reactive, onMounted } = Vue;
    let lenisInstance = null;

    createApp({
        setup() {
            // State for Ticketing Form
            const isTicketModalOpen = ref(false);
            const ticketStep = ref(1);
            const isSubmitting = ref(false);
            const isScrolled = ref(false);
            const activeSection = ref('beranda');
            const showCalendar = ref(false);
            const showPassword = ref(false);
            
            // Gunakan nilai session PHP sebagai nilai awal jika ada
            const ticketForm = reactive({
                date: '',
                guests: 1,
                name: '<?= htmlspecialchars($_SESSION['user_nama'] ?? '') ?>',
                email: '<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>'
            });

            // Action Functions
            const openTicketModal = () => {
                ticketStep.value = 1;
                isTicketModalOpen.value = true;
                showCalendar.value = false;
                // Prevent background scrolling
                document.body.style.overflow = 'hidden';
            };

            const closeTicketModal = () => {
                isTicketModalOpen.value = false;
                showCalendar.value = false;
                document.body.style.overflow = 'auto';
            };

            const submitTicket = () => {
                isSubmitting.value = true;
                
                // TODO (BACKEND): Integrasi pemrosesan tiket
                // 1. Lakukan request AJAX/fetch ke endpoint PHP (misal: process_ticket.php) membawa data `ticketForm`
                // 2. Di backend, simpan riwayat tiket ke Database MySQL.
                // 3. Gunakan PHPMailer di backend untuk men-generate email berisi E-Ticket / Barcode.
                // 4. Jika response JSON berhasil (status 200), pindahkan step ke 3.
                
                // --- Simulasi Proses Sementara ---
                setTimeout(() => {
                    isSubmitting.value = false;
                    ticketStep.value = 3; // Menampilkan pesan sukses
                }, 2000);
            };

            // Navbar Interactions
            const scrollToSection = (targetId) => {
                if (lenisInstance) {
                    lenisInstance.scrollTo(`#${targetId}`, { offset: 0 });
                }
                // Close mobile dropdown by blurring active element
                if (document.activeElement) document.activeElement.blur();
            };

            const getNavClass = (id) => {
                const isActive = activeSection.value === id;
                if (isScrolled.value) {
                    return isActive ? 'bg-black/5 text-charcoal font-semibold' : 'text-charcoal/80 hover:bg-black/5 hover:text-charcoal';
                } else {
                    return isActive ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/20 hover:text-white';
                }
            };

            // Setup Animations on component mount
            onMounted(() => {
                gsap.registerPlugin(ScrollTrigger);

                
                // Initialize Lenis
                lenisInstance = new Lenis({
                    duration: 1.5,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    smoothWheel: true,
                    touchMultiplier: 2
                });
                
                function raf(time) {
                    lenisInstance.raf(time);
                    requestAnimationFrame(raf);
                }
                requestAnimationFrame(raf);

                lenisInstance.on('scroll', ScrollTrigger.update);
                gsap.ticker.add((time) => {
                    lenisInstance.raf(time * 1000);
                });
                gsap.ticker.lagSmoothing(0);
      

                // Setup Vue window listener for navbar shrinking
                window.addEventListener('scroll', () => {
                    isScrolled.value = window.scrollY > 20;
                });

                // ScrollSpy via ScrollTrigger
                const sectionIds = ['beranda', 'about', 'fasilitas', 'reviews'];
                sectionIds.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        ScrollTrigger.create({
                            trigger: el,
                            start: "top center",
                            end: "bottom center",
                            onToggle: self => {
                                if (self.isActive) {
                                    activeSection.value = id;
                                }
                            }
                        });
                    }
                });

                gsap.from(".gs-hero-text", {
                    y: 40,
                    filter: "blur(15px)",
                    autoAlpha: 0, // handles both opacity and visibility
                    duration: 1.5,
                    stagger: 0.15,
                    ease: "power3.out",
                    delay: 0.2
                });

                // Parallax Hero Video via GSAP ScrollTrigger
                // Instead of custom ScrollTrigger for parallax, we can rely on GSAP's data-speed if we want, 
                // but since the video is absolute positioned inside #beranda, we'll keep the ScrollTrigger.
                gsap.to("#beranda video", {
                    yPercent: 15,
                    ease: "none",
                    scrollTrigger: {
                        trigger: "#beranda",
                        start: "top top",
                        end: "bottom top",
                        scrub: true
                    }
                });

                // 2. Horizontal Scroll Container Animation
                ScrollTrigger.matchMedia({
                    // Only run horizontal scroll animation on larger screens
                    "(min-width: 768px)": function() {
                        let sections = gsap.utils.toArray(".hz-panel-wrapper");
                        let container = document.querySelector(".hz-container");
                        
                        // Fake Horizontal Scroll
                        let scrollTween = gsap.to(sections, {
                            xPercent: -100 * (sections.length - 1),
                            ease: "none", // Must be none for containerAnimation
                            scrollTrigger: {
                                trigger: "#about",
                                pin: true,
                                scrub: 1, // Smooth scrub
                                end: () => "+=" + container.scrollWidth
                            }
                        });

                        // ═══════════════════════════════════════════════════════════════
                        // PREMIUM MORPHING SYSTEM — Scale · Opacity · Blur · 3D Depth
                        // Inspired by: Apple, Linear, Framer.com scroll interactions
                        // ═══════════════════════════════════════════════════════════════

                        // Enable 3D perspective on the scroll container for depth effect
                        gsap.set(".hz-container", { perspective: 1400 });

                        const morphCards = gsap.utils.toArray(".gs-morph-card");

                        morphCards.forEach((card) => {
                            const wrapper = card.parentElement;

                            // ── ENTRY: Card breathes into life as it scrolls into view ──
                            // Starts: compressed (scale 0.7), completely dim (opacity 0.1),
                            // blurred, and tilted in 3D. Arrives: full size, crisp, vivid.
                            gsap.fromTo(card,
                                {
                                    scale: 0.70,
                                    opacity: 0.10,
                                    filter: "blur(8px)",
                                    rotateY: 10,
                                    y: 30,
                                    transformOrigin: "center center",
                                    boxShadow: "0 4px 12px rgba(0,0,0,0.04)"
                                },
                                {
                                    scale: 1,
                                    opacity: 1,
                                    filter: "blur(0px)",
                                    rotateY: 0,
                                    y: 0,
                                    boxShadow: "0 32px 80px rgba(0,0,0,0.18)",
                                    ease: "power2.out",
                                    scrollTrigger: {
                                        trigger: wrapper,
                                        containerAnimation: scrollTween,
                                        start: "left 100%",  // Begin as soon as card peeks in
                                        end: "left 30%",     // Fully open when card is centered-left
                                        scrub: 1.8,
                                    }
                                }
                            );

                            // ── EXIT: Card recedes as it's pushed out to the left ──
                            // Creates a satisfying "it's been visited" fade-back effect.
                            gsap.fromTo(card,
                                {
                                    scale: 1,
                                    opacity: 1,
                                    filter: "blur(0px)",
                                    rotateY: 0,
                                    y: 0,
                                },
                                {
                                    scale: 0.82,
                                    opacity: 0.22,
                                    filter: "blur(4px)",
                                    rotateY: -8,
                                    y: 16,
                                    ease: "power2.in",
                                    scrollTrigger: {
                                        trigger: wrapper,
                                        containerAnimation: scrollTween,
                                        start: "left -5%",    // Start exiting after it leaves center
                                        end: "left -50%",     // Fully receded when far left
                                        scrub: 1.5,
                                    }
                                }
                            );
                        });

                        // ── MAP CARD: Width morph + identical scale/opacity/blur/3D ──
                        // The big reveal: narrow → full width + the premium entrance treatment
                        const mapCard = document.querySelector(".gs-morph-map");
                        if (mapCard) {
                            gsap.set(mapCard, { transformOrigin: "left center" });

                            // Entry
                            gsap.fromTo(mapCard,
                                {
                                    width: "28rem",
                                    scale: 0.75,
                                    opacity: 0.12,
                                    filter: "blur(8px)",
                                    rotateY: 8,
                                    boxShadow: "0 4px 12px rgba(0,0,0,0.04)"
                                },
                                {
                                    width: "100%",
                                    scale: 1,
                                    opacity: 1,
                                    filter: "blur(0px)",
                                    rotateY: 0,
                                    boxShadow: "0 32px 80px rgba(0,0,0,0.20)",
                                    ease: "power2.out",
                                    scrollTrigger: {
                                        trigger: mapCard.parentElement,
                                        containerAnimation: scrollTween,
                                        start: "left 100%",
                                        end: "left 5%",
                                        scrub: 1.8,
                                    }
                                }
                            );
                        }
                        // ═══════════════════════════════════════════════════════════════

                        // ┌─────────────────────────────────────────────────────────────┐
                        // │  CARD 1 — "Wisata Unggulan": Cinematic Clip-Path Burst      │
                        // │  Effect: Card erupts open from a compressed strip            │
                        // │  + image Ken Burns zoom-out + desaturation → vivid color    │
                        // └─────────────────────────────────────────────────────────────┘
                        const card1 = document.getElementById("gs-card-sejarah");
                        const card1Img = document.getElementById("gs-sejarah-img");
                        if (card1) {
                            const card1Wrapper = card1.parentElement;

                            // Clip-path: card bursts open from a compressed rectangle
                            gsap.fromTo(card1,
                                { clipPath: "inset(12% 22% 12% 22% round 3rem)" },
                                {
                                    clipPath: "inset(0% 0% 0% 0% round 2rem)",
                                    ease: "power3.inOut",
                                    scrollTrigger: {
                                        trigger: card1Wrapper,
                                        containerAnimation: scrollTween,
                                        start: "left 95%",
                                        end: "left 15%",
                                        scrub: 2,
                                    }
                                }
                            );

                            // Image: Ken Burns zoom-out + desaturate → vivid (fires simultaneously)
                            if (card1Img) {
                                gsap.fromTo(card1Img,
                                    { scale: 1.5, filter: "brightness(0.35) saturate(0)" },
                                    {
                                        scale: 1,
                                        filter: "brightness(1) saturate(1)",
                                        ease: "power2.out",
                                        scrollTrigger: {
                                            trigger: card1Wrapper,
                                            containerAnimation: scrollTween,
                                            start: "left 95%",
                                            end: "left 10%",
                                            scrub: 2.2,
                                        }
                                    }
                                );
                            }
                        }

                        // ┌─────────────────────────────────────────────────────────────┐
                        // │  CARD 2 — "Reviews": Dramatic Split Reveal                  │
                        // │  Effect: top half drops from above, bottom rises from below  │
                        // │  + divider scales from 0 to full width from center           │
                        // └─────────────────────────────────────────────────────────────┘
                        const card2 = document.getElementById("gs-card-reviews");
                        if (card2) {
                            const card2Wrapper = card2.parentElement;
                            const reviewTop    = card2.querySelector(".gs-review-top");
                            const reviewBot    = card2.querySelector(".gs-review-bottom");
                            const reviewDiv    = card2.querySelector(".gs-review-divider");

                            // Top half: clips + fades down from above
                            if (reviewTop) {
                                gsap.fromTo(reviewTop,
                                    { y: -60, opacity: 0, clipPath: "inset(0 0 100% 0)" },
                                    {
                                        y: 0, opacity: 1, clipPath: "inset(0 0 0% 0)",
                                        ease: "power3.out",
                                        scrollTrigger: {
                                            trigger: card2Wrapper,
                                            containerAnimation: scrollTween,
                                            start: "left 85%",
                                            end: "left 40%",
                                            scrub: 1.6,
                                        }
                                    }
                                );
                            }

                            // Divider: scales from center outward
                            if (reviewDiv) {
                                gsap.fromTo(reviewDiv,
                                    { scaleX: 0 },
                                    {
                                        scaleX: 1,
                                        ease: "power2.inOut",
                                        scrollTrigger: {
                                            trigger: card2Wrapper,
                                            containerAnimation: scrollTween,
                                            start: "left 70%",
                                            end: "left 35%",
                                            scrub: 1.4,
                                        }
                                    }
                                );
                            }

                            // Bottom half: clips + fades up from below
                            if (reviewBot) {
                                gsap.fromTo(reviewBot,
                                    { y: 60, opacity: 0, clipPath: "inset(100% 0 0 0)" },
                                    {
                                        y: 0, opacity: 1, clipPath: "inset(0% 0 0 0)",
                                        ease: "power3.out",
                                        scrollTrigger: {
                                            trigger: card2Wrapper,
                                            containerAnimation: scrollTween,
                                            start: "left 80%",
                                            end: "left 35%",
                                            scrub: 1.6,
                                        }
                                    }
                                );
                            }
                        }

                        // Reveal inner items using containerAnimation
                        sections.forEach((panel) => {
                            // Standard text items sliding up
                            let items = panel.querySelectorAll(".gs-reveal-item");
                            if (items.length > 0) {
                                gsap.from(items, {
                                    y: 40,
                                    opacity: 0,
                                    duration: 1.2,
                                    stagger: 0.15,
                                    ease: "power3.out",
                                    scrollTrigger: {
                                        trigger: panel,
                                        containerAnimation: scrollTween,
                                        start: "left 80%", // Starts animating when panel enters
                                        toggleActions: "play none none reverse"
                                    }
                                });
                            }

                            // Tags stagger
                            let tags = panel.querySelectorAll(".gs-stagger-tags span");
                            if (tags.length > 0) {
                                gsap.from(tags, {
                                    scale: 0.8,
                                    y: 20,
                                    opacity: 0,
                                    duration: 0.6,
                                    stagger: 0.1,
                                    ease: "back.out(2)",
                                    scrollTrigger: {
                                        trigger: panel,
                                        containerAnimation: scrollTween,
                                        start: "left 75%",
                                        toggleActions: "play none none reverse"
                                    }
                                });
                            }
                        });

                        // Number Count (Outside loop so it fires exactly once correctly)
                        let numberEl = document.querySelector(".gs-number-count");
                        if (numberEl) {
                            gsap.from({ val: 0 }, {
                                val: 10.5,
                                duration: 2.5,
                                ease: "power2.out",
                                scrollTrigger: {
                                    trigger: numberEl.closest('.hz-panel-wrapper'),
                                    containerAnimation: scrollTween,
                                    start: "left 80%",
                                    toggleActions: "play none none reverse"
                                },
                                onUpdate: function() {
                                    numberEl.innerHTML = this.targets()[0].val.toFixed(1) + "K";
                                }
                            });
                        }

                        // Title animation (moves separately outside the horizontal panels)
                        gsap.from(".gs-bento-title", {
                            y: -50, opacity: 0, scale: 0.9, ease: "power3.out", duration: 1,
                            scrollTrigger: { trigger: "#about", start: "top 80%" }
                        });
                    },
                    // Fallback for mobile (stacked vertically, scroll normally)
                    "(max-width: 767px)": function() {
                        let panels = gsap.utils.toArray(".hz-panel-wrapper");
                        panels.forEach((panel) => {
                            let items = panel.querySelectorAll(".gs-reveal-item, .gs-stagger-tags span");
                            gsap.from(items, {
                                scrollTrigger: { trigger: panel, start: "top 85%" },
                                y: 30, opacity: 0, stagger: 0.1, duration: 1, ease: "power3.out"
                            });
                        });
                        
                        let numberEl = document.querySelector(".gs-number-count");
                        if (numberEl) {
                            gsap.from({ val: 0 }, {
                                val: 10.5,
                                duration: 2.5,
                                ease: "power2.out",
                                scrollTrigger: {
                                    trigger: numberEl,
                                    start: "top 85%",
                                },
                                onUpdate: function() {
                                    numberEl.innerHTML = this.targets()[0].val.toFixed(1) + "K";
                                }
                            });
                        }

                        gsap.from(".gs-bento-title", {
                            scrollTrigger: { trigger: "#about", start: "top 85%", once: true },
                            y: 30, opacity: 0, duration: 0.8, ease: "power3.out"
                        });
                    }
                });

                // ══════════════════════════════════════════════════════════════════════
                // HOMESTAY SECTION ANIMATION
                // ══════════════════════════════════════════════════════════════════════
                const homestaySection = document.getElementById('homestay');
                if (homestaySection) {
                    
                    // Top Split Entrance
                    gsap.from(".gs-hs-top", {
                        scrollTrigger: { trigger: homestaySection, start: "top 75%", once: true },
                        y: 40, opacity: 0, duration: 1, ease: "power3.out"
                    });
                    
                    // Left Column Stagger
                    gsap.from(".gs-hs-stagger", {
                        scrollTrigger: { trigger: ".gs-hs-top", start: "top 70%", once: true },
                        y: 25, opacity: 0, stagger: 0.12, duration: 0.9, ease: "power3.out"
                    });
                    
                    // Right Image Scale Reveal
                    gsap.from(".gs-hs-img", {
                        scrollTrigger: { trigger: ".gs-hs-top", start: "top 70%", once: true },
                        scale: 0.97, opacity: 0, duration: 1.2, ease: "power2.out"
                    });
                    
                    // Bottom Section Entrance
                    gsap.from(".gs-hs-bottom", {
                        scrollTrigger: { trigger: ".gs-hs-bottom", start: "top 85%", once: true },
                        y: 40, opacity: 0, duration: 1, ease: "power3.out"
                    });

                    // GSAP Gallery Infinite Crossfade with ClipPath Wipe
                    const slides = gsap.utils.toArray(".hs-gallery-slide");
                    const dots = gsap.utils.toArray(".hs-gallery-dot");
                    
                    if (slides.length > 0) {
                        // Init
                        gsap.set(slides[0], { opacity: 1, visibility: "visible", zIndex: 2 });
                        gsap.set(dots[0], { backgroundColor: "rgba(255,255,255,1)", width: "24px" });
                        
                        let currentSlide = 0;
                        
                        const playSlide = () => {
                            let nextSlide = (currentSlide + 1) % slides.length;
                            
                            const tl = gsap.timeline();
                            
                            // Prepare next slide underneath
                            gsap.set(slides[nextSlide], { visibility: "visible", zIndex: 3, clipPath: "inset(100% 0% 0% 0%)", opacity: 1 });
                            gsap.set(slides[currentSlide], { zIndex: 2 });
                            
                            // Reveal next slide with clipPath, slightly zoom out current image
                            tl.to(slides[currentSlide].querySelector('.hs-gallery-img'), { scale: 1.05, duration: 1.5, ease: "power1.inOut" }, 0)
                              .to(slides[nextSlide], { clipPath: "inset(0% 0% 0% 0%)", duration: 1.2, ease: "power3.inOut" }, 0)
                              .fromTo(slides[nextSlide].querySelector('.hs-gallery-img'), { scale: 1.1 }, { scale: 1, duration: 1.5, ease: "power2.out" }, 0);
                              
                            // Hide old slide after next covers it
                            tl.set(slides[currentSlide], { visibility: "hidden", opacity: 0, clipPath: "none", zIndex: 1 });
                            
                            // Dots animation
                            gsap.to(dots[currentSlide], { backgroundColor: "rgba(255,255,255,0.3)", width: window.innerWidth > 1024 ? "8px" : "6px", duration: 0.5 });
                            gsap.to(dots[nextSlide], { backgroundColor: "rgba(255,255,255,1)", width: window.innerWidth > 1024 ? "24px" : "18px", duration: 0.5 });
                              
                            currentSlide = nextSlide;
                        };
                        
                        // Loop every 5.5s (was 4.5s — reduces crossfade frequency)
                        gsap.delayedCall(5.5, function loop() {
                            playSlide();
                            gsap.delayedCall(5.5, loop);
                        });
                    }
                }

                // ══════════════════════════════════════════════════════════════════════
                // FASILITAS INFINITE MARQUEE
                // ══════════════════════════════════════════════════════════════════════
                const infiniteContainer = document.getElementById('infinite-container');
                const infiniteTrack = document.querySelector('.gs-infinite-track');
                
                if (infiniteContainer && infiniteTrack) {
                    // GSAP simple infinite horizontal loop
                    // Move the track by -50% (exactly the width of Set 1) to create a perfect loop
                    let marqueeTween = gsap.to(infiniteTrack, {
                        xPercent: -50,
                        ease: "none",
                        duration: 35, // Adjust duration for speed
                        repeat: -1
                    });

                    // Pause on hover for better UX
                    infiniteContainer.addEventListener('mouseenter', () => marqueeTween.pause());
                    infiniteContainer.addEventListener('mouseleave', () => marqueeTween.play());
                }
                // ══════════════════════════════════════════════════════════════════════


                // 3. Reverse Logic on General Elements (Reviews & Buttons)
                const ulasanCards = document.querySelectorAll('.gs-ulasan');
                ulasanCards.forEach(card => {
                    gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            start: "top 90%",
                            once: true  // kill trigger after first fire — saves memory
                        },
                        y: 40,
                        opacity: 0,
                        duration: 0.8,
                        ease: "power2.out"
                    });
                });


                // ══════════════════════════════════════════════════════════════════════
                // REVIEWS SECTION — Trig-Positioned Arch + Form Animations
                // ══════════════════════════════════════════════════════════════════════

                // ── Swiper Testimonials Initialization ──
                const archRing = document.querySelector('.gs-arch-ring');
                if (archRing) {
                    gsap.from(archRing, {
                        scrollTrigger: { trigger: "#reviews", start: "top 65%", once: true },
                        opacity: 0,
                        y: 60,
                        duration: 1.2,
                        ease: "power3.out"
                    });
                }

                // Section heading text entrance
                gsap.from(".gs-arch-text > *", {
                    scrollTrigger: { trigger: "#reviews", start: "top 70%", once: true },
                    y: 30, opacity: 0, duration: 0.8, stagger: 0.12, ease: "power3.out"
                });

                const reviewSwiperEl = document.getElementById('reviewSwiper');
                if (reviewSwiperEl) {
                    const swiperParams = {
                        loop: true,
                        autoplay: {
                            delay: 3500,
                            disableOnInteraction: false,
                        },
                        centeredSlides: true,
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                        pagination: false,
                        navigation: true,
                        breakpoints: {
                            640: { slidesPerView: 1.5, spaceBetween: 20 },
                            768: { slidesPerView: 2, spaceBetween: 30 },
                            1024: { slidesPerView: 2.5, spaceBetween: 40 },
                            1280: { slidesPerView: 3, spaceBetween: 50 },
                        },
                        injectStyles: [
                            `
                            .swiper-wrapper {
                                padding-bottom: 70px;
                            }
                            .swiper-button-next,
                            .swiper-button-prev {
                                background: #FBF9F6;
                                width: 50px;
                                height: 50px;
                                border-radius: 50%;
                                border: 1px solid rgba(0,0,0,0.05);
                                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                                color: #1a1a1a;
                                top: auto;
                                bottom: 0;
                                margin-top: 0;
                                transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                            }
                            .swiper-button-prev {
                                left: calc(50% - 55px);
                                transform: none;
                            }
                            .swiper-button-next {
                                right: calc(50% - 55px);
                                transform: none;
                            }
                            .swiper-button-next:hover,
                            .swiper-button-prev:hover {
                                background: #ffffff;
                                transform: translateY(-4px);
                                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                                color: #6b7b62;
                                border-color: rgba(107,123,98,0.2);
                            }
                            .swiper-button-next svg,
                            .swiper-button-prev svg {
                                display: none !important;
                            }
                            .swiper-button-next::after,
                            .swiper-button-prev::after {
                                content: '';
                                display: block;
                                width: 11px;
                                height: 20px;
                                background-color: currentColor;
                                -webkit-mask-image: url("data:image/svg+xml,%3Csvg width='11' height='20' viewBox='0 0 11 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z' fill='black'/%3E%3C/svg%3E");
                                mask-image: url("data:image/svg+xml,%3Csvg width='11' height='20' viewBox='0 0 11 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z' fill='black'/%3E%3C/svg%3E");
                                -webkit-mask-size: contain;
                                mask-size: contain;
                                -webkit-mask-repeat: no-repeat;
                                mask-repeat: no-repeat;
                                -webkit-mask-position: center;
                                mask-position: center;
                            }
                            .swiper-button-prev::after {
                                transform: rotate(180deg);
                            }
                            `
                        ]
                    };
                    Object.assign(reviewSwiperEl, swiperParams);
                    reviewSwiperEl.initialize();
                }

                // Review form entrance
                gsap.from(".gs-review-form", {
                    scrollTrigger: { trigger: ".gs-review-form", start: "top 85%" },
                    y: 60, opacity: 0, duration: 1.2, ease: "power3.out"
                });

                // ── Review Form AJAX Submit ──
                const reviewForm = document.getElementById('review-form');
                if (reviewForm) {
                    reviewForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const btn = document.getElementById('review-submit-btn');
                        const btnText = document.getElementById('review-btn-text');
                        btnText.innerHTML = '<span class="loading loading-spinner loading-sm"></span>';
                        btn.disabled = true;

                        const formData = new FormData(reviewForm);

                        fetch('actions/user/tambah_review.php', { method: 'POST', body: formData })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    // Show pending-approval success state
                                    gsap.to(reviewForm, {
                                        opacity: 0, y: -20, duration: 0.4, ease: "power2.in",
                                        onComplete: () => {
                                            reviewForm.style.display = 'none';
                                            const successEl = document.getElementById('review-success');
                                            successEl.classList.remove('hidden');
                                            gsap.from(successEl, { opacity: 0, y: 20, duration: 0.6, ease: "power3.out" });
                                        }
                                    });
                                } else {
                                    // Show error, re-enable button
                                    btnText.innerHTML = 'Kirim Ulasan';
                                    btn.disabled = false;
                                    const errEl = document.getElementById('review-error-msg');
                                    if (errEl) {
                                        errEl.textContent = data.message || 'Gagal mengirim ulasan. Coba lagi.';
                                        errEl.classList.remove('hidden');
                                        setTimeout(() => errEl.classList.add('hidden'), 5000);
                                    }
                                }
                            })
                            .catch(() => {
                                btnText.innerHTML = 'Kirim Ulasan';
                                btn.disabled = false;
                            });
                    });
                }

                // GSAP Animations end here
            });

            return {
                isTicketModalOpen,
                ticketStep,
                ticketForm,
                isSubmitting,
                isScrolled,
                activeSection,
                showCalendar,
                showPassword,
                openTicketModal,
                closeTicketModal,
                submitTicket,
                scrollToSection,
                getNavClass
            }
        }
    }).mount('#app');
</script>

<style>
    /* Vue Transitions */
    .fade-enter-active, .fade-leave-active { transition: opacity 0.3s ease; }
    .fade-enter-from, .fade-leave-to { opacity: 0; }
</style>

</body>
</html>