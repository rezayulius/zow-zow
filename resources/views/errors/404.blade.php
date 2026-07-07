@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan | ZOW Vetique')
@section('meta_description', 'Halaman yang Anda cari tidak ditemukan. Kembali ke beranda ZOW Vetique untuk melihat layanan klinik hewan kami di Kemang, Jakarta Selatan.')
@section('robots', 'noindex, follow')

@section('content')
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden bg-gradient-to-b from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50 py-24 px-6">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-br from-forest-moss-green-100/30 to-forest-moss-green-200/30 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-soft-blush-pink-100/30 to-chai-100/30 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-2xl mx-auto text-center">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-xl border-4 border-forest-moss-green-100 mb-8">
            <x-animal-icon name="dog" class="w-12 h-12 text-forest-moss-green-600" />
        </div>

        <p class="text-sm font-bold uppercase tracking-widest text-forest-moss-green-600 mb-3">Error 404</p>
        <h1 class="text-4xl md:text-5xl font-heading font-bold text-carob-900 mb-4 leading-tight">
            Ups, halaman ini nyasar seperti anabul yang lupa jalan pulang
        </h1>
        <p class="text-carob-600 text-lg leading-relaxed mb-10">
            Halaman yang Anda cari tidak ditemukan atau sudah dipindahkan. Tenang, mari kembali ke beranda dan lanjutkan menjelajahi layanan kami.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-forest-moss-green-600 text-white rounded-2xl font-bold shadow-lg hover:bg-forest-moss-green-700 hover:-translate-y-1 transition-all duration-300">
                <i data-lucide="home" class="w-5 h-5"></i>
                Kembali ke Beranda
            </a>
            <a href="{{ route('home') }}#health" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-carob-800 border border-gray-200 rounded-2xl font-bold shadow-sm hover:shadow-md hover:border-forest-moss-green-300 transition-all duration-300">
                <i data-lucide="stethoscope" class="w-5 h-5"></i>
                Lihat Layanan Kami
            </a>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-carob-500">
            <a href="{{ route('home') }}#lokasi" class="hover:text-forest-moss-green-600 transition-colors">Lokasi Klinik</a>
            <span class="text-carob-300">&middot;</span>
            <a href="{{ route('home') }}#harga" class="hover:text-forest-moss-green-600 transition-colors">Harga & Paket</a>
            <span class="text-carob-300">&middot;</span>
            <a href="{{ route('home') }}#testimoni" class="hover:text-forest-moss-green-600 transition-colors">FAQ</a>
            <span class="text-carob-300">&middot;</span>
            <a href="https://wa.me/6281219088899" target="_blank" rel="noopener noreferrer" class="hover:text-forest-moss-green-600 transition-colors">Hubungi Admin</a>
        </div>
    </div>
</section>
@endsection
