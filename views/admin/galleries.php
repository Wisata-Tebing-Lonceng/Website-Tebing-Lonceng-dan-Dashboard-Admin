<?php
// views/admin/galleries.php
// $galleries => array of galleries
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tebing Lonceng Admin — Galeri</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { base: '#FBF9F6', charcoal: '#1a1a1a', sage: '#6b7b62', clay: '#c5a27d' },
                    fontFamily: { sans: ['Inter','sans-serif'], serif: ['Instrument Serif','serif'] }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FBF9F6; color: #1a1a1a; }
        [v-cloak] { display: none !important; }

        .glass-sidebar {
            background: rgba(251,249,246,0.7);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border-right: 1px solid rgba(0,0,0,0.05);
        }
        .sidebar-item { display:flex; align-items:center; justify-content:space-between; padding:0.75rem 1rem; border-radius:1rem; font-size:0.875rem; font-weight:500; transition:all 0.3s; color:rgba(26,26,26,0.7); }
        .sidebar-item:hover:not(.active) { background-color:rgba(0,0,0,0.05); color:#1a1a1a; }
        .sidebar-item.active { background-color:rgba(107,123,98,0.1); color:#6b7b62; font-weight:700; }
        .sidebar-heading { display:flex; align-items:center; justify-content:space-between; font-size:0.625rem; font-weight:800; color:rgba(26,26,26,0.4); margin-bottom:0.25rem; margin-top:1.5rem; padding:0 1rem; text-transform:uppercase; letter-spacing:0.1em; }
        .drawer-side .drawer-overlay { background-color:rgba(0,0,0,0.2); backdrop-filter:blur(4px); }

        .table-container { background-color:white; border-radius:1.5rem; border:1px solid rgba(0,0,0,0.05); overflow-x:auto; overflow-y:hidden; box-shadow:0 8px 30px rgba(0,0,0,0.03); }
        .table-container th { background-color:transparent; color:rgba(26,26,26,0.5); font-weight:600; font-size:0.6875rem; padding:1rem 1.5rem; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid rgba(0,0,0,0.05); white-space:nowrap; }
        .table-container td { padding:1rem 1.5rem; border-bottom:1px solid rgba(0,0,0,0.02); font-size:0.875rem; }

        .tab-pill { padding:0.5rem 1.25rem; border-radius:999px; font-size:0.75rem; font-weight:700; cursor:pointer; transition:all 0.2s; border:1px solid rgba(0,0,0,0.06); }
        .tab-pill.active-all      { background:#1a1a1a; color:#fff; border-color:#1a1a1a; }
        .tab-pill.active-pending  { background:#c5a27d; color:#fff; border-color:#c5a27d; }
        .tab-pill.active-approved { background:#6b7b62; color:#fff; border-color:#6b7b62; }
        .tab-pill.active-rejected { background:#ef4444; color:#fff; border-color:#ef4444; }
        .tab-pill:not([class*="active"]) { background:white; color:#1a1a1a; }
        .tab-pill:not([class*="active"]):hover { background:rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../user/loader.php'; ?>

    <div class="drawer lg:drawer-open" id="app" v-cloak>
        <input id="admin-drawer" type="checkbox" class="drawer-toggle" />

        <!-- MAIN CONTENT -->
        <div class="drawer-content m-4 h-[calc(100vh-2rem)] overflow-y-auto bg-white rounded-xl shadow-[-10px_0_40px_rgba(0,0,0,0.04)] border-l border-black/5 relative z-10 custom-scrollbar">

            <!-- Navbar -->
            <div class="px-4 sm:px-6 lg:px-10 py-5 sm:py-6 flex items-center justify-between sticky top-0 bg-white/80 backdrop-blur-xl z-20 border-b border-black/5">
                <div class="flex items-center gap-3 sm:gap-4">
                    <label for="admin-drawer" class="btn btn-square btn-ghost btn-sm lg:hidden bg-charcoal/5 text-charcoal">
                        <i class="fi fi-rr-menu-burger"></i>
                    </label>
                    <div class="text-charcoal font-serif text-lg sm:text-xl md:text-2xl tracking-tight">Galeri Foto</div>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="openAddModal" class="btn bg-charcoal hover:bg-sage text-white border-none rounded-xl font-bold h-9 px-4 text-xs flex items-center gap-2 shadow-sm transition-all">
                        <i class="fi fi-rr-plus"></i> <span class="hidden sm:inline">Tambah Foto</span>
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
                                    <i class="fi fi-rr-picture text-[10px]"></i>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-charcoal text-white flex items-center justify-center border-2 border-[#FBF9F6] shadow-sm z-10">
                                    <i class="fi fi-rr-users text-[10px]"></i>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-charcoal/80 tracking-widest uppercase">Galeri & Kurasi</span>
                        </div>

                        <!-- Bottom: Typography -->
                        <div class="relative z-10 mt-12 sm:mt-16 max-w-2xl">
                            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-[5.5rem] font-serif text-charcoal leading-[1.05] tracking-tight mb-3">
                                Galeri <br/> <span class="italic pr-4">komunitas</span>
                            </h2>
                            <p class="text-charcoal/60 font-medium text-xs sm:text-sm lg:text-base">Tinjau, setujui, tolak, atau tambahkan foto memukau ke galeri publik.</p>
                        </div>
                    </div>

                    <!-- Global Alert -->
                    <div v-if="globalMsg" :class="globalMsgType==='success' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-700 border-red-100'" class="border rounded-2xl mb-6 p-4 flex items-center gap-3 text-sm font-bold">
                        <i class="fi" :class="globalMsgType==='success' ? 'fi-rr-check-circle' : 'fi-rr-exclamation'"></i>
                        <span>{{ globalMsg }}</span>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                        <div class="bg-[#FBF9F6] rounded-2xl p-5 border border-black/5">
                            <p class="text-[10px] font-black uppercase tracking-widest text-charcoal/40 mb-1">Total</p>
                            <p class="text-3xl font-serif text-charcoal">{{ galleriesList.length }}</p>
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
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button @click="filter='all'" :class="filter==='all' ? 'active-all' : ''" class="tab-pill">Semua <span class="opacity-60 ml-1">{{ galleriesList.length }}</span></button>
                        <button @click="filter='pending'" :class="filter==='pending' ? 'active-pending' : ''" class="tab-pill">Menunggu <span class="opacity-60 ml-1">{{ countByStatus('pending') }}</span></button>
                        <button @click="filter='approved'" :class="filter==='approved' ? 'active-approved' : ''" class="tab-pill">Disetujui <span class="opacity-60 ml-1">{{ countByStatus('approved') }}</span></button>
                        <button @click="filter='rejected'" :class="filter==='rejected' ? 'active-rejected' : ''" class="tab-pill">Ditolak <span class="opacity-60 ml-1">{{ countByStatus('rejected') }}</span></button>
                    </div>

                    <!-- Table -->
                    <div class="table-container">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left">Pengirim</th>
                                    <th class="text-left hidden md:table-cell">Keterangan</th>
                                    <th class="text-left hidden sm:table-cell">Tanggal</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="filteredGalleries.length === 0">
                                    <td colspan="5" class="text-center py-12 text-charcoal/30 text-sm font-medium italic">
                                        Tidak ada foto di kategori ini.
                                    </td>
                                </tr>
                                <tr v-for="item in filteredGalleries" :key="item.id" class="hover:bg-black/[0.02] transition-colors group">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-sage/10 text-sage flex items-center justify-center font-bold text-sm flex-shrink-0">
                                                {{ item.nama ? item.nama.charAt(0).toUpperCase() : 'A' }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-charcoal text-sm">{{ item.nama || 'Admin' }}</p>
                                                <p class="text-[10px] text-charcoal/40 truncate max-w-[120px]">{{ item.email || '—' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden md:table-cell">
                                        <span v-if="item.caption" class="text-charcoal/60 text-xs italic line-clamp-1 max-w-[200px] block">"{{ item.caption }}"</span>
                                        <span v-else class="text-charcoal/20 text-xs italic">Tanpa keterangan</span>
                                    </td>
                                    <td class="hidden sm:table-cell">
                                        <span class="text-charcoal/50 text-xs font-medium">{{ formatDate(item.created_at) }}</span>
                                    </td>
                                    <td>
                                        <span v-if="item.status==='approved'" class="inline-flex items-center gap-1 bg-sage/10 text-sage text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">
                                            <i class="fi fi-rr-check text-[9px]"></i> Disetujui
                                        </span>
                                        <span v-else-if="item.status==='rejected'" class="inline-flex items-center gap-1 bg-red-50 text-red-500 text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">
                                            <i class="fi fi-rr-cross text-[9px]"></i> Ditolak
                                        </span>
                                        <span v-else class="inline-flex items-center gap-1 bg-clay/10 text-clay text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">
                                            <i class="fi fi-rr-time-half-past text-[9px]"></i> Menunggu
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- View -->
                                            <a :href="'../' + item.image_path" target="_blank" class="w-8 h-8 rounded-xl border border-black/5 text-charcoal/40 hover:text-charcoal hover:bg-black/5 flex items-center justify-center transition-colors" title="Lihat Foto">
                                                <i class="fi fi-rr-eye text-xs"></i>
                                            </a>
                                            <!-- Approve -->
                                            <button v-if="item.status !== 'approved'" @click="updateStatus(item.id,'approve')" :disabled="isSubmitting" class="w-8 h-8 rounded-xl border border-sage/20 text-sage hover:bg-sage hover:text-white hover:border-sage flex items-center justify-center transition-colors" title="Setujui">
                                                <i class="fi fi-rr-check text-xs"></i>
                                            </button>
                                            <!-- Reject -->
                                            <button v-if="item.status !== 'rejected'" @click="updateStatus(item.id,'reject')" :disabled="isSubmitting" class="w-8 h-8 rounded-xl border border-clay/20 text-clay hover:bg-clay hover:text-white hover:border-clay flex items-center justify-center transition-colors" title="Tolak">
                                                <i class="fi fi-rr-cross text-xs"></i>
                                            </button>
                                            <!-- Delete -->
                                            <button @click="confirmDelete(item.id)" class="w-8 h-8 rounded-xl border border-red-100 text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 flex items-center justify-center transition-colors" title="Hapus">
                                                <i class="fi fi-rr-trash text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div><!-- /Drawer Content -->

        <!-- SIDEBAR -->
        <?php include __DIR__ . '/components/sidebar.php'; ?>

        <!-- ADD PHOTO MODAL -->
        <dialog class="modal" :class="{'modal-open': showAddModal}">
            <div class="modal-box bg-[#fbf9f6] rounded-[2.5rem] p-8 lg:p-10 border border-black/5 shadow-2xl w-full max-w-lg">
                <h3 class="text-3xl font-serif text-charcoal mb-2">Tambah Foto</h3>
                <p class="text-sm text-charcoal/50 mb-8 font-medium">Upload foto baru dari admin. Status otomatis disetujui.</p>

                <!-- Drop Zone -->
                <div class="relative border-2 border-dashed border-black/10 rounded-2xl h-48 flex flex-col items-center justify-center cursor-pointer hover:border-sage/40 hover:bg-sage/5 transition-all mb-6 overflow-hidden"
                     @click="$refs.fileInput.click()" @dragover.prevent @drop.prevent="onDrop">
                    <img v-if="previewUrl" :src="previewUrl" class="absolute inset-0 w-full h-full object-cover rounded-2xl opacity-70">
                    <div class="relative z-10 text-center pointer-events-none" :class="previewUrl ? 'text-white' : 'text-charcoal/30'">
                        <i class="fi fi-rr-picture text-4xl block mb-2"></i>
                        <p class="text-xs font-bold">{{ previewUrl ? 'Klik untuk ganti foto' : 'Klik atau seret foto ke sini' }}</p>
                        <p class="text-[10px] mt-1 opacity-60">JPG, PNG, WEBP • Maks 10 MB</p>
                    </div>
                    <input type="file" ref="fileInput" class="hidden" accept="image/jpeg,image/png,image/webp" @change="onFileChange">
                </div>

                <!-- Caption -->
                <div class="form-control mb-8">
                    <label class="label"><span class="label-text text-[10px] font-black uppercase tracking-widest text-charcoal/40">Keterangan Foto (Opsional)</span></label>
                    <textarea v-model="addForm.caption" class="textarea textarea-bordered w-full rounded-2xl bg-white border-black/5 focus:border-sage text-charcoal text-sm h-24 resize-none" placeholder="Deskripsi singkat tentang foto ini..."></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="closeAddModal" class="btn bg-black/5 border-none rounded-full flex-1 h-12 font-bold text-sm">Batal</button>
                    <button type="button" @click="submitAdd" :disabled="isSubmitting || !addForm.file" class="btn bg-charcoal hover:bg-sage text-white border-none rounded-full flex-1 h-12 font-bold text-sm transition-all">
                        <span v-if="isSubmitting" class="loading loading-spinner loading-xs mr-2"></span>
                        {{ isSubmitting ? 'Mengupload...' : 'Upload Foto' }}
                    </button>
                </div>
            </div>
            <div class="modal-backdrop bg-charcoal/20 backdrop-blur-sm" @click="closeAddModal"></div>
        </dialog>

        <!-- DELETE MODAL -->
        <dialog class="modal" :class="{'modal-open': deleteId !== null}">
            <div class="modal-box bg-[#fbf9f6] rounded-[2.5rem] p-10 text-center border border-black/5 shadow-2xl">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fi fi-rr-trash text-2xl"></i>
                </div>
                <h3 class="text-2xl font-serif text-charcoal mb-3">Hapus Foto?</h3>
                <p class="text-sm text-charcoal/50 mb-8 font-medium">Foto akan dihapus permanen dari server. Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex gap-4">
                    <button type="button" class="btn bg-black/5 border-none rounded-full flex-1 h-12 font-bold" @click="deleteId = null">Batal</button>
                    <button type="button" class="btn bg-red-500 hover:bg-red-600 text-white border-none rounded-full flex-1 h-12 font-bold" @click="proceedDelete" :disabled="isSubmitting">
                        <span v-if="isSubmitting" class="loading loading-spinner loading-xs"></span>
                        Ya, Hapus
                    </button>
                </div>
            </div>
            <div class="modal-backdrop bg-charcoal/20 backdrop-blur-sm" @click="deleteId = null"></div>
        </dialog>

    </div>

    <script>
    const { createApp } = Vue;
    createApp({
        data() {
            return {
                galleriesList: <?= json_encode($galleries ?? [], JSON_UNESCAPED_UNICODE) ?>,
                filter: 'all',
                globalMsg: '',
                globalMsgType: 'success',
                isSubmitting: false,
                deleteId: null,
                showAddModal: false,
                previewUrl: null,
                addForm: { file: null, caption: '' }
            }
        },
        computed: {
            filteredGalleries() {
                if (this.filter === 'all') return this.galleriesList;
                return this.galleriesList.filter(g => g.status === this.filter);
            }
        },
        mounted() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.table-container', { y: 20, opacity: 0, duration: 0.8, ease: 'power3.out', delay: 0.2 });
            }
        },
        methods: {
            countByStatus(s) { return this.galleriesList.filter(g => g.status === s).length; },
            formatDate(d) {
                if (!d) return '—';
                return new Date(d).toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
            },
            openAddModal() { this.showAddModal = true; },
            closeAddModal() { this.showAddModal = false; this.previewUrl = null; this.addForm = { file: null, caption: '' }; },
            onFileChange(e) {
                const file = e.target.files[0];
                if (!file) return;
                this.addForm.file = file;
                if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                this.previewUrl = URL.createObjectURL(file);
            },
            onDrop(e) {
                const file = e.dataTransfer.files[0];
                if (!file) return;
                this.addForm.file = file;
                if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                this.previewUrl = URL.createObjectURL(file);
            },
            showMsg(msg, type = 'success') {
                this.globalMsg = msg; this.globalMsgType = type;
                setTimeout(() => this.globalMsg = '', 4000);
            },
            async submitAdd() {
                if (!this.addForm.file) return;
                this.isSubmitting = true;
                const fd = new FormData();
                fd.append('action', 'add');
                fd.append('gambar', this.addForm.file);
                fd.append('caption', this.addForm.caption);
                try {
                    const res = await fetch('actions/galleries.php', { method: 'POST', body: fd });
                    const data = await res.json();
                    if (data.success) {
                        this.galleriesList.unshift(data.gallery);
                        this.showMsg(data.message, 'success');
                        this.closeAddModal();
                    } else {
                        this.showMsg(data.message, 'error');
                    }
                } catch { this.showMsg('Error jaringan.', 'error'); }
                finally { this.isSubmitting = false; }
            },
            async updateStatus(id, action) {
                this.isSubmitting = true;
                const params = new URLSearchParams({ action, id });
                try {
                    const res = await fetch('actions/galleries.php', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:params });
                    const data = await res.json();
                    if (data.success) {
                        const idx = this.galleriesList.findIndex(g => g.id == id);
                        if (idx !== -1) this.galleriesList[idx].status = action === 'approve' ? 'approved' : 'rejected';
                        this.showMsg(data.message, 'success');
                    } else { this.showMsg(data.message, 'error'); }
                } catch { this.showMsg('Error jaringan.', 'error'); }
                finally { this.isSubmitting = false; }
            },
            confirmDelete(id) { this.deleteId = id; },
            async proceedDelete() {
                this.isSubmitting = true;
                const params = new URLSearchParams({ action: 'delete', id: this.deleteId });
                try {
                    const res = await fetch('actions/galleries.php', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:params });
                    const data = await res.json();
                    if (data.success) {
                        this.galleriesList = this.galleriesList.filter(g => g.id != this.deleteId);
                        this.showMsg(data.message, 'success');
                    } else { this.showMsg(data.message, 'error'); }
                } catch { this.showMsg('Error jaringan.', 'error'); }
                finally { this.isSubmitting = false; this.deleteId = null; }
            }
        }
    }).mount('#app');
    </script>
</body>
</html>
