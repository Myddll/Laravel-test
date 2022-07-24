@extends('layout.admin')

@section('title', 'Редактировать товары')
@section('content')

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Редактирование товара {{ $product->title }}, ID {{ $product->id }}</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form enctype="multipart/form-data" method="POST" action="{{ route("admin.products.update", $product->id) }}" class="space-y-5 mt-5">
                @csrf

                @method('PUT')
                <input name="title" type="text" value="{{ $product->title }}" class="w-full h-12 border border-gray-800 rounded px-3 @error('title') border-red-500 @enderror" placeholder="Название" />

                @error('title')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="description" type="text" value="{{ $product->description }}" class="w-full h-12 border border-gray-800 rounded px-3 @error('description') border-red-500 @enderror" placeholder="Описание" />

                @error('description')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="price" type="number" value="{{ $product->price }}" step="0.01" min="0" class="w-full h-12 border border-gray-800 rounded px-3 @error('price') border-red-500 @enderror" placeholder="Стоимость" />

                @error('price')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <img class="h-64 w-64" src="@if($product->image == 0) http://placekitten.com/g/1350/900 @endif @if(!$product->image == 0) /storage/products/{{$product->image}} @endif">
                </div>

                <input name="image" type="file" class="w-full h-12" placeholder="Обложка" />

                @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
