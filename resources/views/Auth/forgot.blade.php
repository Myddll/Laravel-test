@extends('layout.app')

@section('title', 'Восстановление пароля')
@section('content')

    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Восстановление пароля</h1>

            <form method="POST" action="{{ route("forgot_process") }}" class="space-y-5 mt-5">
                @csrf
                <input name="email" type="text" class="w-full h-12 border @error('email') border-red-500 @enderror rounded px-3" placeholder="Email" />

                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <a href="{{ route("login") }}" class="font-medium text-amber-600 hover:bg-amber-100 rounded-md p-2">Вспомнил пароль</a>
                </div>

                <button type="submit" class="text-center w-full bg-amber-300 rounded-md text-stone-900 py-3 font-medium">Восстановить</button>
            </form>
        </div>
    </div>
@endsection
