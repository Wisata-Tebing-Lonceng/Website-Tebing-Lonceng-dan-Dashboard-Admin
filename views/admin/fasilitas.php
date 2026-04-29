<?php
// views/admin/fasilitas.php
// $fasilitas  => array dikelompokkan: ['spotfoto'=>[...], 'homestay'=>[...]]
// $settings   => array dari tabel settings
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
                        Fasilitas
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-6">
                    <a href="settings.php" class="btn btn-sm bg-[#FBF9F6] border border-black/5 text-charcoal hover:bg-sage/10 hover:text-sage hover:border-sage/20 rounded-xl px-4 font-bold shadow-sm transition-colors">
                        <i class="fi fi-rr-edit"></i> <span class="hidden sm:inline">Edit Profil</span>
                    </a>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="p-4 lg:p-10">
                <div class="max-w-7xl mx-auto">
                    
                    <!-- Banner -->
                    <div class="relative w-full rounded-[2rem] overflow-hidden p-8 lg:p-12 mb-8 gs-sb-item flex flex-col justify-between min-h-[320px] lg:min-h-[380px] border border-black/5 bg-[#FBF9F6]">
                        
                        <!-- Project Palette Mesh Gradient Background -->
                        <div class="absolute -top-[10%] -right-[5%] w-[60%] h-[70%] bg-sage/30 rounded-full blur-[80px] pointer-events-none"></div>
                        <div class="absolute top-[20%] right-[10%] w-[40%] h-[50%] bg-clay/20 rounded-full blur-[60px] pointer-events-none"></div>
                        <div class="absolute -bottom-[20%] -left-[10%] w-[50%] h-[60%] bg-sage/40 rounded-full blur-[80px] pointer-events-none"></div>
                        <div class="absolute top-0 left-0 w-[40%] h-[40%] bg-white/60 rounded-full blur-[60px] pointer-events-none"></div>
                        <div class="absolute inset-0 bg-white/30 backdrop-blur-[2px] pointer-events-none"></div>

                        <!-- Top: Icons & Label -->
                        <div class="relative z-10 flex items-center gap-3">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-charcoal text-white flex items-center justify-center border-2 border-[#FBF9F6] shadow-sm z-20">
                                    <i class="fi fi-rr-camera text-[10px]"></i>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-charcoal text-white flex items-center justify-center border-2 border-[#FBF9F6] shadow-sm z-10">
                                    <i class="fi fi-rr-cabin text-[10px]"></i>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-charcoal/80 tracking-widest uppercase">Fasilitas & Spot</span>
                        </div>

                        <!-- Bottom: Typography -->
                        <div class="relative z-10 mt-16 max-w-2xl">
                            <h2 class="text-6xl lg:text-[5.5rem] font-serif text-charcoal leading-[1.05] tracking-tight mb-3">
                                Visualisasi <br/> <span class="italic pr-4">fasilitas & spot</span>
                            </h2>
                            <p class="text-charcoal/60 font-medium text-sm lg:text-base">Kurasi visual dan deskripsi terbaik untuk memikat hati calon pengunjung.</p>
                        </div>
                    </div>

                    <!-- Global Alerts -->
                    <div v-if="globalSuccess" class="alert bg-green-50 text-green-700 border border-green-100 rounded-3xl mb-8 p-4 flex items-center gap-3 animate-fade-in">
                        <i class="fi fi-rr-check-circle text-xl"></i>
                        <span class="font-bold text-sm">{{ globalSuccess }}</span>
                    </div>

                    <!-- SECTION: SPOT FOTO -->
                    <div class="mb-16">
                        <div class="flex items-center gap-4 mb-8 gs-sb-item">
                            <div class="w-12 h-12 rounded-2xl bg-sage/10 text-sage flex items-center justify-center">
                                <i class="fi fi-rr-camera text-xl"></i>
                            </div>
                            <h3 class="text-3xl font-serif text-charcoal">Spot Fotografi</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 gs-sb-item">
                            <?php foreach (($fasilitas['spotfoto'] ?? []) as $item): ?>
                            <div class="form-card group">
                                <div class="relative h-60 bg-[#fbf9f6] overflow-hidden">
                                    <img :src="getGambar(<?= $item['id'] ?>, '../<?= htmlspecialchars($item['gambar']) ?>')" @error="onImgError" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                    
                                    <!-- Badges -->
                                    <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                                        <span class="badge bg-white/80 backdrop-blur-md text-charcoal border-none font-bold text-[10px] px-3 py-3 rounded-full shadow-sm">SPOT <?= $item['urutan'] ?></span>
                                    </div>

                                    <!-- Upload Trigger -->
                                    <label for="file-sf-<?= $item['id'] ?>" class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                                        <div class="w-12 h-12 rounded-full bg-white text-charcoal flex items-center justify-center shadow-xl translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                            <i class="fi fi-rr-upload"></i>
                                        </div>
                                    </label>
                                    <input type="file" id="file-sf-<?= $item['id'] ?>" class="hidden" accept="image/*" @change="onFileChange($event, <?= $item['id'] ?>)">
                                </div>
                                
                                <div class="p-6 space-y-4">
                                    <div class="form-control">
                                        <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Nama Spot</span></label>
                                        <input type="text" id="judul-<?= $item['id'] ?>" class="input input-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal h-11 text-sm font-bold" value="<?= htmlspecialchars($item['judul']) ?>" />
                                    </div>
                                    <div class="form-control">
                                        <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Deskripsi Singkat</span></label>
                                        <textarea id="deskripsi-<?= $item['id'] ?>" class="textarea textarea-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal text-xs h-24"><?= htmlspecialchars($item['deskripsi']) ?></textarea>
                                    </div>
                                    
                                    <button @click="saveItem(<?= $item['id'] ?>)" :disabled="saving[<?= $item['id'] ?>]" class="btn bg-charcoal hover:bg-sage text-white border-none rounded-full px-8 font-bold transition-all duration-300 w-full h-12 text-sm shadow-lg shadow-charcoal/5">
                                        <span v-if="saving[<?= $item['id'] ?>]" class="loading loading-spinner loading-xs"></span>
                                        <span v-else>Simpan Perubahan</span>
                                    </button>
                                    
                                    <p v-if="cardMsg[<?= $item['id'] ?>]" :class="cardMsgClass[<?= $item['id'] ?>]" class="text-[10px] text-center font-bold h-3 transition-opacity">
                                        {{ cardMsg[<?= $item['id'] ?>] }}
                                    </p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- SECTION: HOMESTAY -->
                    <div class="mb-20">
                        <div class="flex items-center gap-4 mb-8 gs-sb-item">
                            <div class="w-12 h-12 rounded-2xl bg-clay/10 text-clay flex items-center justify-center">
                                <i class="fi fi-rr-cabin text-xl"></i>
                            </div>
                            <h3 class="text-3xl font-serif text-charcoal">Homestay & Penginapan</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 gs-sb-item">
                            <?php foreach (($fasilitas['homestay'] ?? []) as $item): ?>
                            <div class="form-card group">
                                <div class="relative h-64 bg-[#fbf9f6] overflow-hidden">
                                    <img :src="getGambar(<?= $item['id'] ?>, '../<?= htmlspecialchars($item['gambar']) ?>')" @error="onImgError" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                    
                                    <div class="absolute top-4 left-4">
                                        <span class="badge bg-clay text-white border-none font-bold text-[10px] px-3 py-3 rounded-full shadow-sm uppercase tracking-widest">Kabin <?= $item['urutan'] ?></span>
                                    </div>

                                    <label for="file-hs-<?= $item['id'] ?>" class="absolute inset-0 bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                                        <div class="w-12 h-12 rounded-full bg-white text-charcoal flex items-center justify-center shadow-xl translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                            <i class="fi fi-rr-camera"></i>
                                        </div>
                                    </label>
                                    <input type="file" id="file-hs-<?= $item['id'] ?>" class="hidden" accept="image/*" @change="onFileChange($event, <?= $item['id'] ?>)">
                                </div>
                                
                                <div class="p-6">
                                    <button @click="saveItem(<?= $item['id'] ?>)" :disabled="saving[<?= $item['id'] ?>]" class="btn bg-[#fbf9f6] hover:bg-clay hover:text-white text-charcoal border-none rounded-full w-full h-12 text-sm font-bold transition-all duration-300">
                                        <span v-if="saving[<?= $item['id'] ?>]" class="loading loading-spinner loading-xs"></span>
                                        <span v-else>Update Foto Kabin</span>
                                    </button>
                                    
                                    <p v-if="cardMsg[<?= $item['id'] ?>]" :class="cardMsgClass[<?= $item['id'] ?>]" class="text-[10px] text-center font-bold mt-4 h-3 transition-opacity">
                                        {{ cardMsg[<?= $item['id'] ?>] }}
                                    </p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

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
                pendingFiles: {},
                previewUrls: {},
                saving: {},
                cardMsg: {},
                cardMsgClass: {},
                globalSuccess: '',
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
            getGambar(id, serverUrl) {
                return this.previewUrls[id] || serverUrl;
            },
            onFileChange(event, id) {
                const file = event.target.files[0];
                if (!file) return;
                if (file.size > 10 * 1024 * 1024) {
                    this.showCardMsg(id, '⚠ File terlalu besar.', false);
                    return;
                }
                this.pendingFiles[id] = file;
                if (this.previewUrls[id]) { URL.revokeObjectURL(this.previewUrls[id]); }
                this.previewUrls[id] = URL.createObjectURL(file);
            },
            onImgError(e) {
                e.target.src = '../assets/img/1.webp';
            },
            async saveItem(id) {
                this.saving[id]  = true;
                this.cardMsg[id] = '';
                this.globalSuccess = '';

                const judul    = document.getElementById('judul-' + id)?.value || '';
                const deskripsi = document.getElementById('deskripsi-' + id)?.value || '';

                const formData = new FormData();
                formData.append('id', id);
                formData.append('judul', judul);
                formData.append('deskripsi', deskripsi);

                if (this.pendingFiles[id]) {
                    formData.append('gambar', this.pendingFiles[id]);
                }

                try {
                    const res = await fetch('actions/fasilitas.php', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await res.json();

                    if (data.success) {
                        this.showCardMsg(id, '✓ Tersimpan', true);
                        if (this.pendingFiles[id]) {
                            URL.revokeObjectURL(this.previewUrls[id]);
                            this.previewUrls[id] = data.gambar_url + '?t=' + Date.now();
                            delete this.pendingFiles[id];
                        }
                        this.globalSuccess = 'Data fasilitas berhasil diperbarui.';
                    } else {
                        this.showCardMsg(id, '✕ Gagal', false);
                    }
                } catch (err) {
                    this.showCardMsg(id, '✕ Error Jaringan', false);
                } finally {
                    this.saving[id] = false;
                }
            },
            showCardMsg(id, msg, success) {
                this.cardMsg[id] = msg;
                this.cardMsgClass[id] = success ? 'text-sage' : 'text-red-500';
                setTimeout(() => { this.cardMsg[id] = ''; }, 4000);
            }
        }
    }).mount('#app');
    </script>
</body>
</html>
