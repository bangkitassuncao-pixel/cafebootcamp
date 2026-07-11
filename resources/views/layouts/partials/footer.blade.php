<footer class="bg-[#faf8f5] text-neutral-600 py-12 mt-auto border-t border-[#ebdcb9]/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <div class="col-span-1 md:col-span-2 space-y-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/Byte&Brew.png') }}" alt="Logo Byte & Brew" class="h-10 w-auto object-contain">
                    <div class="flex flex-col justify-center leading-none">
                        <span class="text-lg font-bold text-neutral-800 tracking-wide">Byte & Brew</span>
                        <span class="text-[9px] tracking-widest text-[#20622c] uppercase font-semibold mt-0.5">Coffee & Eatery</span>
                    </div>
                </div>
                <p class="text-sm leading-relaxed max-w-sm text-neutral-500">
                    Kami menyajikan kopi kualitas premium khas Himatifta Universitas Dr. Soetomo Surabaya yang dipadukan dengan kemudahan pemesanan digital langsung dari meja Anda.
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="text-neutral-800 text-sm font-semibold tracking-wider uppercase">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="text-neutral-500 hover:text-[#20622c] hover:underline transition-all">Beranda</a></li>
                    <li><a href="{{ url('/about') }}" class="text-neutral-500 hover:text-[#20622c] hover:underline transition-all">Tentang Kami</a></li>
                    <li><a href="{{ url('/menu') }}" class="text-neutral-500 hover:text-[#20622c] hover:underline transition-all">Menu Kopi</a></li>
                    <li><a href="{{ url('/order/dine-in') }}" class="text-neutral-500 hover:text-[#20622c] hover:underline transition-all">Pesan Dine-In</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h3 class="text-neutral-800 text-sm font-semibold tracking-wider uppercase">Jam Operasional</h3>
                <p class="text-sm text-neutral-500">Setiap Hari: 08:00 - 22:00 WIB</p>
                <div class="pt-2">
                    <span class="block text-xs uppercase tracking-wider text-[#20622c] font-semibold">Lokasi</span>
                    <p class="text-sm text-neutral-500 leading-relaxed">Universitas Dr. Soetomo, Jl. Semolowaru No.84, Menur Pumpungan, Kec. Sukolilo, Surabaya, Jawa Timur 60118</p>
                </div>
            </div>

        </div>

        <div class="mt-8 pt-8 border-t border-[#ebdcb9]/40 text-center text-xs text-neutral-400">
            <p>&copy; {{ date('Y') }} Bootcamp Laravel Himatifta - Universitas Dr. Soetomo. All rights reserved.</p>
        </div>
    </div>
</footer>
