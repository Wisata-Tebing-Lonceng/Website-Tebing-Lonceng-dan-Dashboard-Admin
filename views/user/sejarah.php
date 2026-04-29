<?php
// sejarah.php
session_start();
?>
<!DOCTYPE html>
<html lang="id" data-theme="lofi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah - Tebing Lonceng</title>
    
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/fonts.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="stylesheet" href="../../assets/vendor/uicons-regular-rounded/css/uicons-regular-rounded.css">

    <!-- JS -->
    <script src="../../assets/vendor/vue.global.prod.js"></script>
    <script src="../../assets/vendor/gsap.min.js"></script>
    <script src="../../assets/vendor/ScrollTrigger.min.js"></script>
    <script src="../../assets/vendor/lenis.min.js"></script>
<!-- Tailwind & DaisyUI -->
    <!-- Fonts -->
    <!-- GSAP -->

    <!-- Tailwind & DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        base: '#FBF9F6',
                        charcoal: '#1a1a1a',
                        sage: '#6b7b62',
                        clay: '#c5a27d',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Instrument Serif', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    
    <!-- GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollTrigger.min.js"></script>
    <script src="https://assets.codepen.io/16327/ScrollSmoother.min.js"></script>

>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9
    <style>
        body { background-color: #FBF9F6; color: #1a1a1a; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        /* Global Arrow Rotation on Button/Link Hover (from home.php) */
        a:hover .fi-rr-arrow-right,
        button:hover .fi-rr-arrow-right,
        .group:hover .fi-rr-arrow-right {
            transform: rotate(-45deg) !important;
        }
        .fi-rr-arrow-right {
            display: inline-block;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .img-hero {
            width: 100%;
            height: 45vh;
            object-fit: cover;
            border-radius: 1rem;
        }
        @media (min-width: 768px) {
            .img-hero {
                height: 55vh;
                border-radius: 2rem; /* Softer radius matching home.php */
            }
        }

        /* Ambient Blobs for subtle background texture */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.3;
        }
    </style>
</head>
<body class="antialiased selection:bg-sage selection:text-base relative">

    <!-- Global Loader -->
    <?php include 'loader.php'; ?>

    <!-- FLOATING NAVBAR -->
    <div class="fixed top-0 left-0 right-0 z-50 px-4 py-6 transition-all duration-500 gs-nav-wrapper" id="navbar-wrapper">
        <div class="max-w-7xl mx-auto">
            <div class="navbar rounded-full px-6 bg-white/80 border border-black/5 shadow-md backdrop-blur-xl">
                <div class="navbar-start w-1/3">
                    <a href="../../index.php" class="btn btn-ghost rounded-full px-4 text-charcoal flex items-center gap-2">
                        <i class="fi fi-rr-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="navbar-center flex w-1/3 justify-center">
                    <a href="../../index.php" class="text-2xl font-serif tracking-tight group text-charcoal">
                        Tebing<span class="italic opacity-80 group-hover:opacity-100 transition-opacity">Lonceng</span>
                    </a>
                </div>
                <div class="navbar-end w-1/3">
                    <!-- No action needed on this page -->
                </div>
            </div>
        </div>
    </div>

    <!-- Ambient Blobs (from home.php) -->

<<<<<<< HEAD
    <!-- Smooth Wrapper Removed (Lenis) -->
        <div class="relative z-10 pt-32">
=======
    <!-- Smooth Wrapper -->
    <div id="smooth-wrapper">
        <div id="smooth-content" class="relative z-10 pt-32">
>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9
            
            <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pb-24">
                
                <!-- Main Header & Image -->
                <div class="mb-16">
                    <h1 class="text-5xl sm:text-6xl md:text-8xl lg:text-[9rem] font-serif tracking-tight leading-[0.9] mb-8 sm:mb-10 gs-title text-charcoal text-center md:text-left drop-shadow-sm">
                        Sejarah <span class="italic text-charcoal/80">&</span> Cerita
                    </h1>
                    <div class="w-full overflow-hidden gs-hero shadow-[0_20px_50px_rgba(0,0,0,0.1)] rounded-[1.5rem] md:rounded-[2rem] border border-black/5 relative">
                        <img src="../../assets/img/5.webp" alt="Tebing Lonceng" class="img-hero w-full object-cover gs-parallax-img transform-gpu">
                    </div>
                </div>

                <!-- Intro Split -->
                <div class="flex flex-col md:flex-row gap-10 md:gap-24 mb-32 gs-fade-stagger mt-24">
                    <div class="md:w-1/2">
                        <h2 class="text-3xl md:text-4xl lg:text-[2.75rem] font-serif text-charcoal leading-[1.1] gs-item">
                            Sepoi angin yang membawa aroma tanah basah seolah menjadi <span class="italic text-sage">sambutan hangat</span> bagi siapa pun yang menapakkan kaki di ketinggian Mangkupalas.
                        </h2>
                    </div>
                    <div class="md:w-1/2 flex flex-col justify-end pb-1 md:pb-2">
                        <p class="text-sm md:text-base text-charcoal/70 leading-[1.8] max-w-lg font-medium gs-item">
                            Di tengah tren wisata puncak yang tengah menjamur di ibu kota Kalimantan Timur, ada satu destinasi yang tak hanya menawarkan keindahan, tapi juga menyimpan fragmen sejarah yang mendalam: Wisata Tebing Lonceng.
                        </p>
                    </div>
                </div>

                <!-- Grid Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-24 gap-y-24 mb-32">
                    
                    <!-- Item 1 -->
                    <div class="flex flex-col gs-fade">
                        <h3 class="text-[10px] font-black mb-6 uppercase tracking-[0.2em] text-sage flex items-center gap-2">
                            <i class="fi fi-rr-leaf"></i> Awal Mula
                        </h3>
                        <div class="text-2xl md:text-3xl lg:text-[2.25rem] font-serif leading-[1.1] mb-6 text-charcoal">
                            Lahir dari sebuah ketidaksengajaan yang <span class="italic text-charcoal/70">manis.</span>
                        </div>
                        <p class="text-sm text-charcoal/70 leading-[1.8] max-w-sm font-medium">
                            Siapa sangka, surga seluas 4,5 hektare di Jalan Dwikora ini lahir dari sebuah ketidaksengajaan. Awalnya, pengelola hanya berniat merintis lahan ini untuk berkebun "apotek hidup". Namun, pesona matahari terbit dan tenggelam terlalu indah untuk dilewatkan warga sekitar, hingga akhirnya resmi dibuka pada Februari 2020.
                        </p>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex flex-col gs-fade">
                        <h3 class="text-[10px] font-black mb-6 uppercase tracking-[0.2em] text-clay flex items-center gap-2">
                            <i class="fi fi-rr-castle"></i> Saksi Bisu
                        </h3>
                        <!-- Glassmorphism Image Wrapper -->
                        <div class="mb-8 rounded-2xl overflow-hidden shadow-lg border border-black/5 max-w-[300px] relative group p-2 bg-white/50 backdrop-blur-sm">
                            <div class="rounded-xl overflow-hidden">
                                <img src="../../assets/img/1.webp" alt="Sejarah" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                        </div>
                        <div class="text-2xl md:text-3xl lg:text-[2.25rem] font-serif leading-[1.1] mb-6 text-charcoal">
                            Pos pengintai strategis bagi para pejuang pribumi.
                        </div>
                        <p class="text-sm text-charcoal/70 leading-[1.8] max-w-sm font-medium">
                            Tebing Lonceng jauh lebih dalam dari sekadar tempat berswafoto. Dahulu, tempat ini memantau pergerakan kapal-kapal di Sungai Mahakam. Sebuah lonceng berukuran raksasa pernah bertengger di sana, siap membunyikan isyarat tanda bahaya.
                        </p>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex flex-col gs-fade">
                        <h3 class="text-[10px] font-black mb-6 uppercase tracking-[0.2em] text-sage flex items-center gap-2">
                            <i class="fi fi-rr-sparkles"></i> Daya Tarik
                        </h3>
                        <div class="text-2xl md:text-3xl lg:text-[2.25rem] font-serif leading-[1.1] mb-6 text-charcoal">
                            Berbagai wahana ikonik & pemandangan megah.
                        </div>
                        <p class="text-sm text-charcoal/70 leading-[1.8] max-w-sm font-medium">
                            Kini, meskipun lonceng fisik tersebut telah tiada, suasananya tetap hidup dengan sentuhan modern. Pengunjung bisa menjajal berbagai wahana ikonik, mulai dari tangan raksasa hingga replika perahu yang seolah membawa kita berlayar di atas awan, dengan latar siluet kota Samarinda.
                        </p>
                    </div>

                    <!-- Item 4 -->
                    <div class="flex flex-col gs-fade">
                        <h3 class="text-[10px] font-black mb-6 uppercase tracking-[0.2em] text-clay flex items-center gap-2">
                            <i class="fi fi-rr-users"></i> Pemberdayaan
                        </h3>
                        <div class="text-2xl md:text-3xl lg:text-[2.25rem] font-serif leading-[1.1] mb-6 text-charcoal">
                            Nilai kemanusiaan yang istimewa di setiap sudutnya.
                        </div>
                        <p class="text-sm text-charcoal/70 leading-[1.8] max-w-sm font-medium">
                            Yang membuat tempat ini semakin istimewa adalah nilai kemanusiaannya. Wisata Tebing Lonceng bukan sekadar bisnis, melainkan rumah bagi pemuda lokal yang sempat kehilangan arah akibat pandemi. Mereka diberdayakan untuk menjaga keamanan dan kenyamanan pengunjung.
                        </p>
                    </div>

                </div>

            </main>

            <!-- Footer / Bottom CTA Area (Matching home.php style) -->
            <footer class="bg-charcoal w-full py-32 px-6 gs-fade relative overflow-hidden rounded-t-[3rem]">
                <!-- Decorative element -->
                <div class="absolute top-[-200px] left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-sage/20 rounded-full blur-[100px] pointer-events-none"></div>
                
                <div class="max-w-3xl mx-auto text-center flex flex-col items-center relative z-10 text-white">
                    <p class="text-2xl sm:text-3xl md:text-[3rem] font-serif leading-[1.1] mb-10 sm:mb-12 drop-shadow-lg">
                        Tempat di mana sejarah dan keindahan alam bertemu dalam satu hembusan angin. <br><span class="italic text-white/70">Mulai petualanganmu.</span>
                    </p>
                    
                    <a href="../../index.php" class="btn bg-white hover:bg-sage text-charcoal hover:text-white rounded-full px-10 h-14 font-bold border-none shadow-[0_20px_40px_rgba(0,0,0,0.3)] flex items-center gap-3 group transition-all duration-300">
                        Pesan Tiket Sekarang 
                        <span class="w-8 h-8 rounded-full bg-charcoal/5 group-hover:bg-white/20 flex items-center justify-center transition-colors">
                            <i class="fi fi-rr-arrow-right text-sm"></i>
                        </span>
                    </a>
                </div>
            </footer>
        </div>
<<<<<<< HEAD
=======
    </div>
>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9

    <!-- GSAP Animations -->
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
<<<<<<< HEAD
            gsap.registerPlugin(ScrollTrigger);
            
            // Setup Smooth Scroll
            
            // Initialize Lenis
            const lenis = new Lenis({
                duration: 1.5,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
            });
            
            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);

            lenis.on('scroll', ScrollTrigger.update);
            gsap.ticker.add((time) => {
                lenis.raf(time * 1000);
            });
            gsap.ticker.lagSmoothing(0);
      
