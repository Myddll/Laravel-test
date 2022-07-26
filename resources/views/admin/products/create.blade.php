@extends('layout.admin')

@section('title', 'Добавить товары')
@section('content')

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Добавить новый товар</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form enctype="multipart/form-data" method="POST" action="{{ route("admin.products.store") }}" class="space-y-5 mt-5">
                @csrf
                <input name="title" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('title') border-red-500 @enderror" placeholder="Название" />

                @error('title')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="description" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('description') border-red-500 @enderror" placeholder="Описание" />

                @error('description')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="price" type="number" step="0.01" min="0" class="w-full h-12 border border-gray-800 rounded px-3 @error('price') border-red-500 @enderror" placeholder="Стоимость" />

                @error('price')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="image" type="file" class="w-full h-12" value="0" placeholder="Обложка" />

                @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
