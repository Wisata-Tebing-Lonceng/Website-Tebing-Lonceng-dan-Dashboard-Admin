<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = 'Ringkasan Sistem';
if ($currentPage == 'dashboard.php') $pageTitle = 'Konten Halaman';
if ($currentPage == 'fasilitas.php') $pageTitle = 'Fasilitas';
if ($currentPage == 'galleries.php') $pageTitle = 'Galeri Foto';
if ($currentPage == 'reviews.php') $pageTitle = 'Ulasan';
if ($currentPage == 'settings.php') $pageTitle = 'Pengaturan';
?>
<div class="drawer-side z-50">
    <label for="admin-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="menu w-72 min-h-screen p-0 flex flex-col glass-sidebar shadow-[20px_0_40px_rgba(0,0,0,0.03)] gs-reveal relative overflow-hidden">
        
        <!-- Animated Background Blob for Frosted Effect -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-sage/10 rounded-full blur-[60px] pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-clay/10 rounded-full blur-[80px] pointer-events-none transform -translate-x-1/2 translate-y-1/2"></div>

        <div class="p-6 pb-2 relative z-10 flex flex-col">
            <!-- Logo area -->
            <div class="flex items-center gap-3 px-2 mb-10 group">
                <img src="../assets/svg/logo.svg" alt="Logo" class="w-8 h-8 drop-shadow-md group-hover:scale-110 transition-transform duration-500">
                <span class="text-xl font-serif text-charcoal tracking-tight">Tebing<span class="italic text-charcoal/70">Lonceng</span></span>
            </div>
            
            <!-- Welcome Area (ShareWillow aesthetic) -->
            <div class="px-2 mb-8">
                <?php $adminName = isset($_SESSION['admin_username']) ? ucfirst($_SESSION['admin_username']) : 'Admin'; ?>
                <h2 class="text-3xl font-serif text-charcoal leading-[1.1] mb-2 tracking-tight">Selamat Datang,<br><?= htmlspecialchars($adminName) ?>!</h2>
                <div class="text-xs font-sans text-charcoal/60 font-medium leading-relaxed">
                    Manajemen Tebing Lonceng<br>
                    Admin aktif sejak <span class="font-bold text-charcoal">Apr, 2026</span>.
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-2 relative z-10 custom-scrollbar space-y-1">
            <!-- Navigation Links -->
            <a href="overview.php" class="sidebar-item group <?= $currentPage == 'overview.php' ? 'active' : '' ?>">
                <div class="flex items-center gap-3">
                    <i class="fi fi-rr-apps text-lg <?= $currentPage == 'overview.php' ? 'text-sage' : 'text-charcoal/40 group-hover:text-charcoal' ?> transition-colors"></i> 
                    Ringkasan Sistem
                </div>
            </a>
            
            <a href="dashboard.php" class="sidebar-item group <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <div class="flex items-center gap-3">
                    <i class="fi fi-rr-browser text-lg <?= $currentPage == 'dashboard.php' ? 'text-sage' : 'text-charcoal/40 group-hover:text-charcoal' ?> transition-colors"></i> 
                    Konten Halaman
                </div>
            </a>

            <div class="my-4 mx-2 border-t border-black/5"></div>

            <a href="fasilitas.php" class="sidebar-item group <?= $currentPage == 'fasilitas.php' ? 'active' : '' ?>">
                <div class="flex items-center gap-3">
                    <i class="fi fi-rr-building text-lg <?= $currentPage == 'fasilitas.php' ? 'text-sage' : 'text-charcoal/40 group-hover:text-charcoal' ?> transition-colors"></i> 
                    Fasilitas
                </div>
            </a>
            
            <a href="galleries.php" class="sidebar-item group <?= $currentPage == 'galleries.php' ? 'active' : '' ?>">
                <div class="flex items-center gap-3">
                    <i class="fi fi-rr-picture text-lg <?= $currentPage == 'galleries.php' ? 'text-sage' : 'text-charcoal/40 group-hover:text-charcoal' ?> transition-colors"></i> 
                    Galeri Foto
                </div>
            </a>
            
            <a href="reviews.php" class="sidebar-item group <?= $currentPage == 'reviews.php' ? 'active' : '' ?>">
                <div class="flex items-center gap-3">
                    <i class="fi fi-rr-comment-alt text-lg <?= $currentPage == 'reviews.php' ? 'text-sage' : 'text-charcoal/40 group-hover:text-charcoal' ?> transition-colors"></i> 
                    Ulasan
                </div>
            </a>

            <div class="my-4 mx-2 border-t border-black/5"></div>

            <a href="settings.php" class="sidebar-item group <?= $currentPage == 'settings.php' ? 'active' : '' ?>">
                <div class="flex items-center gap-3">
                    <i class="fi fi-rr-settings text-lg <?= $currentPage == 'settings.php' ? 'text-sage' : 'text-charcoal/40 group-hover:text-charcoal' ?> transition-colors"></i> 
                    Pengaturan
                </div>
            </a>
            
        </div>

        <!-- Footer Profile/Logout area -->
        <div class="p-6 relative z-10 border-t border-black/5 mt-auto bg-[#FBF9F6]/50 backdrop-blur-md">
            <a href="login.php?logout=1" class="flex items-center justify-between px-4 py-3 rounded-2xl bg-white hover:bg-black/5 transition-colors border border-black/5 group shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-charcoal/5 flex items-center justify-center text-charcoal group-hover:bg-charcoal group-hover:text-white transition-colors">
                        <i class="fi fi-rr-sign-out-alt"></i>
                    </div>
                    <span class="text-sm font-bold text-charcoal">Keluar</span>
                </div>
            </a>
        </div>
    </div>
</div>
