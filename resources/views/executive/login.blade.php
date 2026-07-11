@extends('layouts.executive')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-old-mustard-yellow-400 to-old-mustard-yellow-600 text-deep-cocoa-brown-900 text-xl font-bold mb-4 shadow-lg shadow-black/30">
                ZV
            </div>
            <h1 class="text-2xl font-semibold text-white tracking-tight">Executive Dashboard</h1>
            <p class="text-sm text-old-mustard-yellow-400 mt-1">ZOW Vetique Kemang</p>
        </div>

        <div class="bg-carob-50 rounded-2xl shadow-2xl shadow-black/40 border border-old-mustard-yellow-800/30 p-6 sm:p-8">
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('executive.login.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-carob-700 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-lg border border-carob-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-old-mustard-yellow-500 focus:border-transparent">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-carob-700 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-lg border border-carob-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-old-mustard-yellow-500 focus:border-transparent">
                </div>
                <label class="flex items-center gap-2 text-sm text-carob-600">
                    <input type="checkbox" name="remember" class="rounded border-carob-300 text-old-mustard-yellow-600 focus:ring-old-mustard-yellow-500">
                    Ingat saya
                </label>
                <button type="submit"
                    class="w-full rounded-lg bg-deep-cocoa-brown-900 hover:bg-deep-cocoa-brown-800 text-old-mustard-yellow-400 text-sm font-semibold py-2.5 transition-colors">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
