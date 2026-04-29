<?php
// views/admin_login.php — session dikelola oleh entry point (admin/login.php)
?>
<!DOCTYPE html>
<html lang="id" data-theme="lofi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Tebing Lonceng</title>
    
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/vendor/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="../assets/vendor/uicons-solid-rounded/css/uicons-solid-rounded.css">

    <!-- JS -->
    <script src="../assets/vendor/vue.global.prod.js"></script>
    <script src="../assets/vendor/gsap.min.js"></script>
<!-- Tailwind & DaisyUI CDN -->
    <!-- Fonts & Icons -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a1a1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-card {
            background: rgba(251, 249, 246, 0.85); /* Base color slightly transparent */
            backdrop-filter: blur(30px) saturate(150%);
            -webkit-backdrop-filter: blur(30px) saturate(150%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: fadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3), inset 0 0 0 1px rgba(255,255,255,0.2);
            position: relative;
            z-index: 10;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); filter: blur(5px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        /* ── DaisyUI input + override ── */
        .input {
            background-color: rgba(251, 249, 246, 0.8) !important;
            border-color: rgba(0,0,0,0.08) !important;
            color: #1a1a1a;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        .input:focus, .input:focus-within {
            background-color: #ffffff !important;
            border-color: rgba(107,123,98,0.5) !important;
            box-shadow: 0 0 0 3px rgba(107,123,98,0.1) !important;
            outline: none !important;
        }

        [v-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased text-charcoal">

    <!-- Video Background -->
    <video autoplay muted loop playsinline loading="lazy" class="absolute inset-0 w-full h-full object-cover z-0 scale-105 pointer-events-none transform-gpu">
        <source src="../assets/vd/tebing-lonceng-vd.webm" type="video/webm">
    </video>
    
    <!-- Dark Overlay + Blur -->
    <div class="absolute inset-0 z-0 bg-charcoal/50 backdrop-blur-sm"></div>

    <!-- Include Global Loader -->
    <?php include __DIR__ . '/../user/loader.php'; ?>
    
    <div id="admin-app" class="login-card rounded-[2.5rem] p-10 w-full max-w-[420px] mx-4 text-center z-10" v-cloak>
        
        <div class="w-16 h-16 bg-sage text-white rounded-[1.25rem] flex items-center justify-center mx-auto mb-6 shadow-lg shadow-sage/30 border border-white/20">
            <i class="fi fi-rr-settings-sliders text-2xl"></i>
        </div>
        
        <h1 class="text-4xl font-serif text-charcoal mb-1 tracking-tight">Tebing<span class="italic text-sage">Lonceng</span></h1>
        <p class="text-charcoal/40 text-[10px] font-bold tracking-[0.2em] uppercase mb-10">Admin Console</p>

        <div v-if="errorMessage" class="bg-red-50 text-red-600 border border-red-100 p-4 mb-6 rounded-[1rem] text-xs font-medium text-left flex gap-3 shadow-sm">
            <i class="fi fi-rr-exclamation mt-0.5"></i>
            <span>{{ errorMessage }}</span>
        </div>

        <form @submit.prevent="loginAdmin" class="text-left">
            <div class="flex flex-col gap-5 mb-8">
                <div class="flex-1">
                    <label class="text-[10px] uppercase font-black tracking-widest text-charcoal/40 mb-2 block">Username</label>
                    <label class="input w-full h-14 bg-[#fbf9f6] border border-black/8 rounded-2xl text-charcoal focus-within:border-sage/60 transition-colors flex items-center gap-2">
                        <svg class="h-[1.2em] opacity-40 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></g></svg>
                        <input type="text" v-model="username" placeholder="ID Admin" required="" class="bg-transparent w-full text-charcoal placeholder:text-charcoal/30 border-none outline-none text-sm" autofocus autocomplete="username">
                    </label>
                </div>
                <div class="flex-1">
                    <label class="text-[10px] uppercase font-black tracking-widest text-charcoal/40 mb-2 block">Password</label>
                    <label class="input w-full h-14 relative bg-[#fbf9f6] border border-black/8 rounded-2xl text-charcoal focus-within:border-sage/60 transition-colors flex items-center gap-2 pr-10">
                        <svg class="h-[1.2em] opacity-40 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input :type="showPassword ? 'text' : 'password'" v-model="password" placeholder="••••••••" required="" minlength="6" class="bg-transparent w-full text-charcoal placeholder:text-charcoal/30 border-none outline-none text-sm tracking-widest" autocomplete="current-password">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-charcoal/40 hover:text-charcoal transition-colors p-1">
                            <i class="fi" :class="showPassword ? 'fi-rr-eye-crossed' : 'fi-rr-eye'"></i>
                        </button>
                    </label>
                </div>
            </div>

            <button type="submit" :disabled="loading" class="btn bg-charcoal hover:bg-sage text-white w-full rounded-[1.25rem] border-none font-bold tracking-widest uppercase text-[10px] h-14 shadow-[0_8px_20px_rgba(26,26,26,0.2)] transition-all duration-300 group">
                <span v-if="loading" class="loading loading-spinner loading-sm"></span>
                {{ loading ? 'Otentikasi...' : 'Masuk Dashboard' }}
                <i v-if="!loading" class="fi fi-rr-arrow-right text-[10px] ml-1 group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>

        <p class="text-charcoal/30 text-[9px] mt-10 uppercase font-bold tracking-widest">
            &copy; <?= date('Y') ?> Tebing Lonceng
        </p>
    </div>

    <!-- Vue.js 3 CDN -->
<<<<<<< HEAD
=======
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9
    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    username: '',
                    password: '',
                    loading: false,
                    errorMessage: '',
                    showPassword: false
                }
            },
            methods: {
                async loginAdmin() {
                    this.loading = true;
                    this.errorMessage = '';
                    
                    try {
                        const formData = new URLSearchParams();
                        formData.append('username', this.username);
                        formData.append('password', this.password);

                        const response = await fetch('actions/login.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: formData
                        });

                        const result = await response.json();
                        
                        if (result.success) {
                            window.location.href = 'overview.php';
                        } else {
                            this.errorMessage = result.message || 'Login gagal. Periksa kembali akses Anda.';
                        }
                    } catch (error) {
                        this.errorMessage = 'Terjadi gangguan jaringan. Silakan coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }).mount('#admin-app');
    </script>
</body>
</html>
