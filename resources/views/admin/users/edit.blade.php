@extends('layout.admin')

@section('title', 'Редактировать пользователя')
@section('content')

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Редактирование пользователя {{ $user->name }}, ID {{ $user->id }}</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form enctype="multipart/form-data" method="POST" action="{{ route("admin.users.update", $user->id) }}" class="space-y-5 mt-5">
                @csrf

                @method('PUT')
                <input name="name" type="text" value="{{ $user->name }}" class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-500 @enderror" placeholder="Название" />

                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="text" value="{{ $user->email }}" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Описание" />

                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
