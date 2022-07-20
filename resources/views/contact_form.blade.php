@extends('layout.app')

@section('title', 'Связатся с нами')
@section('content')

    @include('Products.Partials.header')

    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Свяжитесь с нами</h1>

            <form method="POST" action="{{ route("contact_form_process") }}" class="space-y-5 mt-5">
                @csrf

                <input name="email" type="text" class="w-full h-12 border border-gray-800 @error('email') border-red-500 @enderror rounded px-3" placeholder="Email" @if (auth("web")->check() == true) value="{{ Auth::user()->email }}" @endif/>
                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="text" type="text" class="w-full h-12 border border-gray-800 @error('text') border-red-500 @enderror rounded px-3" placeholder="Сообщение" />
                @error('text')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-amber-300 rounded-md text-stone-900 py-3 font-medium">Написать</button>
            </form>
        </div>
    </div>
@endsection
