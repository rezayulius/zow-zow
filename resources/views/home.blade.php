@extends('layouts.app')

@section('title', 'Zow Zow - Pet Wellness Hub')

@section('content')
    @include('partials.header')
    @include('partials.hero')
    @include('partials.services')
    @include('partials.pricing')
    @include('partials.membership')
    @include('partials.testimonials')
    @include('partials.footer')
@endsection