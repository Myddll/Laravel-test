@extends('layout.app')

@section('title', 'Главная страница')
@section('content')

    @include('Products.Partials.header')

<div class="w-full container mx-auto">
    <div class="w-full flex content-center justify-center mt-8 font-bold">@yield('title')</div>
    <div class="grid grid-cols-1 md:grid-cols-3 mb-20">
        @foreach($products as $product)
            @include('Products.Partials.products', ["product" => $product])
        @endforeach
    </div>
</div>
@endsection
