@extends('layout.app')

@section('title', 'Восстановление пароля')
@section('content')

    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-stone-900 font-medium">Восстановление пароля</h1>

            <form action="{{route("reset_password_process", $token->token)}}" method="POST" class="space-y-5 mt-5">
                @csrf
                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-500 @enderror" placeholder="Подтверждение пароля" />

                @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center text-stone-900 w-full bg-amber-300 rounded-md py-3 font-medium">Восстановить пароль</button>
            </form>
        </div>
    </div>
@endsection
