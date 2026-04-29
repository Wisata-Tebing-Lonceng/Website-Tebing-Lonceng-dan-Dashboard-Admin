<?php
// views/admin/reviews.php
// $reviews => array of reviews, $totalReviews => int
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tebing Lonceng Admin</title>

<<<<<<< HEAD
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/vendor/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="../assets/vendor/uicons-solid-rounded/css/uicons-solid-rounded.css">

    <!-- JS -->
    <script src="../assets/vendor/vue.global.prod.js"></script>
    <script src="../assets/vendor/gsap.min.js"></script>
<!-- Tailwind & DaisyUI -->
    <!-- Fonts -->
    <!-- GSAP & Vue.js -->
=======
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

>>>>>>> 49d32425052f5de5ae671c127b1b9c75e9fec3d9
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

        .tab-pill { padding: 0.5rem 1.25rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.2s; border: 1px solid rgba(0,0,0,0.06); }
        .tab-pill.active-all      { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }
        .tab-pill.active-pending  { background: #c5a27d; color: #fff; border-color: #c5a27d; }
        .tab-pill.active-approved { background: #6b7b62; color: #fff; border-color: #6b7b62; }
        .tab-pill.active-rejected { background: #ef4444; color: #fff; border-color: #ef4444; }
        .tab-pill:not([class*="active"]) { background: white; color: #1a1a1a; }
        .tab-pill:not([class*="active"]):hover { background: rgba(0,0,0,0.05); }
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
            <div class="px-4 sm:px-6 lg:px-10 py-5 sm:py-6 flex items-center justify-between gs-reveal sticky top-0 bg-white/80 backdrop-blur-xl z-20 border-b border-black/5">
                <div class="flex items-center gap-3 sm:gap-4">
                    <label for="admin-drawer" class="btn btn-square btn-ghost btn-sm lg:hidden bg-charcoal/5 text-charcoal">
                        <i class="fi fi-rr-menu-burger"></i>
                    </label>
                    <div class="flex items-center gap-2 text-charcoal font-serif text-lg sm:text-xl md:text-2xl tracking-tight">
                        Ulasan
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-6">
                    <button @click="openAddModal" class="btn bg-charcoal hover:bg-sage text-white border-none rounded-xl font-bold transition-all duration-300 h-9 px-4 text-xs flex items-center gap-2 shadow-sm">
                        <i class="fi fi-rr-plus"></i> <span class="hidden sm:inline">Tambah Manual</span>
                    </button>
                    <a href="settings.php" class="btn btn-sm bg-[#FBF9F6] border border-black/5 text-charcoal hover:bg-sage/10 hover:text-sage hover:border-sage/20 rounded-xl px-4 font-bold shadow-sm transition-colors">
                        <i class="fi fi-rr-edit"></i> <span class="hidden sm:inline">Edit Profil</span>
                    </a>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="px-4 sm:px-6 lg:px-10 pb-24 pt-8">
                <div class="max-w-7xl mx-auto">
                    
                    <!-- Banner -->
                    <div class="relative w-full rounded-[1.5rem] sm:rounded-[2rem] overflow-hidden p-6 sm:p-8 lg:p-12 mb-8 gs-sb-item flex flex-col justify-between min-h-[280px] sm:min-h-[320px] lg:min-h-[380px] border border-black/5 bg-[#FBF9F6]">
                        
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
                                    <i class="fi fi-rr-comment text-[10px]"></i>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-charcoal text-white flex items-center justify-center border-2 border-[#FBF9F6] shadow-sm z-10">
                                    <i class="fi fi-rr-star text-[10px]"></i>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-charcoal/80 tracking-widest uppercase">Ulasan & Jejak</span>
                        </div>

                        <!-- Bottom: Typography -->
                        <div class="relative z-10 mt-12 sm:mt-16 max-w-2xl">
                            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-[5.5rem] font-serif text-charcoal leading-[1.05] tracking-tight mb-3">
                                Suara <br/> <span class="italic pr-4">pengunjung</span>
                            </h2>
                            <p class="text-charcoal/60 font-medium text-xs sm:text-sm lg:text-base">Kelola dan tampilkan kesan mendalam dari mereka yang telah merasakan keindahan alam ini.</p>
                        </div>
                    </div>

                    <!-- Alerts -->
                    <div v-if="globalMsg" :class="globalMsgType === 'success' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-700 border-red-100'" class="alert rounded-3xl mb-8 p-4 flex items-center gap-3 animate-fade-in border font-bold text-sm">
                        <i class="fi" :class="globalMsgType === 'success' ? 'fi-rr-check-circle' : 'fi-rr-exclamation'"></i>
                        <span>{{ globalMsg }}</span>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 gs-sb-item">
                        <div class="bg-[#FBF9F6] rounded-2xl p-5 border border-black/5">
                            <p class="text-[10px] font-black uppercase tracking-widest text-charcoal/40 mb-1">Total</p>
                            <p class="text-3xl font-serif text-charcoal">{{ reviewsList.length }}</p>
                        </div>
                        <div class="bg-clay/5 rounded-2xl p-5 border border-clay/10">
                            <p class="text-[10px] font-black uppercase tracking-widest text-clay/60 mb-1">Menunggu</p>
                            <p class="text-3xl font-serif text-clay">{{ countByStatus('pending') }}</p>
                        </div>
                        <div class="bg-sage/5 rounded-2xl p-5 border border-sage/10">
                            <p class="text-[10px] font-black uppercase tracking-widest text-sage/60 mb-1">Disetujui</p>
                            <p class="text-3xl font-serif text-sage">{{ countByStatus('approved') }}</p>
                        </div>
                        <div class="bg-red-50 rounded-2xl p-5 border border-red-100">
                            <p class="text-[10px] font-black uppercase tracking-widest text-red-400 mb-1">Ditolak</p>
                            <p class="text-3xl font-serif text-red-500">{{ countByStatus('rejected') }}</p>
                        </div>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex flex-wrap gap-2 mb-6 gs-sb-item">
                        <button @click="filter='all'" :class="filter==='all' ? 'active-all' : ''" class="tab-pill">Semua <span class="opacity-60 ml-1">{{ reviewsList.length }}</span></button>
                        <button @click="filter='pending'" :class="filter==='pending' ? 'active-pending' : ''" class="tab-pill">Menunggu <span class="opacity-60 ml-1">{{ countByStatus('pending') }}</span></button>
                        <button @click="filter='approved'" :class="filter==='approved' ? 'active-approved' : ''" class="tab-pill">Disetujui <span class="opacity-60 ml-1">{{ countByStatus('approved') }}</span></button>
                        <button @click="filter='rejected'" :class="filter==='rejected' ? 'active-rejected' : ''" class="tab-pill">Ditolak <span class="opacity-60 ml-1">{{ countByStatus('rejected') }}</span></button>
                    </div>

                    <!-- Reviews Table -->
                    <div class="table-container gs-sb-item flex flex-col border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.04)] bg-white rounded-3xl overflow-hidden mb-8">
                        <div class="px-6 py-5 border-b border-black/5 flex items-center justify-between bg-white">
                            <h3 class="text-sm font-bold uppercase tracking-widest text-charcoal/60 flex items-center gap-2">
                                <i class="fi fi-rr-comment-alt"></i> Manajemen Ulasan
                            </h3>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-sage bg-sage/10 px-3 py-1.5 rounded-xl">{{ filteredReviews.length }} Ditampilkan</span>
                        </div>
                        
                        <div class="overflow-x-auto flex-1 bg-white">
                            <table class="w-full text-left whitespace-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama Pengunjung</th>
                                        <th>Cuplikan Ulasan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Empty State -->
                                    <tr v-if="filteredReviews.length === 0">
                                        <td colspan="5" class="py-20 text-center">
                                            <div class="w-20 h-20 bg-black/5 rounded-full flex items-center justify-center mx-auto mb-6 text-charcoal/20">
                                                <i class="fi fi-rr-comment-alt text-3xl"></i>
                                            </div>
                                            <p class="font-serif italic text-2xl text-charcoal/40">Tidak ada ulasan di kategori ini...</p>
                                        </td>
                                    </tr>
                                    
                                    <!-- Review Rows -->
                                    <tr v-for="review in filteredReviews" :key="review.id" class="hover:bg-black/5 transition-colors cursor-pointer group" @click="openDetails(review)">
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-full bg-[#FBF9F6] border border-black/5 flex items-center justify-center text-charcoal font-serif text-sm flex-shrink-0">
                                                    {{ (review.email ? review.email : review.nama).charAt(0).toUpperCase() }}
                                                </div>
                                                <div class="font-medium text-charcoal">{{ review.email ? review.email : review.nama }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-charcoal/60 font-medium text-xs truncate max-w-[150px] md:max-w-[200px] lg:max-w-[300px]">
                                                "{{ review.kesan }}"
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-charcoal/60 font-medium text-xs">{{ formatDate(review.created_at) }}</div>
                                        </td>
                                        <td>
                                            <span v-if="review.status === 'approved'" class="bg-sage/10 border border-sage/20 text-sage px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Disetujui</span>
                                            <span v-else-if="review.status === 'rejected'" class="bg-red-50 border border-red-200 text-red-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Ditolak</span>
                                            <span v-else class="bg-clay/10 border border-clay/20 text-clay px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Menunggu</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button @click.stop="confirmDelete(review.id)" class="w-8 h-8 rounded-xl border border-black/5 text-charcoal/40 hover:text-red-500 hover:border-red-200 hover:bg-red-50 flex items-center justify-center transition-colors">
                                                    <i class="fi fi-rr-trash"></i>
                                                </button>
                                                <button @click.stop="openEditModal(review)" class="w-8 h-8 rounded-xl border border-black/5 text-charcoal/40 hover:text-sage hover:border-sage/30 hover:bg-sage/10 flex items-center justify-center transition-colors">
                                                    <i class="fi fi-rr-pencil"></i>
                                                </button>
                                                <button @click.stop="openDetails(review)" class="bg-charcoal hover:bg-sage text-white text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl flex items-center gap-1.5 transition-colors shadow-sm">
                                                    <i class="fi fi-rr-check text-[10px]"></i> Cek 
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div> <!-- /Page Content -->

            <!-- Global FAB Navigation -->
            <div class="fixed bottom-10 right-10 z-50 flex flex-col items-end gap-3 pointer-events-none group/fab">
                <div class="flex flex-col items-end gap-3 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] origin-bottom opacity-0 translate-y-10 scale-90 pointer-events-none group-hover/fab:opacity-100 group-hover/fab:translate-y-0 group-hover/fab:scale-100 group-hover/fab:pointer-events-auto">
                    <a href="dashboard.php" class="flex items-center gap-3 group">
                        <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Info Dasar</span>
                        <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                            <i class="fi fi-rr-info text-lg"></i>
                        </div>
                    </a>
                    <a href="fasilitas.php" class="flex items-center gap-3 group" style="transition-delay: 50ms;">
                        <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Fasilitas</span>
                        <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                            <i class="fi fi-rr-apps text-lg"></i>
                        </div>
                    </a>
                    <a href="galleries.php" class="flex items-center gap-3 group" style="transition-delay: 100ms;">
                        <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Galeri Foto</span>
                        <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                            <i class="fi fi-rr-picture text-lg"></i>
                        </div>
                    </a>
                    <a href="reviews.php" class="flex items-center gap-3 group" style="transition-delay: 150ms;">
                        <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Ulasan</span>
                        <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                            <i class="fi fi-rr-comment-alt text-lg"></i>
                        </div>
                    </a>
                </div>
                <button class="w-16 h-16 rounded-full shadow-[0_8px_30px_rgba(0,0,0,0.12)] border-4 border-white overflow-hidden relative pointer-events-auto transition-transform duration-300 hover:scale-105 active:scale-95 z-10 flex items-center justify-center bg-charcoal group-hover/fab:rotate-90">
                    <div class="absolute inset-0 flex items-center justify-center text-white transition-all duration-500 scale-100 opacity-100 group-hover/fab:opacity-0 group-hover/fab:scale-50">
                        <i class="fi fi-rr-wrench-simple text-xl"></i>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center text-white transition-all duration-500 -rotate-90 opacity-0 scale-50 group-hover/fab:opacity-100 group-hover/fab:rotate-0 group-hover/fab:scale-100">
                        <i class="fi fi-rr-cross text-lg"></i>
                    </div>
                </button>
            </div>
        </div> <!-- /Drawer Content -->
        
        <!-- SIDEBAR -->
        <?php include __DIR__ . '/components/sidebar.php'; ?>

        <!-- MODALS -->
        <!-- Review Details Modal -->
        <dialog class="modal" :class="{'modal-open': selectedReview}">
            <div class="modal-box bg-[#fbf9f6] rounded-[2.5rem] p-0 border border-black/5 shadow-2xl max-w-2xl overflow-hidden" v-if="selectedReview">
                <div class="p-8 lg:p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-sage/10 text-sage flex items-center justify-center font-bold text-2xl font-serif border border-sage/10 shrink-0">
                                {{ (selectedReview.email ? selectedReview.email : selectedReview.nama).charAt(0).toUpperCase() }}
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl text-charcoal leading-tight mb-1">{{ selectedReview.email ? selectedReview.email : selectedReview.nama }}</h3>
                                <p class="text-sm text-charcoal/40 font-medium">{{ formatDate(selectedReview.created_at) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 self-end sm:self-auto">
                            <span v-if="selectedReview.status === 'approved'" class="badge bg-sage/10 text-sage border-none font-bold px-4 py-3 rounded-xl uppercase tracking-wider text-xs">Disetujui</span>
                            <span v-else-if="selectedReview.status === 'rejected'" class="badge bg-red-50 text-red-500 border-none font-bold px-4 py-3 rounded-xl uppercase tracking-wider text-xs">Ditolak</span>
                            <span v-else class="badge bg-clay/10 text-clay border-none font-bold px-4 py-3 rounded-xl uppercase tracking-wider text-xs">Menunggu</span>
                            
                            <button @click="closeDetails" class="btn btn-ghost btn-circle btn-sm text-charcoal/40 hover:bg-black/5 ml-2">
                                <i class="fi fi-rr-cross"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-black/5 relative shadow-sm">
                        <i class="fi fi-rr-quote-right absolute top-6 right-6 text-sage/5 text-6xl pointer-events-none"></i>
                        <h4 class="text-[10px] font-bold text-charcoal/30 uppercase tracking-widest mb-4">Isi Ulasan</h4>
                        <p class="text-charcoal/80 text-lg leading-relaxed font-medium relative z-10 whitespace-pre-wrap">"{{ selectedReview.kesan }}"</p>
                    </div>
                    
                    <div class="mt-8 flex flex-wrap gap-3 justify-end border-t border-black/5 pt-8">
                        <button @click="confirmDelete(selectedReview.id); closeDetails()" class="btn bg-red-50 hover:bg-red-100 text-red-500 border-none rounded-xl px-6 font-bold flex-1 sm:flex-none">
                            <i class="fi fi-rr-trash"></i> <span class="hidden sm:inline">Hapus</span>
                        </button>
                        <button @click="openEditModal(selectedReview); closeDetails()" class="btn bg-black/5 hover:bg-black/10 text-charcoal border-none rounded-xl px-6 font-bold flex-1 sm:flex-none">
                            <i class="fi fi-rr-pencil"></i> <span class="hidden sm:inline">Edit</span>
                        </button>

                        <div class="w-full sm:w-px sm:h-8 bg-black/10 mx-0 sm:mx-2 my-2 sm:my-auto"></div>

                        <button v-if="selectedReview.status !== 'approved'" @click="confirmAction('approve', selectedReview.id); closeDetails()" class="btn bg-sage hover:bg-sage/90 text-white border-none rounded-xl px-6 font-bold flex-1 sm:flex-none">
                            <i class="fi fi-rr-check-circle"></i> Setujui
                        </button>
                        <button v-if="selectedReview.status !== 'rejected'" @click="confirmAction('reject', selectedReview.id); closeDetails()" class="btn bg-[#c5a27d] hover:bg-[#b0906f] text-white border-none rounded-xl px-6 font-bold flex-1 sm:flex-none">
                            <i class="fi fi-rr-cross-circle"></i> Tolak
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop bg-charcoal/20 backdrop-blur-sm" @click="closeDetails"></div>
        </dialog>

        <!-- Form Modal -->
        <dialog class="modal" :class="{'modal-open': isModalOpen}">
            <div class="modal-box bg-[#fbf9f6] rounded-[2.5rem] p-10 border border-black/5 shadow-2xl max-w-lg">
                <h3 class="text-4xl font-serif text-charcoal mb-2">{{ modalMode === 'add' ? 'Tambah Ulasan' : 'Edit Narasi' }}</h3>
                <p class="text-xs font-bold uppercase tracking-widest text-charcoal/30 mb-10">Jejak Digital Pengunjung</p>
                
                <form @submit.prevent="submitForm" class="space-y-6">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Nama Lengkap / Email</span></label>
                        <input type="text" v-model="formData.nama" class="input input-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal h-14" required placeholder="Budi Santoso">
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold text-[10px] uppercase tracking-widest text-charcoal/40">Isi Ulasan</span></label>
                        <textarea v-model="formData.kesan" class="textarea textarea-bordered w-full rounded-2xl bg-[#FBF9F6] border-black/5 focus:border-sage focus:ring-1 focus:ring-sage/20 transition-all text-charcoal h-40 pt-4" required placeholder="Ceritakan pengalaman mereka..."></textarea>
                    </div>
                    
                    <div class="flex gap-4 pt-6">
                        <button type="button" class="btn bg-black/5 hover:bg-black/10 text-charcoal border-none rounded-full flex-1 h-14 font-bold" @click="closeModal">Batal</button>
                        <button type="submit" :disabled="isSubmitting" class="btn bg-charcoal hover:bg-sage text-white border-none rounded-full px-8 font-bold transition-all duration-300 flex-1 h-14">
                            <span v-if="isSubmitting" class="loading loading-spinner loading-xs"></span>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-backdrop bg-charcoal/20 backdrop-blur-sm" @click="closeModal"></div>
        </dialog>

        <!-- Confirmation Modal -->
        <dialog class="modal" :class="{'modal-open': actionId !== null}">
            <div class="modal-box bg-[#fbf9f6] rounded-[2.5rem] p-10 text-center border border-black/5">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6" 
                     :class="{
                         'bg-red-50 text-red-500': actionType === 'delete' || actionType === 'reject', 
                         'bg-sage/10 text-sage': actionType === 'approve'
                     }">
                    <i class="fi text-3xl" :class="{
                        'fi-rr-trash': actionType === 'delete', 
                        'fi-rr-cross-circle': actionType === 'reject', 
                        'fi-rr-check-circle': actionType === 'approve'
                    }"></i>
                </div>
                <h3 class="text-3xl font-serif text-charcoal mb-4">
                    {{ actionType === 'delete' ? 'Hapus Ulasan Ini?' : (actionType === 'approve' ? 'Setujui Ulasan Ini?' : 'Tolak Ulasan Ini?') }}
                </h3>
                <p class="text-sm text-charcoal/50 mb-10 font-medium">
                    {{ actionType === 'delete' ? 'Data yang dihapus tidak dapat dikembalikan. Konfirmasi tindakan Anda.' : 'Apakah Anda yakin ingin ' + (actionType === 'approve' ? 'menyetujui' : 'menolak') + ' ulasan ini?' }}
                </p>
                <div class="flex gap-4">
                    <button type="button" class="btn bg-black/5 border-none rounded-full flex-1 h-14 font-bold" @click="actionId = null">Batal</button>
                    <button type="button" class="btn text-white border-none rounded-full flex-1 h-14 font-bold" 
                            :class="actionType === 'approve' ? 'bg-sage hover:bg-sage/80' : 'bg-red-500 hover:bg-red-600'"
                            @click="proceedAction" :disabled="isSubmitting">
                        <span v-if="isSubmitting" class="loading loading-spinner loading-xs"></span>
                        Ya, {{ actionType === 'delete' ? 'Hapus' : (actionType === 'approve' ? 'Setujui' : 'Tolak') }}
                    </button>
                </div>
            </div>
            <div class="modal-backdrop bg-charcoal/20 backdrop-blur-sm" @click="actionId = null"></div>
        </dialog>

    </div>

    <script>
    const { createApp } = Vue;
    createApp({
        data() {
            return {
                reviewsList: <?= json_encode($reviews ?? [], JSON_UNESCAPED_UNICODE) ?>,
                filter: 'all',
                globalMsg: '',
                globalMsgType: 'success',
                isModalOpen: false,
                modalMode: 'add',
                isSubmitting: false,
                formData: { id: null, nama: '', kesan: '' },
                actionId: null,
                actionType: '', // 'approve', 'reject', 'delete'
                selectedReview: null
            }
        },
        computed: {
            filteredReviews() {
                if (this.filter === 'all') return this.reviewsList;
                return this.reviewsList.filter(r => r.status === this.filter);
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
            countByStatus(s) { return this.reviewsList.filter(r => r.status === s).length; },
            openDetails(review) {
                this.selectedReview = review;
            },
            closeDetails() {
                this.selectedReview = null;
            },
            formatDate(dateStr) {
                if (!dateStr) return '';
                const d = new Date(dateStr);
                return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            },
            openAddModal() {
                this.modalMode = 'add';
                this.formData = { id: null, nama: '', kesan: '' };
                this.isModalOpen = true;
            },
            openEditModal(review) {
                this.modalMode = 'edit';
                this.formData = { id: review.id, nama: review.nama, kesan: review.kesan };
                this.isModalOpen = true;
            },
            closeModal() {
                this.isModalOpen = false;
            },
            async submitForm() {
                this.isSubmitting = true;
                const params = new URLSearchParams();
                params.append('action', this.modalMode);
                params.append('nama', this.formData.nama);
                params.append('kesan', this.formData.kesan);
                if (this.modalMode === 'edit') params.append('id', this.formData.id);

                try {
                    const res = await fetch('actions/reviews.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: params
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.globalMsg = data.message;
                        this.globalMsgType = 'success';
                        if (this.modalMode === 'add') {
                            this.reviewsList.unshift(data.review);
                        } else {
                            const idx = this.reviewsList.findIndex(r => r.id == this.formData.id);
                            if (idx !== -1) {
                                this.reviewsList[idx].nama = this.formData.nama;
                                this.reviewsList[idx].kesan = this.formData.kesan;
                            }
                        }
                        this.closeModal();
                    } else {
                        this.globalMsg = data.message;
                        this.globalMsgType = 'error';
                    }
                } catch (err) {
                    this.globalMsg = 'Error Jaringan';
                    this.globalMsgType = 'error';
                } finally {
                    this.isSubmitting = false;
                    setTimeout(() => this.globalMsg = '', 4000);
                }
            },
            confirmDelete(id) { 
                this.actionType = 'delete';
                this.actionId = id; 
            },
            confirmAction(type, id) {
                this.actionType = type;
                this.actionId = id;
            },
            async proceedAction() {
                this.isSubmitting = true;
                const params = new URLSearchParams();
                params.append('action', this.actionType);
                params.append('id', this.actionId);

                try {
                    const res = await fetch('actions/reviews.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: params
                    });
                    const data = await res.json();
                    if (data.success) {
                        if (this.actionType === 'delete') {
                            this.globalMsg = 'Ulasan berhasil dihapus';
                            this.reviewsList = this.reviewsList.filter(r => r.id != this.actionId);
                        } else {
                            this.globalMsg = data.message;
                            const idx = this.reviewsList.findIndex(r => r.id == this.actionId);
                            if (idx !== -1) {
                                this.reviewsList[idx].status = this.actionType === 'approve' ? 'approved' : 'rejected';
                            }
                        }
                        this.globalMsgType = 'success';
                        setTimeout(() => this.globalMsg = '', 4000);
                    } else {
                        this.globalMsg = data.message;
                        this.globalMsgType = 'error';
                    }
                } catch (err) {
                    this.globalMsg = 'Error Jaringan';
                    this.globalMsgType = 'error';
                } finally {
                    this.isSubmitting = false;
                    this.actionId = null;
                }
            }
        }
    }).mount('#app');
    </script>
</body>
</html>
