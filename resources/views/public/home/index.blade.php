@extends('layouts.public')

@section('content')
    @include('public.home.partials.marquee')
    @include('public.home.partials.hero')
    @include('public.home.partials.statistics')
    
    @vite(['resources/css/public-home.css'])

    @include('public.home.partials.sambutan')
    @include('public.home.partials.program')
    @include('public.home.partials.keunggulan')
    @include('public.home.partials.jenjang')
    @include('public.home.partials.testimoni')
    @include('public.home.partials.faq')
    
    @vite(['resources/js/public-home.js'])

    @include('public.home.partials.popup-ppdb')
@endsection
