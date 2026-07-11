@extends('layouts.layout')
@section('title', 'Pesanan Dine-In')
@section('content')

<div class="relative min-h-screen bg-[#faf8f5] py-12 px-4 sm:px-6 lg:px-8 print:hidden" id="dine-in-app" data-menus="{{ json_encode($menus) }}" data-csrf="{{ csrf_token() }}">

    <!-- Konten Utama -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri: Pilihan Menu & Detail Meja -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Input Nama Pelanggan & Nomor Meja -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-[#ebdcb9]/40 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-neutral-800 mb-4 flex items-center gap-2" style="font-family: 'Outfit', sans-serif;">
                    <svg class="w-5 h-5 text-[#20622c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Pelanggan & Meja
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-500 uppercase tracking-wider mb-2">Nama Pemesan</label>
                        <input type="text" id="customer-name" placeholder="Masukkan nama Anda..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:outline-none focus:ring-2 focus:ring-[#20622c]/20 focus:border-[#20622c] transition-all bg-neutral-50/50">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-neutral-500 uppercase tracking-wider mb-2">Email Pelanggan</label>
                        <input type="email" id="customer-email" placeholder="nama@email.com..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:outline-none focus:ring-2 focus:ring-[#20622c]/20 focus:border-[#20622c] transition-all bg-neutral-50/50">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-500 uppercase tracking-wider mb-2">Pilih Nomor Meja</label>
                        <select id="table-number" class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:outline-none focus:ring-2 focus:ring-[#20622c]/20 focus:border-[#20622c] transition-all bg-neutral-50/50">
                            <option value="" disabled selected>Pilih meja...</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">Meja {{ sprintf('%02d', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filter Kategori & Kolom Pencarian -->
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="flex gap-2 overflow-x-auto pb-1 w-full sm:w-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    <button onclick="filterCategory('all')" id="cat-all" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all bg-[#20622c] text-white shadow-[0_4px_12px_rgba(32,98,44,0.2)]">
                        Semua
                    </button>
                    <button onclick="filterCategory('coffee')" id="cat-coffee" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/30 hover:bg-[#f5f3ef]">
                        Coffee
                    </button>
             <       <button onclick="filterCategory('non-coffee')" id="cat-non-coffee" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/30 hover:bg-[#f5f3ef]">
                        Non-Coffee
                    </button>
                    <button onclick="filterCategory('food-snack')" id="cat-food-snack" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/30 hover:bg-[#f5f3ef]">
                        Food & Snack
                    </button>
                </div>
                
                <div class="relative w-full sm:w-72">
                    <input type="text" id="search-menu" oninput="searchMenu()" placeholder="Cari menu..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-neutral-200 focus:outline-none focus:ring-2 focus:ring-[#20622c]/20 focus:border-[#20622c] transition-all text-sm">
                    <svg class="w-4 h-4 text-neutral-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Grid Daftar Menu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" id="product-grid">
                @foreach ($menus as $menu)
                    <div class="product-card bg-white rounded-3xl border border-[#ebdcb9]/30 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group" 
                         data-id="{{ $menu->id }}" 
                         data-category="{{ $menu->category }}" 
                         data-name="{{ strtolower($menu->name) }}"
                         data-description="{{ strtolower($menu->description ?? '') }}">
                        <div class="h-44 w-full overflow-hidden relative bg-neutral-100">
                            <img src="/{{ $menu->image }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-xs font-bold text-[#20622c] px-3 py-1 rounded-full shadow-sm">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-neutral-800 group-hover:text-[#20622c] transition-colors">{{ $menu->name }}</h3>
                                <p class="text-xs text-neutral-500 mt-2 leading-relaxed line-clamp-2">{{ $menu->description }}</p>
                            </div>
                            <button onclick="addToCart({{ $menu->id }})" class="w-full mt-4 bg-neutral-50 hover:bg-[#20622c] group-hover:bg-[#20622c]/5 group-hover:hover:bg-[#20622c] text-[#20622c] hover:text-white group-hover:text-[#20622c] group-hover:hover:text-white py-2.5 rounded-xl text-xs font-bold transition-all border border-[#20622c]/10 hover:border-transparent flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Kolom Kanan: Rincian Keranjang Belanja -->
        <div class="space-y-6 lg:sticky lg:top-24">
            
            <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-[#ebdcb9]/40 p-6 shadow-sm">
                <div class="flex items-center justify-between border-b border-neutral-100 pb-4 mb-4">
                    <h2 class="text-lg font-bold text-neutral-800 flex items-center gap-2" style="font-family: 'Outfit', sans-serif;">
                        <svg class="w-5 h-5 text-[#20622c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Keranjang Pesanan
                    </h2>
                    <span id="cart-count" class="bg-[#20622c]/10 text-[#20622c] text-xs font-bold px-2.5 py-1 rounded-full">
                        0 item
                    </span>
                </div>

                <!-- Tampilan kalau keranjang kosong -->
                <div id="cart-empty" class="text-center py-12 text-neutral-400 space-y-3">
                    <svg class="w-12 h-12 mx-auto stroke-current opacity-60" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <p class="text-sm">Keranjang Anda masih kosong</p>
                </div>

                <!-- List Item di Keranjang -->
                <div id="cart-items" class="space-y-4 max-h-[300px] overflow-y-auto pr-2 no-scrollbar hidden">
                    <!-- Item belanjaan akan dirender di sini lewat JS -->
                </div>

                <!-- Total Harga & Pilihan Pembayaran -->
                <div id="cart-totals-section" class="border-t border-neutral-100 mt-4 pt-4 space-y-3 hidden">
                    <div class="flex justify-between text-sm text-neutral-500">
                        <span>Subtotal</span>
                        <span id="cart-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-sm text-neutral-500">
                        <span>PPN 10%</span>
                        <span id="cart-tax">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-base font-bold text-neutral-800 border-t border-dashed border-neutral-200 pt-3">
                        <span>Total Bayar</span>
                        <span id="cart-total" class="text-[#20622c]">Rp 0</span>
                    </div>

                    <!-- Opsi Metode Pembayaran -->
                    <div class="space-y-2 mt-4">
                        <label class="block text-xs font-semibold text-neutral-500 uppercase tracking-wider">Metode Pembayaran</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="flex flex-col items-center justify-center p-3 rounded-xl border border-neutral-200 cursor-pointer hover:bg-neutral-50 transition-all text-center has-[:checked]:border-[#20622c] has-[:checked]:bg-[#20622c]/5 has-[:checked]:ring-1 has-[:checked]:ring-[#20622c]">
                                <input type="radio" name="payment-method" value="cash" checked class="peer hidden">
                                <span class="text-xs font-bold text-neutral-700 peer-checked:text-[#20622c]">Tunai</span>
                                <span class="text-[9px] text-neutral-400 mt-0.5 peer-checked:text-[#20622c]/80">di Kasir</span>
                            </label>
                            <label class="flex flex-col items-center justify-center p-3 rounded-xl border border-neutral-200 cursor-pointer hover:bg-neutral-50 transition-all text-center has-[:checked]:border-[#20622c] has-[:checked]:bg-[#20622c]/5 has-[:checked]:ring-1 has-[:checked]:ring-[#20622c]">
                                <input type="radio" name="payment-method" value="qris" class="peer hidden">
                                <span class="text-xs font-bold text-neutral-700 peer-checked:text-[#20622c]">QRIS</span>
                                <span class="text-[9px] text-neutral-400 mt-0.5 peer-checked:text-[#20622c]/80">Instant</span>
                            </label>
                            <label class="flex flex-col items-center justify-center p-3 rounded-xl border border-neutral-200 cursor-pointer hover:bg-neutral-50 transition-all text-center has-[:checked]:border-[#20622c] has-[:checked]:bg-[#20622c]/5 has-[:checked]:ring-1 has-[:checked]:ring-[#20622c]">
                                <input type="radio" name="payment-method" value="transfer" class="peer hidden">
                                <span class="text-xs font-bold text-neutral-700 peer-checked:text-[#20622c]">Transfer</span>
                                <span class="text-[9px] text-neutral-400 mt-0.5 peer-checked:text-[#20622c]/80">Bank</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Pesan Sekarang -->
                    <button id="btn-checkout" onclick="processCheckout()" class="w-full mt-4 bg-[#20622c] hover:bg-[#184620] text-white py-4 rounded-2xl font-bold transition-all shadow-md flex items-center justify-center gap-2">
                        Pesan Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Link ke Riwayat Pesanan -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl border border-[#ebdcb9]/40 p-5 shadow-sm">
                <button onclick="toggleHistoryModal()" class="w-full flex items-center justify-between text-neutral-600 hover:text-[#20622c] transition-all font-semibold text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Riwayat Pesanan Anda
                    </span>
                    <span class="text-xs px-2 py-0.5 bg-neutral-100 rounded-full font-bold" id="history-badge">0</span>
                </button>
            </div>

        </div>

    </div>
</div>

<!-- Modal Struk / Nota Belanja -->
<div id="receipt-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300 print:absolute print:inset-0 print:flex print:bg-transparent print:backdrop-blur-none">
    <div class="bg-white rounded-3xl w-full max-w-md mx-4 overflow-hidden shadow-2xl border border-neutral-100 transform scale-95 transition-transform duration-300 print:shadow-none print:border-none print:m-0 print:w-full print:max-w-none">
        <div class="bg-[#20622c] text-white p-6 text-center relative">
            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-lg font-bold">Pemesanan Berhasil!</h3>
            <p class="text-white/80 text-xs mt-1">Pesanan Anda telah disimpan di database server.</p>
        </div>

        <div class="p-6 space-y-4 text-neutral-700 max-h-[400px] overflow-y-auto no-scrollbar print:max-h-none print:overflow-visible" id="receipt-content">
            <!-- Konten struk belanjaan akan diisi lewat JS -->
        </div>

        <div class="p-6 border-t border-neutral-100 flex gap-3 print:hidden">
            <button onclick="closeReceiptModal()" class="flex-1 px-4 py-3 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-neutral-700 font-bold transition-all text-center text-sm">
                Tutup
            </button>
            <button onclick="window.print()" class="flex-1 px-4 py-3 rounded-xl bg-[#20622c] hover:bg-[#184620] text-white font-bold transition-all text-center text-sm flex items-center justify-center gap-1.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Struk
            </button>
        </div>
    </div>
</div>

<!-- Modal Riwayat Pembelian -->
<div id="history-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl w-full max-w-xl mx-4 overflow-hidden shadow-2xl border border-neutral-100 transform scale-95 transition-transform duration-300">
        <div class="p-6 border-b border-neutral-100 flex justify-between items-center bg-[#faf8f5]">
            <h3 class="text-lg font-bold text-neutral-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#20622c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Riwayat Pemesanan Dine-In
            </h3>
            <button onclick="toggleHistoryModal()" class="text-neutral-400 hover:text-neutral-600 transition-colors p-1.5 hover:bg-neutral-100 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 max-h-[450px] overflow-y-auto no-scrollbar space-y-4" id="history-content">
            <!-- List riwayat belanja akan diisi lewat JS -->
        </div>
    </div>
</div>



<style>
    @media print {
        @page {
            margin: 0;
        }
        body {
            margin: 1.6cm;
        }
    }
</style>

@push('scripts')
<script src="{{ asset('js/dine-in.js') }}?v={{ time() }}"></script>
@endpush
@endsection