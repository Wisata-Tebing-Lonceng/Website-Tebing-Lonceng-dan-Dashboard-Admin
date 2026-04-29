<?php
// views/admin/overview.php
// Variables: $pageVisits, $totalReviews, $reviews — provided by AdminController::overview()
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Ringkasan Sistem - Tebing Lonceng Admin</title>

    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/vendor/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="../assets/vendor/uicons-solid-rounded/css/uicons-solid-rounded.css">

    <!-- JS -->
    <script src="../assets/vendor/vue.global.prod.js"></script>
    <script src="../assets/vendor/gsap.min.js"></script>
    <script src="../assets/vendor/chart.umd.min.js"></script>
<!-- Tailwind & DaisyUI -->
    <!-- Fonts -->
    <!-- GSAP, Vue.js & Chart.js -->
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s;
            color: rgba(26,26,26,0.7);
        }
        .sidebar-item:hover:not(.active) {
            background-color: rgba(0,0,0,0.05);
            color: #1a1a1a;
        }
        .sidebar-item.active {
            background-color: rgba(107,123,98,0.1);
            color: #6b7b62;
            font-weight: 700;
        }
        
        .sidebar-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.625rem;
            font-weight: 800;
            color: rgba(26,26,26,0.4);
            margin-bottom: 0.25rem;
            margin-top: 1.5rem;
            padding: 0 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .table-container {
            background-color: white;
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.03);
        }
        .table-container th {
            background-color: transparent;
            color: rgba(26,26,26,0.5);
            font-weight: 600;
            font-size: 0.6875rem;
            padding: 1rem 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .table-container td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.02);
            font-size: 0.875rem;
        }

        .drawer-side .drawer-overlay {
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(4px);
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
            <div class="px-4 sm:px-6 lg:px-10 py-5 sm:py-6 flex items-center justify-between gs-reveal sticky top-0 bg-white/80 backdrop-blur-xl z-20 border-b border-black/5">
                <div class="flex items-center gap-3 sm:gap-4">
                    <label for="admin-drawer" class="btn btn-square btn-ghost btn-sm lg:hidden bg-charcoal/5 text-charcoal">
                        <i class="fi fi-rr-menu-burger"></i>
                    </label>
                    <div class="flex items-center gap-2 text-charcoal font-serif text-2xl tracking-tight">
                        Ringkasan Sistem
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-6">
                    <a href="settings.php" class="btn btn-sm bg-[#FBF9F6] border border-black/5 text-charcoal hover:bg-sage/10 hover:text-sage hover:border-sage/20 rounded-xl px-4 font-bold shadow-sm transition-colors">
                        <i class="fi fi-rr-edit"></i> <span class="hidden sm:inline">Edit Profil</span>
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <div class="px-4 sm:px-6 lg:px-10 pb-10 pt-6 sm:pt-8">
                <div class="max-w-6xl mx-auto">
                    
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
                                    <i class="fi fi-rr-chart-pie-alt text-[10px]"></i>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-charcoal text-white flex items-center justify-center border-2 border-[#FBF9F6] shadow-sm z-10">
                                    <i class="fi fi-rr-stats text-[10px]"></i>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-charcoal/80 tracking-widest uppercase">Analisis · Data Langsung</span>
                        </div>

                        <!-- Bottom: Typography -->
                        <div class="relative z-10 mt-12 sm:mt-16 max-w-2xl">
                            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-[5.5rem] font-serif text-charcoal leading-[1.05] tracking-tight mb-3">
                                Eksplorasi<br/> <span class="italic pr-4">performa sistem</span>
                            </h2>
                            <p class="text-charcoal/60 font-medium text-xs sm:text-sm lg:text-base">Selami metrik kunjungan, persetujuan, dan ulasan secara komprehensif.</p>
                        </div>
                    </div>

                    <!-- 4 Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-10 gs-reveal">
                        <div class="bg-white rounded-[1.25rem] sm:rounded-[1.5rem] p-5 sm:p-6 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <div class="text-[10px] uppercase tracking-widest text-charcoal/50 font-bold">Total Kunjungan</div>
                                <div class="w-10 h-10 rounded-xl bg-[#FBF9F6] text-charcoal/40 flex items-center justify-center text-lg border border-black/5">
                                    <i class="fi fi-rr-eye"></i>
                                </div>
                            </div>
                            <div class="text-4xl font-serif text-charcoal">{{ pageVisits }}</div>
                        </div>

                        <div class="bg-white rounded-[1.25rem] sm:rounded-[1.5rem] p-5 sm:p-6 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <div class="text-[10px] uppercase tracking-widest text-charcoal/50 font-bold">Ulasan Masuk</div>
                                <div class="w-10 h-10 rounded-xl bg-sage/10 text-sage flex items-center justify-center text-lg border border-sage/10">
                                    <i class="fi fi-rr-comment-alt"></i>
                                </div>
                            </div>
                            <div class="text-4xl font-serif text-charcoal">{{ totalReviews }}</div>
                        </div>

                        <div class="bg-white rounded-[1.25rem] sm:rounded-[1.5rem] p-5 sm:p-6 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <div class="text-[10px] uppercase tracking-widest text-charcoal/50 font-bold">Galeri Aktif</div>
                                <div class="w-10 h-10 rounded-xl bg-clay/10 text-clay flex items-center justify-center text-lg border border-clay/10">
                                    <i class="fi fi-rr-picture"></i>
                                </div>
                            </div>
                            <div class="text-4xl font-serif text-charcoal">{{ totalGalleries }}</div>
                        </div>

                        <div class="bg-white rounded-[1.25rem] sm:rounded-[1.5rem] p-5 sm:p-6 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <div class="text-[10px] uppercase tracking-widest text-charcoal/50 font-bold">Status Server</div>
                                <div class="w-10 h-10 rounded-xl bg-[#FBF9F6] text-charcoal flex items-center justify-center text-lg border border-black/5">
                                    <i class="fi fi-rr-server"></i>
                                </div>
                            </div>
                            <div class="text-3xl font-serif text-charcoal flex items-center gap-3">
                                Online <div class="w-2.5 h-2.5 bg-sage rounded-full animate-pulse shadow-[0_0_10px_rgba(107,123,98,0.5)]"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-10 gs-reveal">
                        <!-- Website Visitors Chart -->
                        <div class="bg-white rounded-[1.5rem] p-6 lg:p-8 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] flex flex-col">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                <div>
                                    <h3 class="text-lg font-serif text-charcoal flex items-center gap-2">
                                        <i class="fi fi-rr-stats text-sage"></i> Statistik Website
                                    </h3>
                                    <p class="text-xs text-charcoal/50 font-medium mt-1">Pantau lalu lintas website Anda</p>
                                </div>
                                <div class="flex items-center bg-[#FBF9F6] rounded-xl p-1 border border-black/5">
                                    <button @click="setChartFilter('daily')" 
                                            :class="chartFilter === 'daily' ? 'bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] text-charcoal font-bold' : 'text-charcoal/50 hover:text-charcoal font-medium'"
                                            class="px-5 py-2 rounded-lg text-xs transition-all">
                                        Harian
                                    </button>
                                    <button @click="setChartFilter('monthly')" 
                                            :class="chartFilter === 'monthly' ? 'bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] text-charcoal font-bold' : 'text-charcoal/50 hover:text-charcoal font-medium'"
                                            class="px-5 py-2 rounded-lg text-xs transition-all">
                                        Bulanan
                                    </button>
                                </div>
                            </div>
                            <div class="relative flex-1 min-h-[250px] w-full">
                                <canvas id="visitChart"></canvas>
                            </div>
                        </div>

                        <!-- Physical Tourist Chart -->
                        <div class="bg-white rounded-[1.5rem] p-6 lg:p-8 border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.03)] flex flex-col">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                <div>
                                    <h3 class="text-lg font-serif text-charcoal flex items-center gap-2">
                                        <i class="fi fi-rr-users-alt text-clay"></i> Pengunjung Wisata
                                    </h3>
                                    <p class="text-xs text-charcoal/50 font-medium mt-1">Total kedatangan wisatawan fisik</p>
                                </div>
                                <div class="flex items-center bg-[#FBF9F6] rounded-xl p-1 border border-black/5">
                                    <button @click="setTouristFilter('daily')" 
                                            :class="touristFilter === 'daily' ? 'bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] text-charcoal font-bold' : 'text-charcoal/50 hover:text-charcoal font-medium'"
                                            class="px-5 py-2 rounded-lg text-xs transition-all">
                                        Harian
                                    </button>
                                    <button @click="setTouristFilter('monthly')" 
                                            :class="touristFilter === 'monthly' ? 'bg-white shadow-[0_2px_10px_rgba(0,0,0,0.04)] text-charcoal font-bold' : 'text-charcoal/50 hover:text-charcoal font-medium'"
                                            class="px-5 py-2 rounded-lg text-xs transition-all">
                                        Bulanan
                                    </button>
                                </div>
                            </div>
                            <div class="relative flex-1 min-h-[250px] w-full">
                                <canvas id="touristChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Feed Section -->
                    <div class="grid w-full gap-6 mb-8">
                        <!-- Aktivitas Terbaru -->
                        <div class="table-container gs-reveal flex flex-col border border-black/5 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                            <div class="px-4 sm:px-6 py-5 border-b border-black/5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white">
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                    <h3 class="text-sm font-bold uppercase tracking-widest text-charcoal/60 flex items-center gap-2">
                                        <i class="fi fi-rr-time-past"></i> Aktivitas Terbaru
                                    </h3>
                                    <!-- Live badge -->
                                    <span class="flex items-center gap-1.5 bg-sage/10 text-sage text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full border border-sage/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></span> Live
                                    </span>
                                    <!-- Pending badge -->
                                    <span v-if="pendingReviews + pendingGalleries > 0" class="bg-clay/10 text-clay text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full border border-clay/20">
                                        {{ pendingReviews + pendingGalleries }} Menunggu
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                    <span class="text-[10px] text-charcoal/30 font-medium hidden sm:block">Diperbarui {{ lastUpdated }}</span>
                                    <a href="reviews.php" class="text-[10px] font-bold uppercase tracking-widest text-charcoal/40 hover:text-sage transition-colors">Ulasan</a>
                                    <span class="text-charcoal/20">·</span>
                                    <a href="galleries.php" class="text-[10px] font-bold uppercase tracking-widest text-charcoal/40 hover:text-sage transition-colors">Galeri</a>
                                </div>
                            </div>
                            <div class="overflow-x-auto flex-1 bg-white">
                                <table class="w-full text-left whitespace-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Pengirim</th>
                                            <th>Jenis</th>
                                            <th class="hidden md:table-cell">Cuplikan</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loading skeleton -->
                                        <tr v-if="isLoading && activities.length === 0">
                                            <td colspan="6" class="text-center py-12">
                                                <div class="flex items-center justify-center gap-3 text-charcoal/30">
                                                    <span class="loading loading-spinner loading-sm"></span>
                                                    <span class="text-sm font-medium">Memuat aktivitas...</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Empty state -->
                                        <tr v-else-if="!isLoading && activities.length === 0">
                                            <td colspan="6" class="text-center py-12 text-charcoal/30 text-sm font-medium italic">Belum ada aktivitas terbaru.</td>
                                        </tr>
                                        <!-- Activity rows -->
                                        <tr v-for="(item, index) in activities" :key="item.type + '-' + item.id" 
                                            class="hover:bg-black/[0.02] transition-colors"
                                            :class="item.status === 'pending' ? 'bg-clay/[0.03]' : ''">
                                            <!-- Sender -->
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 font-serif"
                                                         :class="item.type === 'review' ? 'bg-sage/10 text-sage border border-sage/10' : 'bg-clay/10 text-clay border border-clay/10'">
                                                        {{ (item.email || item.nama || '?').charAt(0).toUpperCase() }}
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-charcoal text-sm leading-tight">{{ item.nama || 'Anonim' }}</p>
                                                        <p class="text-[10px] text-charcoal/40 truncate max-w-[100px]">{{ item.email || '' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Type badge -->
                                            <td>
                                                <span v-if="item.type === 'review'" class="inline-flex items-center gap-1 bg-sage/8 text-sage text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full">
                                                    <i class="fi fi-rr-comment-alt text-[9px]"></i> Ulasan
                                                </span>
                                                <span v-else class="inline-flex items-center gap-1 bg-clay/8 text-clay text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full">
                                                    <i class="fi fi-rr-picture text-[9px]"></i> Galeri
                                                </span>
                                            </td>
                                            <!-- Snippet -->
                                            <td class="hidden md:table-cell">
                                                <span class="text-charcoal/50 text-xs italic line-clamp-1 max-w-[180px] block">{{ item.content ? '"' + item.content + '"' : '—' }}</span>
                                            </td>
                                            <!-- Date -->
                                            <td>
                                                <span class="text-charcoal/50 text-xs font-medium">{{ formatDate(item.created_at) }}</span>
                                            </td>
                                            <!-- Status -->
                                            <td>
                                                <span v-if="item.status === 'approved'" class="inline-flex items-center gap-1 bg-sage/10 text-sage text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full">
                                                    <i class="fi fi-rr-check text-[9px]"></i> Disetujui
                                                </span>
                                                <span v-else-if="item.status === 'rejected'" class="inline-flex items-center gap-1 bg-red-50 text-red-400 text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full">
                                                    <i class="fi fi-rr-cross text-[9px]"></i> Ditolak
                                                </span>
                                                <span v-else class="inline-flex items-center gap-1 bg-clay/10 text-clay text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full animate-pulse">
                                                    <i class="fi fi-rr-time-half-past text-[9px]"></i> Menunggu
                                                </span>
                                            </td>
                                            <!-- Action -->
                                            <td class="text-right">
                                                <a :href="item.type === 'review' ? 'reviews.php' : 'galleries.php'"
                                                   class="inline-flex items-center gap-1.5 bg-charcoal hover:bg-sage text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-xl transition-colors shadow-sm">
                                                    <i class="fi fi-rr-arrow-right text-[9px]"></i> Tinjau
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Premium Floating Action Button (FAB) Menu -->
                        <div class="fixed bottom-10 right-10 z-50 flex flex-col items-end gap-3 pointer-events-none">
                            
                            <!-- Menu Items -->
                            <div class="flex flex-col items-end gap-3 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] origin-bottom"
                                 :class="isFabOpen ? 'opacity-100 translate-y-0 scale-100 pointer-events-auto' : 'opacity-0 translate-y-10 scale-90 pointer-events-none'">
                                
                                <a href="dashboard.php" class="flex items-center gap-3 group">
                                    <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Info Dasar</span>
                                    <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                                        <i class="fi fi-rr-info text-lg"></i>
                                    </div>
                                </a>

                                <a href="fasilitas.php" class="flex items-center gap-3 group" style="transition-delay: 50ms">
                                    <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Fasilitas</span>
                                    <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                                        <i class="fi fi-rr-apps text-lg"></i>
                                    </div>
                                </a>

                                <a href="galleries.php" class="flex items-center gap-3 group" style="transition-delay: 100ms">
                                    <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Galeri Foto</span>
                                    <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                                        <i class="fi fi-rr-picture text-lg"></i>
                                    </div>
                                </a>

                                <a href="reviews.php" class="flex items-center gap-3 group" style="transition-delay: 150ms">
                                    <span class="bg-white/90 backdrop-blur-md text-charcoal text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-xl shadow-sm border border-black/5 opacity-0 translate-x-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">Ulasan</span>
                                    <div class="w-12 h-12 rounded-full bg-white border border-black/5 text-charcoal flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:bg-sage hover:text-white transition-colors duration-300">
                                        <i class="fi fi-rr-comment-alt text-lg"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Main Trigger -->
                            <button @click="isFabOpen = !isFabOpen" class="w-16 h-16 rounded-full shadow-[0_8px_30px_rgba(0,0,0,0.12)] border-4 border-white overflow-hidden relative group pointer-events-auto transition-transform duration-300 hover:scale-105 active:scale-95 z-10 flex items-center justify-center bg-charcoal">
                                <div class="absolute inset-0 flex items-center justify-center text-white transition-all duration-500"
                                    :class="isFabOpen ? 'scale-50 opacity-0 rotate-90' : 'scale-100 opacity-100 rotate-0'">
                                    <i class="fi fi-rr-wrench-simple text-xl"></i>
                                </div>
                                
                                <div class="absolute inset-0 flex items-center justify-center text-white transition-all duration-500"
                                    :class="isFabOpen ? 'rotate-0 opacity-100 scale-100' : '-rotate-90 opacity-0 scale-50'">
                                    <i class="fi fi-rr-cross text-lg"></i>
                                </div>
                            </button>
                            
                            <!-- Backdrop blur when open -->
                            <div class="fixed inset-0 bg-white/20 backdrop-blur-sm transition-opacity duration-500 pointer-events-none -z-10"
                                 :class="isFabOpen ? 'opacity-100' : 'opacity-0'"></div>
                        </div>
                    </div> <!-- Tables grid -->

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
                    pageVisits:       <?= (int)$pageVisits ?>,
                    totalReviews:     <?= (int)$totalReviews ?>,
                    totalGalleries:   0,
                    pendingReviews:   0,
                    pendingGalleries: 0,
                    activities:       [],
                    isLoading:        true,
                    lastUpdated:      '—',
                    isFabOpen:        false,
                    chartFilter:      'monthly',
                    touristFilter:    'monthly'
                }
            },
            mounted() {
                // GSAP entrance
                if (typeof gsap !== 'undefined') {
                    gsap.from('.gs-reveal', {
                        y: 20, opacity: 0, duration: 0.8,
                        stagger: 0.1, ease: 'power3.out', delay: 0.1
                    });
                }
                
                // Initialize Chart
                this.$nextTick(() => {
                    this.initChart();
                    this.initTouristChart();
                });

                // Initial fetch + start polling every 30s
                this.fetchActivity();
                this.fetchTouristData();
                this._pollTimer = setInterval(() => {
                    this.fetchActivity();
                    this.fetchTouristData();
                }, 30000);
            },
            beforeUnmount() {
                if (this._pollTimer) clearInterval(this._pollTimer);
                if (this.chartInstance) this.chartInstance.destroy();
                if (this.touristChartInstance) this.touristChartInstance.destroy();
            },
            methods: {
                getChartCommonOptions() {
                    return {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(26, 26, 26, 0.9)', // charcoal
                                titleFont: { family: 'Inter', size: 13 },
                                bodyFont: { family: 'Inter', size: 12 },
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)',
                                    drawBorder: false,
                                },
                                border: { display: false },
                                ticks: {
                                    font: { family: 'Inter', size: 11 },
                                    color: 'rgba(26, 26, 26, 0.5)',
                                    padding: 10
                                }
                            },
                            x: {
                                grid: { display: false, drawBorder: false },
                                border: { display: false },
                                ticks: {
                                    font: { family: 'Inter', size: 11 },
                                    color: 'rgba(26, 26, 26, 0.5)',
                                    padding: 10
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        elements: {
                            line: { tension: 0.4 },
                            point: {
                                radius: 0, hitRadius: 10, hoverRadius: 5,
                                backgroundColor: '#6b7b62', borderWidth: 2, borderColor: '#ffffff'
                            }
                        }
                    };
                },
                initChart() {
                    const ctx = document.getElementById('visitChart');
                    if (!ctx) return;
                    
                    const ctx2d = ctx.getContext('2d');
                    
                    // Create gradient for the line chart fill
                    const gradient = ctx2d.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgba(107, 123, 98, 0.2)'); // sage with opacity
                    gradient.addColorStop(1, 'rgba(107, 123, 98, 0)');
                    
                    this.chartInstance = new Chart(ctx, {
                        type: 'line',
                        data: this.getChartData(gradient),
                        options: this.getChartCommonOptions()
                    });
                },
                getChartData(gradient = null) {
                    // Update gradient reference if null
                    if (!gradient && this.chartInstance) {
                        const ctx = document.getElementById('visitChart').getContext('2d');
                        gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        if (this.chartFilter === 'daily') {
                            gradient.addColorStop(0, 'rgba(197, 162, 125, 0.2)'); // clay
                            gradient.addColorStop(1, 'rgba(197, 162, 125, 0)');
                        } else {
                            gradient.addColorStop(0, 'rgba(107, 123, 98, 0.2)'); // sage
                            gradient.addColorStop(1, 'rgba(107, 123, 98, 0)');
                        }
                    }

                    if (this.chartFilter === 'daily') {
                        return {
                            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                            datasets: [{
                                label: 'Pengunjung Harian',
                                data: [12, 19, 15, 25, 22, 30, 28], // Mock data
                                borderColor: '#c5a27d', // clay
                                backgroundColor: gradient,
                                borderWidth: 2,
                                fill: true,
                            }]
                        };
                    } else {
                        // Monthly
                        return {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                            datasets: [{
                                label: 'Pengunjung Bulanan',
                                data: [65, 59, 80, 81, 56, 55, 40], // Mock data
                                borderColor: '#6b7b62', // sage
                                backgroundColor: gradient,
                                borderWidth: 2,
                                fill: true,
                            }]
                        };
                    }
                },
                setChartFilter(filter) {
                    if (this.chartFilter === filter) return;
                    this.chartFilter = filter;
                    if (this.chartInstance) {
                        this.chartInstance.data = this.getChartData();
                        this.chartInstance.update();
                    }
                },
                setTouristFilter(filter) {
                    if (this.touristFilter === filter) return;
                    this.touristFilter = filter;
                    this.fetchTouristData();
                },
                async fetchTouristData() {
                    try {
                        const res = await fetch(`actions/visitor_stats.php?filter=${this.touristFilter}`);
                        const data = await res.json();
                        if (data.success && this.touristChartInstance) {
                            this.touristChartInstance.data.labels = data.labels;
                            this.touristChartInstance.data.datasets[0].data = data.data;
                            
                            const ctx = document.getElementById('touristChart').getContext('2d');
                            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                            
                            if (this.touristFilter === 'daily') {
                                gradient.addColorStop(0, 'rgba(197, 162, 125, 0.2)'); // clay
                                gradient.addColorStop(1, 'rgba(197, 162, 125, 0)');
                                this.touristChartInstance.data.datasets[0].borderColor = '#c5a27d';
                                this.touristChartInstance.data.datasets[0].label = 'Wisatawan Harian';
                                this.touristChartInstance.options.elements.point.backgroundColor = '#c5a27d';
                            } else {
                                gradient.addColorStop(0, 'rgba(107, 123, 98, 0.2)'); // sage
                                gradient.addColorStop(1, 'rgba(107, 123, 98, 0)');
                                this.touristChartInstance.data.datasets[0].borderColor = '#6b7b62';
                                this.touristChartInstance.data.datasets[0].label = 'Wisatawan Bulanan';
                                this.touristChartInstance.options.elements.point.backgroundColor = '#6b7b62';
                            }
                            this.touristChartInstance.data.datasets[0].backgroundColor = gradient;
                            this.touristChartInstance.update();
                        }
                    } catch (e) {
                        console.error('Failed to fetch tourist stats', e);
                    }
                },
                initTouristChart() {
                    const ctx = document.getElementById('touristChart');
                    if (!ctx) return;
                    
                    const ctx2d = ctx.getContext('2d');
                    const gradient = ctx2d.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgba(107, 123, 98, 0.2)');
                    gradient.addColorStop(1, 'rgba(107, 123, 98, 0)');
                    
                    this.touristChartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: 'Wisatawan Bulanan',
                                data: [],
                                borderColor: '#6b7b62',
                                backgroundColor: gradient,
                                borderWidth: 2,
                                fill: true,
                            }]
                        },
                        options: this.getChartCommonOptions()
                    });
                },
                async fetchActivity() {
                    try {
                        const res  = await fetch('actions/activity.php?limit=10');
                        const data = await res.json();
                        if (data.success) {
                            // Animate new rows if there's new pending items
                            const hadPending = this.pendingReviews + this.pendingGalleries;
                            this.activities       = data.activities;
                            this.pendingReviews   = data.pending_reviews;
                            this.pendingGalleries = data.pending_galleries;
                            this.totalReviews     = data.total_reviews;
                            this.totalGalleries   = data.total_galleries;
                            this.lastUpdated      = this.formatTime(data.timestamp);
                            // Flash badge if new pending arrived
                            if (hadPending > 0 && (data.pending_reviews + data.pending_galleries) > hadPending) {
                                if (typeof gsap !== 'undefined') {
                                    gsap.from('.gs-reveal', { opacity: 0.6, duration: 0.4, ease: 'power2.out' });
                                }
                            }
                        }
                    } catch(e) {
                        // silent fail — keep last data
                    } finally {
                        this.isLoading = false;
                    }
                },
                formatDate(dateStr) {
                    if (!dateStr) return '—';
                    return new Date(dateStr).toLocaleDateString('id-ID', {
                        day: '2-digit', month: 'short', year: 'numeric'
                    });
                },
                formatTime(dateStr) {
                    if (!dateStr) return '—';
                    return new Date(dateStr).toLocaleTimeString('id-ID', {
                        hour: '2-digit', minute: '2-digit', second: '2-digit'
                    });
                }
            }
        }).mount('#app');
    </script>
</body>
</html>
