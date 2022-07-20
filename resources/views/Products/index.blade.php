@extends('layout.app')

@section('title', 'Все товары')
@section('content')

    @include('Products.Partials.header')

<div class="w-full">
    <div class="w-full flex content-center justify-center mt-8 font-bold">@yield('title')</div>
    <div class="grid grid-cols-1 md:grid-cols-3 mb-10 container mx-auto">
        @foreach($products as $product)
            @include('Products.Partials.products', ["product" => $product])
        @endforeach

    </div>
    <div class="w-full">
        <div class="container mx-auto mb-4">{{ $products->links() }}</div>
    </div>
</div>
@endsection
