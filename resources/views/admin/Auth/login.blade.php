@extends('layout.app')

@section('title', 'Авторизация')
@section('content')

    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-stone-900 font-medium">Вход</h1>

            <form action="{{route("admin.login_process")}}" method="POST" class="space-y-5 mt-5">
                @csrf
                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror


                <div class="flex justify-between">
                    <a href="{{ route("home") }}" class="font-medium text-amber-600 hover:bg-amber-100 rounded-md p-2">Главная</a>
                </div>



                <button type="submit" class="text-center text-stone-900 w-full bg-amber-300 rounded-md py-3 font-medium">Войти</button>
            </form>
        </div>
    </div>
@endsection
