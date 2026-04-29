<?php
// views/admin/dashboard.php
// $settings & $pageVisits provided by AdminController
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Konten Halaman - Tebing Lonceng Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: { base: '#FBF9F6', charcoal: '#1a1a1a', sage: '#6b7b62', clay: '#c5a27d' },
                fontFamily: { sans: ['Inter','sans-serif'], serif: ['Instrument Serif','serif'] }
            }}
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
    <style>
        body { font-family:'Inter',sans-serif; background:#FBF9F6; color:#1a1a1a; }
        [v-cloak] { display:none !important; }
        .glass-sidebar { background:rgba(251,249,246,.7); backdrop-filter:blur(24px) saturate(160%); -webkit-backdrop-filter:blur(24px) saturate(160%); border-right:1px solid rgba(0,0,0,.05); }
        .sidebar-item { display:flex; align-items:center; justify-content:space-between; padding:.75rem 1rem; border-radius:1rem; font-size:.875rem; font-weight:500; transition:all .3s; color:rgba(26,26,26,.7); }
        .sidebar-item:hover:not(.active) { background-color:rgba(0,0,0,.05); color:#1a1a1a; }
        .sidebar-item.active { background-color:rgba(107,123,98,.1); color:#6b7b62; font-weight:700; }
        .drawer-side .drawer-overlay { background-color:rgba(0,0,0,.2); backdrop-filter:blur(4px); }

        /* ── Bento Card System ── */
        .bento-card {
            background:#fff;
            border-radius:1.75rem;
            border:1px solid rgba(0,0,0,.07);
            box-shadow:0 4px 24px rgba(0,0,0,.04);
            overflow:hidden;
            transition:box-shadow .3s, transform .3s;
        }
        .bento-card:hover {
            box-shadow:0 12px 40px rgba(0,0,0,.08);
            transform:translateY(-2px);
        }

        /* Unified Card Header */
        .ch-header { background:#fff; border-bottom:1px solid rgba(0,0,0,.04); }

        .card-pill {
            display:inline-flex; align-items:center; gap:.35rem;
            font-size:.625rem; font-weight:800; letter-spacing:.07em; text-transform:uppercase;
            padding:.3rem .75rem; border-radius:999px;
        }
        .pill-sage  { background:rgba(107,123,98,.12); color:#6b7b62; }
        .pill-clay  { background:rgba(197,162,125,.15); color:#c5a27d; }
        .pill-cream { background:rgba(26,26,26,.06); color:rgba(26,26,26,.6); }

        .card-body { padding:1.5rem; }

        /* Naked input — transparent, styled by parent card */
        .bare-input {
            width:100%; background:transparent; border:none; outline:none;
            font-family:'Inter',sans-serif; color:#1a1a1a;
        }
        .bare-input::placeholder { color:rgba(26,26,26,.2); }
        .bare-input-dark {
            width:100%; background:transparent; border:none; outline:none;
            font-family:'Inter',sans-serif; color:#fff;
        }
        .bare-input-dark::placeholder { color:rgba(255,255,255,.25); }

        /* Inner field box */
        .inner-field {
            background:#FBF9F6; border:1px solid rgba(0,0,0,.06);
            border-radius:1rem; padding:.75rem 1rem;
            transition:border-color .2s;
        }
        .inner-field:focus-within { border-color:rgba(107,123,98,.4); }
        .inner-field input, .inner-field textarea {
            width:100%; background:transparent; border:none; outline:none;
            font-family:'Inter',sans-serif; color:#1a1a1a; resize:none;
        }
        .inner-field input::placeholder, .inner-field textarea::placeholder { color:rgba(26,26,26,.2); }

        .field-label { font-size:.625rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:rgba(26,26,26,.4); margin-bottom:.5rem; display:block; }
        .field-label-dark { font-size:.625rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:rgba(255,255,255,.4); margin-bottom:.5rem; display:block; }

        /* Upload zone */
        .upload-zone {
            position:relative; background:#FBF9F6; border:1.5px dashed rgba(0,0,0,.1);
            border-radius:1rem; padding:1rem;
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            text-align:center; transition:border-color .25s, background .25s; cursor:pointer;
        }
        .upload-zone:hover { border-color:#6b7b62; background:rgba(107,123,98,.05); }
        .upload-zone input[type=file] { position:absolute; inset:0; opacity:0; cursor:pointer; z-index:10; }

        /* Save button */
        .btn-save { display:inline-flex; align-items:center; gap:.5rem; background:#1a1a1a; color:#fff; font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; padding:.875rem 1.75rem; border-radius:1rem; border:none; cursor:pointer; transition:background .25s, transform .15s; }
        .btn-save:hover { background:#6b7b62; transform:translateY(-1px); }
        .btn-save:active { transform:translateY(0); }
        .btn-save:disabled { opacity:.6; cursor:not-allowed; transform:none; }

        /* Divider line inside card */
        .card-divider { border:none; border-top:1px solid rgba(0,0,0,.05); margin:1rem 0; }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../user/loader.php'; ?>

    <div class="drawer lg:drawer-open" id="app" v-cloak>
        <input id="admin-drawer" type="checkbox" class="drawer-toggle" />

        <!-- MAIN CONTENT -->
        <div class="drawer-content m-4 h-[calc(100vh-2rem)] overflow-y-auto bg-white rounded-xl shadow-[-10px_0_40px_rgba(0,0,0,0.04)] border-l border-black/5 relative z-10 custom-scrollbar">

            <!-- Sticky Navbar -->
            <div class="px-4 sm:px-6 lg:px-10 py-5 flex items-center justify-between sticky top-0 bg-white/80 backdrop-blur-xl z-20 border-b border-black/5 gs-item">
                <div class="flex items-center gap-3 sm:gap-4">
                    <label for="admin-drawer" class="btn btn-square btn-ghost btn-sm lg:hidden bg-charcoal/5 text-charcoal">
                        <i class="fi fi-rr-menu-burger"></i>
                    </label>
                    <span class="text-charcoal font-serif text-lg sm:text-xl tracking-tight">Konten Halaman</span>
                </div>
                <button @click="updateContent" :disabled="isLoading"
                    class="btn-save text-xs">
                    <div v-if="isLoading" class="loading loading-spinner loading-xs"></div>
                    <i v-else class="fi fi-rr-disk"></i>
                    {{ isLoading ? 'Menyimpan...' : 'Simpan' }}
                </button>
            </div>

            <!-- PAGE CONTENT -->
            <div class="px-4 sm:px-6 lg:px-10 pb-24 pt-8">
                <div class="max-w-5xl mx-auto">

                    <!-- Banner -->
                    <div class="relative w-full rounded-[1.5rem] sm:rounded-[2rem] overflow-hidden p-6 sm:p-8 lg:p-12 mb-8 gs-reveal flex flex-col justify-between min-h-[280px] sm:min-h-[320px] lg:min-h-[380px] border border-black/5 bg-[#FBF9F6]">
                        
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
                                    <i class="fi fi-rr-browser text-[10px]"></i>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-charcoal text-white flex items-center justify-center border-2 border-[#FBF9F6] shadow-sm z-10">
                                    <i class="fi fi-rr-edit text-[10px]"></i>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-charcoal/80 tracking-widest uppercase">Manajemen Konten</span>
                        </div>

                        <!-- Bottom: Typography -->
                        <div class="relative z-10 mt-12 sm:mt-16 max-w-2xl">
                            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-[5.5rem] font-serif text-charcoal leading-[1.05] tracking-tight mb-3">
                                Kelola <br/> <span class="italic pr-4">narasi sistem</span>
                            </h2>
                            <p class="text-charcoal/60 font-medium text-xs sm:text-sm lg:text-base">Atur teks utama, informasi, hingga detail halaman — semua dari satu tempat terpusat.</p>
                        </div>
                    </div>

                    <!-- Status alerts -->
                    <div v-if="successMessage" class="flex items-center gap-3 bg-sage/8 border border-sage/20 text-sage rounded-2xl px-5 py-4 mb-8 text-sm font-bold gs-item">
                        <i class="fi fi-rr-check-circle"></i> {{ successMessage }}
                    </div>
                    <div v-if="errorMessage" class="flex items-center gap-3 bg-red-50 border border-red-100 text-red-500 rounded-2xl px-5 py-4 mb-8 text-sm font-bold gs-item">
                        <i class="fi fi-rr-exclamation"></i> {{ errorMessage }}
                    </div>

                    <form @submit.prevent="updateContent" class="space-y-6">

                        <!-- ROW 1: Hero Title + Operasional (2-col asymmetric) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 gs-item">

                            <!-- CARD: Teks Beranda -->
                            <div class="bento-card">
                                <div class="ch-header px-6 py-4 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="card-pill pill-cream"><i class="fi fi-rr-browser"></i> Beranda</span>
                                        <span class="card-pill pill-sage"><i class="fi fi-rr-edit"></i> Teks</span>
                                    </div>
                                    <i class="fi fi-rr-heading text-charcoal/20 text-lg"></i>
                                </div>
                                <div class="card-body space-y-4">
                                    <div>
                                        <label class="field-label">Judul Hero</label>
                                        <div class="inner-field">
                                            <input v-model="form.hero_title" type="text" class="font-bold text-xl" placeholder="Melangkah Menuju, Keheningan." />
                                        </div>
                                        <p class="text-[10px] font-bold text-charcoal/30 mt-2 uppercase tracking-wide">Pisahkan dengan koma untuk efek italic</p>
                                    </div>
                                    <div>
                                        <label class="field-label">Sub-judul Hero</label>
                                        <div class="inner-field">
                                            <textarea v-model="form.hero_subtitle" rows="3" placeholder="Deskripsi singkat beranda..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD: Operasional -->
                            <div class="bento-card">
                                <div class="ch-header px-6 py-4 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="card-pill pill-sage"><i class="fi fi-rr-clock-three"></i> Operasional</span>
                                    </div>
                                    <i class="fi fi-rr-calendar text-charcoal/20 text-lg"></i>
                                </div>
                                <div class="card-body space-y-4">
                                    <div>
                                        <label class="field-label">Hari Operasional</label>
                                        <div class="inner-field">
                                            <input v-model="form.open_days" type="text" class="font-bold text-lg" placeholder="SENIN - MINGGU" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="field-label">Jam Operasional</label>
                                        <div class="inner-field">
                                            <input v-model="form.open_hours" type="text" class="font-bold text-lg" placeholder="07.00 - 23.00" />
                                        </div>
                                    </div>
                                    <div class="bg-[#FBF9F6] rounded-2xl p-4 border border-black/5">
                                        <p class="text-[10px] font-bold text-charcoal/40 uppercase tracking-widest mb-1">Preview</p>
                                        <p class="text-sm font-semibold text-charcoal">{{ form.open_days || 'SENIN - MINGGU' }}</p>
                                        <p class="text-xs text-charcoal/50 font-medium">{{ form.open_hours || '07.00 - 23.00' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ROW 2: Harga Tiket -->
                        <div class="bento-card gs-item">
                            <div class="ch-header px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="card-pill pill-clay"><i class="fi fi-rr-ticket"></i> Tiket</span>
                                    <span class="card-pill pill-cream">Manajemen Harga</span>
                                </div>
                                <i class="fi fi-rr-money-bill-wave text-charcoal/20 text-lg"></i>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                    <!-- Normal -->
                                    <div class="bg-[#FBF9F6] rounded-[1.25rem] p-4 sm:p-5 border border-black/5">
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-7 h-7 rounded-full bg-charcoal/5 flex items-center justify-center">
                                                <i class="fi fi-rr-ticket text-charcoal/50 text-xs"></i>
                                            </div>
                                            <label class="field-label mb-0">Tiket Normal</label>
                                        </div>
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-xs font-bold text-charcoal/40 uppercase tracking-wider">Rp</span>
                                            <input v-model="form.ticket_price" type="text" class="bare-input font-bold text-2xl" placeholder="15.000" />
                                        </div>
                                    </div>
                                    <!-- Pelajar -->
                                    <div class="bg-[#FBF9F6] rounded-[1.25rem] p-4 sm:p-5 border border-black/5">
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-7 h-7 rounded-full bg-charcoal/5 flex items-center justify-center">
                                                <i class="fi fi-rr-graduation-cap text-charcoal/50 text-xs"></i>
                                            </div>
                                            <label class="field-label mb-0">Pelajar / Mahasiswa</label>
                                        </div>
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-xs font-bold text-charcoal/40 uppercase tracking-wider">Rp</span>
                                            <input v-model="form.ticket_price_student" type="text" class="bare-input font-bold text-2xl" placeholder="10.000" />
                                        </div>
                                    </div>
                                    <!-- Anak -->
                                    <div class="bg-[#FBF9F6] rounded-[1.25rem] p-4 sm:p-5 border border-black/5">
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-7 h-7 rounded-full bg-charcoal/5 flex items-center justify-center">
                                                <i class="fi fi-rr-child-head text-charcoal/50 text-xs"></i>
                                            </div>
                                            <label class="field-label mb-0">Anak (&lt; 5 Tahun)</label>
                                        </div>
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-xs font-bold text-charcoal/40 uppercase tracking-wider">Rp</span>
                                            <input v-model="form.ticket_price_child" type="text" class="bare-input font-bold text-2xl" placeholder="Gratis" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ROW 3: Narasi Sejarah -->
                        <div class="bento-card gs-item">
                            <div class="ch-header px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="card-pill pill-sage"><i class="fi fi-rr-book-alt"></i> Narasi</span>
                                    <span class="card-pill pill-cream">Sejarah Beranda</span>
                                </div>
                                <i class="fi fi-rr-align-left text-charcoal/20 text-lg"></i>
                            </div>
                            <div class="card-body">
                                <label class="field-label">Teks Narasi Sejarah</label>
                                <textarea v-model="form.sejarah_text"
                                    class="w-full bg-[#FBF9F6] border border-black/5 rounded-2xl p-5 text-charcoal text-sm font-medium leading-relaxed outline-none focus:border-sage/30 transition-colors placeholder:text-charcoal/20 resize-none h-40"
                                    placeholder="Tulis narasi sejarah Tebing Lonceng di sini..."></textarea>
                                <p class="text-[10px] font-bold text-charcoal/30 mt-2 uppercase tracking-wide">Ditampilkan pada bagian About / Storytelling utama halaman beranda.</p>
                            </div>
                        </div>

                        <!-- ROW 4: Kartu Info & Gambar -->
                        <div class="bento-card gs-item">
                            <div class="ch-header px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="card-pill pill-sage"><i class="fi fi-rr-picture"></i> Kartu Info</span>
                                    <span class="card-pill pill-cream">Gambar Beranda</span>
                                </div>
                                <i class="fi fi-rr-layers text-charcoal/20 text-lg"></i>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Card 1: Sejarah -->
                                    <div class="bg-[#FBF9F6] rounded-2xl p-5 border border-black/5 space-y-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-charcoal/5 text-charcoal/50 flex items-center justify-center">
                                                <i class="fi fi-rr-book-alt text-xs"></i>
                                            </div>
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-charcoal/50">Card 1 — Sejarah</span>
                                        </div>
                                        <input v-model="form.acc1_title" type="text" class="bare-input font-bold text-base" placeholder="Judul (Batu Berdering)" />
                                        <textarea v-model="form.acc1_content" rows="2" class="bare-input text-sm text-charcoal/60 leading-relaxed resize-none" placeholder="Sub-teks (Samarinda, Kaltim)"></textarea>
                                        <hr class="card-divider" />
                                        <div class="upload-zone">
                                            <input type="file" @change="uploadImage($event, 1)" accept="image/*" />
                                            <i class="fi fi-rr-cloud-upload text-sage text-xl mb-1"></i>
                                            <span class="text-[10px] font-bold text-charcoal/50">Ganti Gambar Background</span>
                                        </div>
                                    </div>
                                    <!-- Card 2: Eksplorasi -->
                                    <div class="bg-[#FBF9F6] rounded-2xl p-5 border border-black/5 space-y-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-charcoal/5 text-charcoal/50 flex items-center justify-center">
                                                <i class="fi fi-rr-sparkles text-xs"></i>
                                            </div>
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-charcoal/50">Card 2 — Eksplorasi</span>
                                        </div>
                                        <input v-model="form.acc2_title" type="text" class="bare-input font-bold text-base" placeholder="Judul (Menyatu dengan Alam Bebas)" />
                                        <textarea v-model="form.acc2_content" rows="2" class="bare-input text-sm text-charcoal/60 leading-relaxed resize-none" placeholder="Sub-teks (View Point, Camping, dll)"></textarea>
                                        <hr class="card-divider" />
                                        <div class="upload-zone">
                                            <input type="file" @change="uploadImage($event, 2)" accept="image/*" />
                                            <i class="fi fi-rr-cloud-upload text-sage text-xl mb-1"></i>
                                            <span class="text-[10px] font-bold text-charcoal/50">Ganti Gambar Background</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ROW 5: Homestay -->
                        <div class="bento-card gs-item">
                            <div class="ch-header px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="card-pill pill-cream"><i class="fi fi-rr-home"></i> Homestay</span>
                                    <span class="card-pill pill-sage">Akomodasi Premium</span>
                                </div>
                                <i class="fi fi-rr-house-chimney text-charcoal/20 text-lg"></i>
                            </div>
                            <div class="card-body space-y-5">
                                <!-- Title + Image row -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="space-y-2">
                                        <label class="field-label">Judul Homestay</label>
                                        <div class="inner-field">
                                            <input v-model="form.hs_title" type="text" class="font-bold text-xl" placeholder="Kenyamanan di Balik Tebing Lonceng." />
                                        </div>
                                        <p class="text-[10px] font-medium text-charcoal/40">Tajuk utama bagian akomodasi premium pada halaman beranda.</p>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="field-label">Gambar Highlight</label>
                                        <div class="upload-zone" style="min-height:80px;">
                                            <input type="file" @change="uploadImage($event, 3)" accept="image/*" />
                                            <i class="fi fi-rr-cloud-upload text-sage text-xl mb-1"></i>
                                            <span class="text-[10px] font-bold text-charcoal/50">Klik untuk Ganti Foto Utama</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Stats row -->
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="bg-[#FBF9F6] rounded-2xl p-4 border border-black/5">
                                        <label class="field-label">Rating</label>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fi fi-sr-star text-charcoal/30 text-sm"></i>
                                            <input v-model="form.hs_stat_rating" type="text" class="bare-input font-bold text-2xl" placeholder="4.9" />
                                        </div>
                                    </div>
                                    <div class="bg-[#FBF9F6] rounded-2xl p-4 border border-black/5">
                                        <label class="field-label">Kabin</label>
                                        <div class="flex items-baseline gap-1">
                                            <input v-model="form.hs_stat_kabin" type="text" class="bare-input font-bold text-2xl w-12" placeholder="6" />
                                            <span class="text-xs font-bold text-charcoal/40 uppercase tracking-wider">Unit</span>
                                        </div>
                                    </div>
                                    <div class="bg-[#FBF9F6] rounded-2xl p-4 border border-black/5">
                                        <label class="field-label">Privasi</label>
                                        <div class="flex items-baseline gap-1">
                                            <input v-model="form.hs_stat_privasi" type="text" class="bare-input font-bold text-2xl w-16" placeholder="100" />
                                            <span class="text-xs font-bold text-charcoal/40 uppercase tracking-wider">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Save Action -->
                        <div class="flex justify-end gs-item pb-4">
                            <button type="submit" :disabled="isLoading" class="btn-save">
                                <div v-if="isLoading" class="loading loading-spinner loading-sm"></div>
                                <i v-else class="fi fi-rr-disk text-base"></i>
                                {{ isLoading ? 'Menyimpan...' : 'Simpan Perubahan' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!-- SIDEBAR -->
        <?php include __DIR__ . '/components/sidebar.php'; ?>
    </div>

    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    form: {
                        hero_title:    <?= json_encode($settings['hero_title']    ?? '') ?>,
                        hero_subtitle: <?= json_encode($settings['hero_subtitle'] ?? '') ?>,
                        sejarah_text:  <?= json_encode($settings['sejarah_text']  ?? '') ?>,
                        acc1_title:    <?= json_encode($settings['acc1_title']    ?? 'Sejarah Singkat') ?>,
                        acc1_content:  <?= json_encode($settings['acc1_content']  ?? '') ?>,
                        acc2_title:    <?= json_encode($settings['acc2_title']    ?? 'Pemberdayaan Warga') ?>,
                        acc2_content:  <?= json_encode($settings['acc2_content']  ?? '') ?>,
                        acc3_title:    <?= json_encode($settings['acc3_title']    ?? 'Pesona Ketinggian') ?>,
                        acc3_content:  <?= json_encode($settings['acc3_content']  ?? '') ?>,
                        open_days:     <?= json_encode($settings['open_days']     ?? 'SENIN - MINGGU') ?>,
                        open_hours:    <?= json_encode($settings['open_hours']    ?? '07.00 - 23.00') ?>,
                        ticket_price:  <?= json_encode($settings['ticket_price']  ?? '15.000') ?>,
                        ticket_price_student: <?= json_encode($settings['ticket_price_student'] ?? '10.000') ?>,
                        ticket_price_child: <?= json_encode($settings['ticket_price_child'] ?? 'Gratis') ?>,
                        ticket_quota:  <?= json_encode($settings['ticket_quota']  ?? '100') ?>,
                        
                        // Homestay Fields
                        hs_title: <?= json_encode($settings['hs_title'] ?? 'Kenyamanan di Balik Tebing Lonceng.') ?>,
                        hs_stat_rating: <?= json_encode($settings['hs_stat_rating'] ?? '4.9') ?>,
                        hs_stat_kabin: <?= json_encode($settings['hs_stat_kabin'] ?? '6') ?>,
                        hs_stat_privasi: <?= json_encode($settings['hs_stat_privasi'] ?? '100') ?>,
                        hs_wa_link: <?= json_encode($settings['hs_wa_link'] ?? 'https://wa.me/6281234567890?text=Halo%20Tebing%20Lonceng,%20saya%20ingin%20reservasi%20Homestay') ?>,
                        hs_acc1_title: <?= json_encode($settings['hs_acc1_title'] ?? 'Fasilitas Kamar & Interior') ?>,
                        hs_acc1_content: <?= json_encode($settings['hs_acc1_content'] ?? '<p>Kabin kayu minimalis yang modern dan bersih. Dilengkapi dengan kasur double bed, AC, area duduk santai dekat jendela, teko listrik (kettle), air mineral, kopi/teh, perlengkapan ibadah, dan nakas.</p>') ?>,
                        hs_acc2_title: <?= json_encode($settings['hs_acc2_title'] ?? 'Kamar Mandi') ?>,
                        hs_acc2_content: <?= json_encode($settings['hs_acc2_content'] ?? '<p>Fasilitas mandi yang bersih dengan lantai keramik putih, kloset duduk yang dilengkapi shower spray (bidet), serta bak mandi dan gayung.</p>') ?>,
                        hs_acc3_title: <?= json_encode($settings['hs_acc3_title'] ?? 'Aturan & Kebijakan') ?>,
                        hs_acc3_content: <?= json_encode($settings['hs_acc3_content'] ?? '<ul class=\"list-disc pl-4 space-y-1\"><li>Check-in 14.00 WITA, Check-out 12.00 WITA.</li><li>Pembayaran lunas 100% sebelum check-in.</li><li>Deposit Rp100.000 & KTP asli sebagai jaminan.</li><li>Dilarang membawa hewan, sajam, miras, narkoba, & makanan berbau tajam.</li></ul>') ?>,
                        hs_acc4_title: <?= json_encode($settings['hs_acc4_title'] ?? 'Eksterior & Lingkungan') ?>,
                        hs_acc4_content: <?= json_encode($settings['hs_acc4_content'] ?? '<p>Bangunan rumah panggung berbahan kayu dengan balkon kecil. Lokasi sangat privat dan sempurna untuk menikmati pemandangan city light Samarinda dari ketinggian.</p>') ?>,
                    },
                    isLoading: false,
                    successMessage: '',
                    errorMessage: ''
                }
            },
            mounted() {
                if (typeof gsap !== 'undefined') {
                    gsap.from('.gs-item', {
                        y: 28, opacity: 0, duration: 0.9,
                        stagger: 0.08, ease: 'power3.out', delay: 0.1
                    });
                }
            },
            methods: {
                async uploadImage(event, index) {
                    const file = event.target.files[0];
                    if (!file) return;
                    
                    this.isLoading = true;
                    this.successMessage = '';
                    this.errorMessage = '';
                    
                    try {
                        const fd = new FormData();
                        fd.append('gambar', file);
                        fd.append('image_index', index);
                        
                        const res = await fetch('actions/update_why_image.php', { method: 'POST', body: fd });
                        const data = await res.json();
                        
                        if (data.success) {
                            this.successMessage = `Gambar ${index} berhasil diperbarui!`;
                            setTimeout(() => this.successMessage = '', 4000);
                        } else {
                            this.errorMessage = data.message || 'Gagal mengupload gambar.';
                        }
                    } catch (err) {
                        this.errorMessage = 'Terjadi kesalahan jaringan saat mengupload gambar.';
                    } finally {
                        this.isLoading = false;
                        // Reset file input
                        event.target.value = '';
                    }
                },
                async updateContent() {
                    this.isLoading = true;
                    this.successMessage = '';
                    this.errorMessage = '';
                    try {
                        const fd = new FormData();
                        Object.keys(this.form).forEach(k => fd.append(k, this.form[k]));
                        const res = await fetch('actions/update.php', { method: 'POST', body: fd });
                        const data = await res.json();
                        if (data.success) {
                            this.successMessage = data.message || 'Perubahan berhasil disimpan!';
                            setTimeout(() => this.successMessage = '', 4000);
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        } else {
                            this.errorMessage = data.message || 'Gagal menyimpan perubahan.';
                        }
                    } catch {
                        this.errorMessage = 'Terjadi kesalahan jaringan.';
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }).mount('#app');
    </script>
</body>
</html>
