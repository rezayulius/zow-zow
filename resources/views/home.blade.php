@extends('layouts.app')

@section('title', 'Klinik Hewan Jakarta Selatan | ZOW Vetique Kemang')
@section('meta_description', 'ZOW Vetique adalah klinik hewan terpercaya di Kemang, Jakarta Selatan. Layanan konsultasi dokter hewan, vaksinasi, steril, grooming, laboratorium, dan emergency care 24 jam.')

@section('content')
    <div class="bg-gradient-to-b from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50">
        @include('partials.header')
        @include('partials.hero')
        @include('partials.services')
        @include('partials.bundle')
        @include('partials.testimonials')
        @include('partials.location')
        @include('partials.footer')
    </div>
@endsection
