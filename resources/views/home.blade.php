@extends('layouts.app')

@section('title', 'Zow Vetique - Pet Wellness Hub')

@section('content')
    <div class="bg-gradient-to-b from-soft-linen-50 via-vanilla-50 to-forest-moss-green-50">
        @include('partials.header')
        @include('partials.hero')
        @include('partials.services')
        @include('partials.pricing')
        @include('partials.membership')
        @include('partials.testimonials')
        @include('partials.location')
        @include('partials.footer')
    </div>
@endsection
