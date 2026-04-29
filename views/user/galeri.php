<?php
// galeri.php
session_start();
require_once '../../config/Database.php';

$conn = Database::getConnection();

// Fetch approved images with user details
$stmt = $conn->prepare("
    SELECT g.*, u.nama 
    FROM galleries g 
    JOIN users u ON g.user_id = u.id 
    WHERE g.status = 'approved' 
    ORDER BY g.created_at DESC
");
$stmt->execute();
$galleries = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id" data-theme="lofi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Komunitas - Tebing Lonceng</title>
    
<!-- <<<<<<< HEAD -->
    
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
    <!-- Vue.js -->
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
    
    <!-- Vue.js -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!-- GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/ScrollTrigger.min.js"></script>

>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9
    <style>
        body { background-color: #FBF9F6; color: #1a1a1a; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        .masonry-grid {
            column-count: 1;
            column-gap: 1.5rem;
        }
        @media (min-width: 640px) { .masonry-grid { column-count: 2; } }
        @media (min-width: 1024px) { .masonry-grid { column-count: 3; } }
        
        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }

        .img-hover-zoom {
            transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .masonry-item:hover .img-hover-zoom {
            transform: scale(1.05);
        }

        [v-cloak] { display: none; }
        @keyframes modalEnter {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to   { opacity: 1; transform: scale(1)    translateY(0); }
        }
    </style>
</head>
<body class="antialiased selection:bg-sage selection:text-base">

    <!-- Global Loader -->
    <?php include 'loader.php'; ?>

    <div id="app" class="relative" v-cloak>

    <!-- FLOATING NAVBAR -->
    <div class="fixed top-0 left-0 right-0 z-50 px-4 py-6 transition-all duration-500" id="navbar-wrapper">
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
                <div class="navbar-end w-1/3 flex justify-end">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <button @click="openModal" class="btn bg-charcoal hover:bg-sage text-white rounded-full border-none px-4 sm:px-6 shadow-sm transition-all">
                            <i class="fi fi-rr-cloud-upload"></i> <span class="hidden sm:inline">Unggah</span>
                        </button>
                    <?php else: ?>
                        <button @click="openLoginModal" class="btn bg-charcoal hover:bg-sage text-white rounded-full border-none px-4 sm:px-6 shadow-sm transition-all inline-flex items-center gap-2">
                            <i class="fi fi-rr-user"></i> <span class="hidden sm:inline">Masuk untuk Unggah</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="pt-36 sm:pt-40 pb-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative min-h-screen">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 gsap-fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-sage/10 rounded-full text-xs font-bold text-sage tracking-widest uppercase mb-6 border border-sage/20">
                <i class="fi fi-rr-camera"></i> Eksplorasi Visual
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-serif text-charcoal leading-tight mb-4 sm:mb-6">
                Galeri <span class="italic text-sage">Komunitas</span>
            </h1>
            <p class="text-charcoal/60 text-base md:text-lg lg:text-xl font-medium leading-relaxed">
                Kumpulan momen indah yang diabadikan oleh para pengunjung di Tebing Lonceng.
            </p>
        </div>

        <!-- Gallery Grid -->
        <?php if (count($galleries) > 0): ?>
            <div class="masonry-grid gsap-stagger">
                <?php foreach ($galleries as $galeri): ?>
                    <div class="masonry-item relative group overflow-hidden rounded-3xl cursor-pointer bg-white shadow-sm border border-black/5">
                        <div class="relative overflow-hidden aspect-auto">
                            <img src="../../<?= htmlspecialchars($galeri['image_path']) ?>" alt="Galeri" class="w-full h-auto object-cover img-hover-zoom" loading="lazy">
                        </div>
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6">
                            <h3 class="text-white font-serif text-2xl mb-1 truncate"><?= htmlspecialchars($galeri['nama']) ?></h3>
                            <?php if (!empty($galeri['caption'])): ?>
                                <p class="text-white/80 text-sm line-clamp-2"><?= htmlspecialchars($galeri['caption']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-black/5 shadow-sm">
                <div class="w-20 h-20 bg-sage/10 rounded-full flex items-center justify-center mx-auto mb-4 text-sage text-3xl">
                    <i class="fi fi-rr-picture"></i>
                </div>
                <h3 class="text-2xl font-serif text-charcoal mb-2">Belum Ada Foto</h3>
                <p class="text-charcoal/60 mb-6">Jadilah yang pertama membagikan momen indah Anda!</p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <button @click="openModal" class="btn bg-charcoal hover:bg-sage text-white rounded-full border-none px-8">
                        Unggah Momen Pertama
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </main>

    <!-- LOGIN MODAL -->
    <div v-if="isLoginOpen" class="fixed inset-0 z-[110] flex items-center justify-center px-4" v-cloak>
        <div class="absolute inset-0 bg-black/40 backdrop-blur-md" @click="closeLoginModal"></div>
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md relative z-10 overflow-hidden"
             style="animation: modalEnter 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
            <div class="p-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-3xl font-serif text-charcoal">Masuk</h3>
                        <p class="text-sm text-charcoal/50 mt-1">Masuk untuk mulai berbagi momen indahmu.</p>
                    </div>
                    <button @click="closeLoginModal" class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center hover:bg-black/10 transition-colors">
                        <i class="fi fi-rr-cross text-sm"></i>
                    </button>
                </div>

                <?php if (!empty($_SESSION['galeri_auth_error'])): ?>
                <div class="bg-red-50 text-red-500 text-sm p-3 rounded-xl border border-red-100 flex items-center gap-2 mb-5">
                    <i class="fi fi-rr-exclamation"></i>
                    <?= htmlspecialchars($_SESSION['galeri_auth_error']) ?>
                    <?php unset($_SESSION['galeri_auth_error']); ?>
                </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="../../actions/user/login_galeri.php">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-charcoal mb-2">Email</label>
                        <input type="email" name="email" required placeholder="nama@email.com"
                               class="w-full bg-[#FBF9F6] border border-black/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-sage focus:ring-1 focus:ring-sage transition-colors">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-charcoal mb-2">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" required placeholder="Min. 6 karakter"
                                   class="w-full bg-[#FBF9F6] border border-black/10 rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:border-sage focus:ring-1 focus:ring-sage transition-colors">
                            <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-charcoal/40 hover:text-charcoal transition-colors">
                                <i :class="showPassword ? 'fi fi-rr-eye-crossed' : 'fi fi-rr-eye'"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-xs text-charcoal/40 mb-5 leading-relaxed">
                        Belum punya akun? Isi email & password baru — akun akan dibuat otomatis.
                    </p>
                    <button type="submit" class="w-full btn bg-charcoal hover:bg-sage text-white rounded-xl border-none h-12 text-base font-bold transition-colors shadow-lg">
                        Masuk &amp; Lanjut Unggah
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- UPLOAD MODAL (Vue) -->
    <div v-if="isModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center px-4" v-cloak>
        <div class="absolute inset-0 bg-black/40 backdrop-blur-md" @click="closeModal"></div>
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden" 
             style="animation: modalEnter 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
            
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-serif text-charcoal">Unggah Foto</h3>
                    <button @click="closeModal" class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center hover:bg-black/10 transition-colors">
                        <i class="fi fi-rr-cross text-sm"></i>
                    </button>
                </div>

                <div v-if="uploadSuccess" class="bg-sage/10 text-sage p-4 rounded-xl text-center mb-6 flex flex-col items-center border border-sage/20">
                    <i class="fi fi-rr-check-circle text-4xl mb-2"></i>
                    <p class="font-medium">Foto berhasil diunggah!</p>
                    <p class="text-sm opacity-80 mt-1">Menunggu persetujuan admin sebelum ditampilkan.</p>
                    <button @click="resetForm" class="mt-4 btn btn-sm bg-sage text-white rounded-full border-none">Unggah Lagi</button>
                </div>

                <form v-else @submit.prevent="submitUpload" enctype="multipart/form-data">
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-charcoal mb-2">Pilih Foto</label>
                        <div class="relative group cursor-pointer">
                            <input type="file" ref="fileInput" @change="handleFileChange" accept="image/jpeg, image/png, image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                            <div class="border-2 border-dashed border-black/10 rounded-2xl p-8 text-center group-hover:border-sage group-hover:bg-sage/5 transition-all" :class="{'border-sage bg-sage/5': selectedFile}">
                                <div v-if="!selectedFile">
                                    <i class="fi fi-rr-cloud-upload text-3xl text-charcoal/40 group-hover:text-sage mb-2"></i>
                                    <p class="text-charcoal/60 text-sm">Klik atau seret foto ke sini<br><span class="text-xs opacity-70">Maks. 5MB (JPG, PNG, WEBP)</span></p>
                                </div>
                                <div v-else class="text-sage">
                                    <i class="fi fi-rr-document text-3xl mb-2"></i>
                                    <p class="font-medium text-sm truncate">{{ selectedFile.name }}</p>
                                    <p class="text-xs opacity-70 mt-1">{{ (selectedFile.size / 1024 / 1024).toFixed(2) }} MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-charcoal mb-2">Caption <span class="text-charcoal/40 font-normal">(Opsional)</span></label>
                        <textarea v-model="caption" rows="3" class="w-full bg-[#FBF9F6] border border-black/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-sage focus:ring-1 focus:ring-sage transition-colors resize-none" placeholder="Ceritakan sedikit tentang momen ini..."></textarea>
                    </div>

                    <div v-if="errorMessage" class="text-red-500 text-sm mb-4 bg-red-50 p-3 rounded-xl border border-red-100 flex items-center gap-2">
                        <i class="fi fi-rr-exclamation"></i> {{ errorMessage }}
                    </div>

                    <button type="submit" class="w-full btn bg-charcoal hover:bg-sage text-white rounded-xl border-none h-12 text-base font-bold transition-colors shadow-lg" :disabled="isUploading">
                        <span v-if="isUploading" class="loading loading-spinner loading-sm"></span>
                        <span v-else>Unggah Sekarang</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* removed — moved to main <style> block */
    </style>

    <script>
        const { createApp, ref, onMounted } = Vue;

        createApp({
            setup() {
                const isModalOpen  = ref(false);
                const isLoginOpen  = ref(false);
                const showPassword = ref(false);
                const isUploading  = ref(false);
                const uploadSuccess = ref(false);
                const selectedFile = ref(null);
                const caption      = ref('');
                const errorMessage = ref('');
                const fileInput    = ref(null);

                // ── Upload Modal ──
                const openModal = () => {
                    isModalOpen.value = true;
                    document.body.style.overflow = 'hidden';
                };
                const closeModal = () => {
                    isModalOpen.value = false;
                    document.body.style.overflow = '';
                    resetForm();
                };

                // ── Login Modal ──
                const openLoginModal = () => {
                    isLoginOpen.value = true;
                    document.body.style.overflow = 'hidden';
                };
                const closeLoginModal = () => {
                    isLoginOpen.value = false;
                    document.body.style.overflow = '';
                };

                // Auto-open login modal jika ada error dari server
                <?php if (!empty($_SESSION['galeri_auth_error'])): ?>
                    isLoginOpen.value = true;
                <?php endif; ?>

                const handleFileChange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        if (file.size > 5 * 1024 * 1024) {
                            errorMessage.value = "Ukuran foto maksimal 5MB.";
                            selectedFile.value = null;
                            e.target.value = '';
                        } else {
                            errorMessage.value = "";
                            selectedFile.value = file;
                        }
                    }
                };

                const resetForm = () => {
                    uploadSuccess.value = false;
                    selectedFile.value = null;
                    caption.value = '';
                    errorMessage.value = '';
                    if (fileInput.value) fileInput.value.value = '';
                };

                const submitUpload = async () => {
                    if (!selectedFile.value) {
                        errorMessage.value = "Silakan pilih foto terlebih dahulu.";
                        return;
                    }

                    isUploading.value = true;
                    errorMessage.value = "";

                    const formData = new FormData();
                    formData.append('foto', selectedFile.value);
                    formData.append('caption', caption.value);

                    try {
                        const response = await fetch('../../actions/user/upload_galeri.php', {
                            method: 'POST',
                            body: formData
                        });

                        const result = await response.json();

                        if (result.status === 'success') {
                            uploadSuccess.value = true;
                        } else {
                            errorMessage.value = result.message || "Gagal mengunggah foto.";
                        }
                    } catch (error) {
                        errorMessage.value = "Terjadi kesalahan pada server.";
                    } finally {
                        isUploading.value = false;
                    }
                };

                onMounted(() => {
                    // GSAP Animations (Delayed to wait for loader exit)
                    gsap.from('.gsap-fade-up', {
                        y: 50,
                        opacity: 0,
                        duration: 1,
                        delay: 1.2,
                        ease: 'power3.out'
                    });

                    gsap.from('.masonry-item', {
                        y: 50,
                        opacity: 0,
                        duration: 0.8,
                        stagger: 0.1,
                        delay: 1.2,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: '.masonry-grid',
                            start: 'top 80%',
                        }
                    });
                });

                return {
                    isModalOpen,
                    isLoginOpen,
                    showPassword,
                    isUploading,
                    uploadSuccess,
                    selectedFile,
                    caption,
                    errorMessage,
                    fileInput,
                    openModal,
                    closeModal,
                    openLoginModal,
                    closeLoginModal,
                    handleFileChange,
                    resetForm,
                    submitUpload
                };
            }
        }).mount('#app');
    </script>
</body>
</html>
