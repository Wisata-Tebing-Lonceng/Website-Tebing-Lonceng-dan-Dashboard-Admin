<?php
// views/admin/settings.php
// $admin provided by AdminController::settings()
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tebing Lonceng Admin</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <!-- GSAP & Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #FBF9F6;
            color: #1a1a1a; 
        }
        [v-cloak] { display: none !important; }

        .glass-sidebar {
            background: rgba(251, 249, 246, 0.7);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }

        .sidebar-item {
            display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; border-radius: 1rem; font-size: 0.875rem; font-weight: 500; transition: all 0.3s; color: rgba(26,26,26,0.7);
        }
        .sidebar-item:hover:not(.active) {
            background-color: rgba(0,0,0,0.05); color: #1a1a1a;
        }
        .sidebar-item.active {
            background-color: rgba(107,123,98,0.1); color: #6b7b62; font-weight: 700;
        }
        
        .sidebar-heading {
            display: flex; align-items: center; justify-content: space-between; font-size: 0.625rem; font-weight: 800; color: rgba(26,26,26,0.4); margin-bottom: 0.25rem; margin-top: 1.5rem; padding: 0 1rem; text-transform: uppercase; letter-spacing: 0.1em;
        }

        .drawer-side .drawer-overlay {
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(4px);
        }
        
        .form-card {
            background-color: white; border-radius: 2rem; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 8px 30px rgba(0,0,0,0.04); overflow: hidden;
        }
        
        .table-container {
            background-color: white; border-radius: 1.5rem; border: 1px solid rgba(0,0,0,0.05); overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.03);
        }
        .table-container th {
            background-color: transparent; color: rgba(26,26,26,0.5); font-weight: 600; font-size: 0.6875rem; padding: 1rem 1.5rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .table-container td {
            padding: 1rem 1.5rem; border-bottom: 1px solid rgba(0,0,0,0.02); font-size: 0.875rem;
        }
    </style>
</head>
<body>

    <!-- Include Global Loader -->
    <?php include __DIR__ . '/../user/loader.php'; ?>

    <div class="drawer lg:drawer-open" id="app" v-cloak>
        <input id="admin-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- MAIN CONTENT -->
        <div class="drawer-content m-4 h-[calc(100vh-2rem)] overflow-y-auto bg-white rounded-xl shadow-[-10px_0_40px_rgba(0,0,0,0.04)] border-l border-black/5 relative z-10 custom-scrollbar">
            
            <!-- Navbar -->
            <div class="px-6 lg:px-10 py-6 flex items-center justify-between gs-reveal sticky top-0 bg-white/80 backdrop-blur-xl z-20 border-b border-black/5">
                <div class="flex items-center gap-4">
                    <label for="admin-drawer" class="btn btn-square btn-ghost btn-sm lg:hidden bg-charcoal/5 text-charcoal">
                        <i class="fi fi-rr-menu-burger"></i>
                    </label>
                    <div class="flex items-center gap-2 text-charcoal font-serif text-2xl tracking-tight">
                        Pengaturan
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-6">
                    <!-- Right side empty for settings page -->
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="p-4 lg:p-10">
                <div class="max-w-4xl mx-auto">
                    
                    <!-- Header -->
                    <div class="mb-12 gs-sb-item flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 border-b border-black/5 pb-8">
                        <div>
                            <h2 class="text-5xl lg:text-6xl font-serif text-charcoal leading-tight mb-3">Pengaturan Akun<br/><span class="italic text-sage/80">& Privasi.</span></h2>
                            <p class="text-charcoal/60 max-w-xl font-medium">Perbarui identitas digital dan tingkatkan keamanan akses administratif Anda.</p>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-charcoal/40 bg-black/5 px-4 py-2 rounded-full">
                            <i class="fi fi-rr-shield-check text-sage"></i> Keamanan Tinggi
                        </div>
                    </div>

                    <form @submit.prevent="saveProfile" class="gs-sb-item">
                        
                        <!-- Alerts -->
                        <div v-if="successMsg" class="alert bg-green-50 text-green-700 border-green-100 rounded-3xl mb-8 p-4 flex items-center gap-3 animate-fade-in border font-bold text-sm">
                            <i class="fi fi-rr-check-circle"></i>
                            <span>{{ successMsg }}</span>
                        </div>
                        <div v-if="errorMsg" class="alert bg-red-50 text-red-700 border-red-100 rounded-3xl mb-8 p-4 flex items-center gap-3 animate-fade-in border font-bold text-sm">
                            <i class="fi fi-rr-exclamation"></i>
                            <span>{{ errorMsg }}</span>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                            <!-- Left: Profile Widget -->
                            <div class="w-full lg:w-1/3 flex flex-col items-center lg:items-start">
                                <div class="bg-white p-8 rounded-[2.5rem] border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] w-full flex flex-col items-center text-center relative overflow-hidden group">
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-sage/10 rounded-full blur-[40px] pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
                                    
                                    <div class="relative mb-6">
                                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-full ring-4 ring-[#FBF9F6] shadow-xl overflow-hidden bg-sage/10 transition-transform duration-500 group-hover:scale-105">
                                            <img :src="previewUrl || (adminProfilePic ? '../' + adminProfilePic : null) || 'https://ui-avatars.com/api/?name=' + adminUsername + '&background=6B7B62&color=fff'" alt="Profile" class="w-full h-full object-cover" />
                                        </div>
                                        <label for="pic-upload" class="absolute bottom-1 right-1 md:bottom-2 md:right-2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-charcoal hover:bg-sage text-white border-4 border-white shadow-lg cursor-pointer flex items-center justify-center transition-colors">
                                            <i class="fi fi-rr-camera text-sm md:text-base"></i>
                                        </label>
                                        <input type="file" id="pic-upload" class="hidden" accept="image/*" @change="onFileChange">
                                    </div>
                                    
                                    <h3 class="text-2xl md:text-3xl font-serif text-charcoal italic">{{ adminUsername }}</h3>
                                    <p class="text-[10px] text-sage font-black uppercase tracking-[0.2em] mt-3 bg-sage/10 px-4 py-1.5 rounded-full inline-flex items-center gap-1.5 border border-sage/20">
                                        <i class="fi fi-rr-user-crown text-[10px]"></i> Administrator
                                    </p>
                                </div>
                            </div>

                            <!-- Right: Forms -->
                            <div class="w-full lg:w-2/3 space-y-6">
                                
                                <!-- Identity Form -->
                                <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-64 h-64 bg-clay/5 rounded-full blur-[60px] pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
                                    
                                    <div class="flex items-center gap-4 mb-8 relative z-10">
                                        <div class="w-12 h-12 rounded-2xl bg-[#FBF9F6] border border-black/5 text-charcoal flex items-center justify-center shadow-sm">
                                            <i class="fi fi-rr-id-badge text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-2xl font-serif text-charcoal leading-none">Identitas Login</h4>
                                            <p class="text-xs font-medium text-charcoal/40 mt-1">Gunakan username unik untuk masuk.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="form-control w-full relative z-10">
                                        <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Username Utama</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-charcoal/30">
                                                <i class="fi fi-rr-at"></i>
                                            </div>
                                            <input type="text" v-model="form.username" class="input input-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal h-14 pl-12" required placeholder="admin_tebing">
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Form -->
                                <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-64 h-64 bg-sage/5 rounded-full blur-[60px] pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
                                    
                                    <div class="flex items-center gap-4 mb-8 relative z-10">
                                        <div class="w-12 h-12 rounded-2xl bg-[#FBF9F6] border border-black/5 text-charcoal flex items-center justify-center shadow-sm">
                                            <i class="fi fi-rr-lock text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-2xl font-serif text-charcoal leading-none">Keamanan Sandi</h4>
                                            <p class="text-xs font-medium text-charcoal/40 mt-1">Kosongkan jika Anda tidak ingin mengganti password.</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                                        <div class="form-control w-full">
                                            <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Password Baru</span></label>
                                            <input type="password" v-model="form.password" class="input input-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal h-14" placeholder="••••••••">
                                        </div>
                                        <div class="form-control w-full">
                                            <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Konfirmasi Password</span></label>
                                            <input type="password" v-model="form.confirm" class="input input-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal h-14" placeholder="••••••••">
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8">
                                    <button type="button" class="btn bg-white border border-black/5 text-charcoal hover:bg-black/5 rounded-xl px-8 h-14 font-bold transition-all duration-300 shadow-sm" @click="form.password=''; form.confirm='';">
                                        Batal Perubahan
                                    </button>
                                    <button type="submit" :disabled="isLoading" class="btn bg-charcoal hover:bg-sage text-white border-none rounded-xl px-8 h-14 font-bold transition-all duration-300 shadow-[0_8px_30px_rgba(0,0,0,0.12)] flex items-center gap-2">
                                        <span v-if="isLoading" class="loading loading-spinner loading-sm"></span>
                                        <i v-else class="fi fi-rr-disk"></i>
                                        {{ isLoading ? 'Menyimpan...' : 'Simpan Pengaturan' }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div> <!-- /Page Content -->
        </div> <!-- /Drawer Content -->
        
        <!-- SIDEBAR COMPONENT -->
        <?php include __DIR__ . '/components/sidebar.php'; ?>
    </div> <!-- /Drawer -->

    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    adminUsername: <?= json_encode($admin['username']) ?>,
                    adminProfilePic: <?= json_encode($admin['profile_pic']) ?>,
                    form: {
                        username: <?= json_encode($admin['username']) ?>,
                        password: '',
                        confirm: ''
                    },
                    pendingFile: null,
                    previewUrl: null,
                    isLoading: false,
                    successMsg: '',
                    errorMsg: ''
                }
            },
            mounted() {
                if (typeof gsap !== 'undefined') {
                    gsap.from('.gs-sb-item', {
                        y: 30,
                        opacity: 0,
                        duration: 1,
                        stagger: 0.1,
                        ease: 'power3.out',
                        delay: 0.2
                    });
                }
            },
            methods: {
                onFileChange(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    this.pendingFile = file;
                    this.previewUrl = URL.createObjectURL(file);
                },
                async saveProfile() {
                    if (this.form.password && this.form.password !== this.form.confirm) {
                        this.errorMsg = 'Konfirmasi password tidak cocok.';
                        return;
                    }

                    this.isLoading = true;
                    this.successMsg = '';
                    this.errorMsg = '';

                    const fd = new FormData();
                    fd.append('username', this.form.username);
                    fd.append('password', this.form.password);
                    if (this.pendingFile) fd.append('profile_pic', this.pendingFile);

                    try {
                        const res = await fetch('actions/profile.php', { method: 'POST', body: fd });
                        const data = await res.json();
                        if (data.success) {
                            this.successMsg = data.message;
                            this.adminUsername = data.username;
                            if (data.profile_pic) this.adminProfilePic = data.profile_pic;
                            this.form.password = '';
                            this.form.confirm = '';
                            this.pendingFile = null;
                            this.previewUrl = null;
                        } else {
                            this.errorMsg = data.message;
                        }
                    } catch (err) {
                        this.errorMsg = 'Gagal menyimpan data.';
                    } finally {
                        this.isLoading = false;
                        setTimeout(() => { this.successMsg = ''; this.errorMsg = ''; }, 4000);
                    }
                }
            }
        }).mount('#app');
    </script>
</body>
</html>
