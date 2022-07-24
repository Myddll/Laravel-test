@extends('Layout.admin')

@section('title', 'Редактировать комментарии')
@section('content')

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Редактирование комментария к товару {{ $comment->product->title }} от пользователя {{ $comment->user->name }}, ID {{ $comment->id }}</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form enctype="multipart/form-data" method="POST" action="{{ route("admin.comments.update", $comment->id) }}" class="space-y-5 mt-5">
                @csrf

                @method('PUT')
                <input name="text" type="text" value="{{ $comment->text }}" class="w-full h-12 border border-gray-800 rounded px-3 @error('text') border-red-500 @enderror" placeholder="Текст комментария..." />

                @error('text')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
