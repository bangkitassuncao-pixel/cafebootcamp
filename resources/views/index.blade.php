@extends('layouts.layout')
@section('title','Beranda')
@section('content')
<div class="relative overflow-hidden bg-cover bg-center bg-no-repeat pt-12 pb-24 md:py-32 border-b border-[#ebdcb9]/30" 
     style="background-image: url('{{ asset('assets/images/Hero.png') }}');">
    

    <div class="absolute inset-0 bg-black/75 backdrop-blur-[2px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div class="space-y-8 text-left">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight" style="font-family: 'Inter', sans-serif;">
                    Where Bytes <br>
                    <span class="text-[#4ade80] relative inline-block">
                        Meet Brews.
                        <span class="absolute left-0 bottom-1 w-full h-6px bg-[#4ade80]/30 rounded-full"></span>
                    </span>
                </h1>
                
                <p class="text-lg text-neutral-300 max-w-lg leading-relaxed font-normal" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    Nikmati kopi premium pilihan dengan kemudahan pemesanan digital langsung dari meja Anda. Solusi modern untuk ruang bersantai dan produktivitas yang efisien.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ url('/menu') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-2xl text-white bg-[#20622c] hover:bg-[#13401b] shadow-md hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                        Lihat Menu Kopi
                    </a>
                </div>
            </div>
            

            <div class="hidden md:block"></div>
            
        </div>
    </div>
</div>

@endsection
