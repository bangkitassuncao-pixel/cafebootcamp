@extends('layouts.layout')
@section('title', 'Menu Coffee & Eatery')
@section('content')

<div class="relative min-h-screen bg-[#faf8f5] py-16 px-4 sm:px-6 lg:px-8">

    <!-- Tombol Penyaring Kategori (Filter) -->
    <div class="max-w-7xl mx-auto mb-12 flex justify-center gap-3 overflow-x-auto pb-2 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
        <button onclick="filterMenu('all')" id="tab-all" class="px-6 py-3 rounded-2xl text-sm font-semibold transition-all bg-[#20622c] text-white shadow-[0_10px_20px_rgba(32,98,44,0.15)] border border-transparent">
            Semua Menu
        </button>
        <button onclick="filterMenu('coffee')" id="tab-coffee" class="px-6 py-3 rounded-2xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/40 hover:bg-[#f5f3ef]">
            Coffee
        </button>
        <button onclick="filterMenu('non-coffee')" id="tab-non-coffee" class="px-6 py-3 rounded-2xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/40 hover:bg-[#f5f3ef]">
            Non-Coffee
        </button>
        <button onclick="filterMenu('food-snack')" id="tab-food-snack" class="px-6 py-3 rounded-2xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/40 hover:bg-[#f5f3ef]">
            Food & Snack
        </button>
    </div>

    <!-- Kisi Katalog Menu -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="menu-grid">
        @foreach ($menus as $menu)
            <div class="menu-card bg-white rounded-3xl border border-[#ebdcb9]/30 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col group" data-category="{{ $menu->category }}">
                <div class="h-64 w-full overflow-hidden relative bg-neutral-100">
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <span class="absolute top-4 right-4 bg-white/90 backdrop-blur-md text-sm font-bold text-[#20622c] px-4 py-1.5 rounded-full shadow-sm">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </span>
                    <span class="absolute top-4 left-4 bg-[#20622c]/90 text-white text-[10px] uppercase font-bold tracking-wider px-3 py-1 rounded-full shadow-sm">
                        {{ $menu->category }}
                    </span>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div>
                        <h3 class="font-bold text-xl text-neutral-800 group-hover:text-[#20622c] transition-colors" style="font-family: 'Outfit', sans-serif;">
                            {{ $menu->name }}
                        </h3>
                        <p class="text-sm text-neutral-500 mt-2 leading-relaxed">
                            {{ $menu->description }}
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ url('/order/dine-in') }}" class="w-full inline-flex items-center justify-center bg-neutral-50 hover:bg-[#20622c] text-[#20622c] hover:text-white py-3 rounded-2xl text-sm font-bold tracking-wide transition-all border border-[#20622c]/10 hover:border-transparent gap-1.5 shadow-sm">
                            Pesan 
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/menu-filter.js') }}"></script>
@endpush

@endsection