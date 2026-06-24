@extends('layouts.public')

@section('content')

    @include('public.home.partials.hero')
    @include('public.home.partials.statistics')
    
    @vite(['resources/css/public-home.css'])

    @include('public.home.partials.sambutan')
    
    @include('public.home.partials.program')
    @include('public.home.partials.tujuan-pendidikan')
    @include('public.home.partials.jenjang')
    
    {{-- Parallax Window Gap (Small) --}}
    <div class="w-full h-16 md:h-24 lg:h-32 bg-transparent"></div>

    @include('public.home.partials.testimoni')
    @include('public.home.partials.faq')
    
    @vite(['resources/js/public-home.js'])

    @include('public.home.partials.popup-ppdb')
@endsection
