@extends('layout.app')

@section('title', 'Регистрация')
@section('content')

    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-stone-900 font-medium">Регистрация</h1>

            <form action="{{ route("register_process") }}" method="POST" class="space-y-5 mt-5">
                @csrf
                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Name" />

                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="email" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-500 @enderror" placeholder="Подтверждение пароля" />

                @error('password_confirmation')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="flex justify-between">
                    <a href="{{ route("login") }}" class="font-medium text-amber-600 hover:bg-amber-100 rounded-md p-2">Есть аккаунт?</a>
                    <a href="{{ route("home") }}" class="font-medium text-amber-600 hover:bg-amber-100 rounded-md p-2">Главная</a>
                </div>

                <button type="submit" class="text-center w-full bg-amber-300 rounded-md text-stone-900 py-3 font-medium">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