=======
            gsap.registerPlugin(ScrollTrigger, ScrollSmoother);
            
            // Setup Smooth Scroll
            const smoother = ScrollSmoother.create({
                wrapper: '#smooth-wrapper',
                content: '#smooth-content',
                smooth: 1.5,
                effects: true
            });
>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9

            // Initial Animations
            const tl = gsap.timeline();

            tl.from(".gs-nav-wrapper", { y: -50, opacity: 0, duration: 1, ease: "power3.out" })
              .from(".gs-title", { y: 40, opacity: 0, duration: 1, ease: "power3.out" }, "-=0.6")
              .from(".gs-hero", { y: 40, opacity: 0, scale: 0.98, duration: 1.2, ease: "power3.out" }, "-=0.6");

            // Hero Parallax Image Movement
            gsap.to(".gs-parallax-img", {
                yPercent: 15,
                ease: "none",
                scrollTrigger: {
                    trigger: ".gs-hero",
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                } 
            });

            // Intro Text Stagger
            gsap.from(".gs-fade-stagger .gs-item", {
                scrollTrigger: { 
                    trigger: ".gs-fade-stagger", 
                    start: "top 80%" 
                },
                y: 30, 
                opacity: 0, 
                duration: 1, 
                stagger: 0.2,
                ease: "power3.out"
            });

            // Grid Elements Fade In
            const fadeElements = gsap.utils.toArray('.gs-fade');
            fadeElements.forEach((el) => {
                gsap.from(el, {
                    scrollTrigger: { 
                        trigger: el, 
                        start: "top 85%" 
                    },
                    y: 40, 
                    opacity: 0, 
                    duration: 1, 
                    ease: "power3.out"
                });
            });
        });
    </script>
</body>
</html>
