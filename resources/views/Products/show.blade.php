@extends('layout.app')

@section('title', $product->title)
@section('content')

    @include('Products.Partials.header')
<div>
    <div class="m-auto px-4 py-8 max-w-xl">
        <div class="bg-white shadow-2xl" >
            <div>
                <img src=@if ($product->image == 0) "http://placekitten.com/g/1350/900" @else "/storage/products/{{$product->image}}" @endif>
            </div>
            <div class="px-4 py-2 mt-2 bg-white">
                <h2 class="font-bold text-2xl text-gray-800">{{ $product->title }}</h2>
                <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                    {!! $product->description !!}
                </p>
            </div>
        </div>

        <div class="mt-4">
            <span class="font-bold text-3xl">Цена: {{ $product->price }} Рублей</span>
            <form action="{{ route("buy", $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="font-bold mt-2 py-2 px-4 w-full bg-amber-300 text-lg text-stone-900 shadow-md rounded-lg hover:bg-amber-400">Купить</button>
            </form>
        </div>

        <div>
            <section class="rounded-b-lg mt-4">
                <form action="{{ route("createComment", $product->id) }}" method="POST">
                    @csrf

                    <textarea name="text" class="w-full shadow-inner p-4 border-0 mb-4 rounded-lg focus:shadow-outline text-2xl" placeholder="Ваш комментарий..." spellcheck="false"></textarea>

                    @error('text')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="font-bold py-2 px-4 w-full bg-amber-300 text-lg text-stone-900 shadow-md rounded-lg hover:bg-amber-400">Написать</button>
                </form>

                <div id="task-comments" class="pt-4">
                    @foreach($product->comments as $comment)
                    <div class="bg-white rounded-lg p-3  flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                        <div class="flex flex-row justify-center mr-2">
                            <h3 class="text-amber-600 font-semibold text-lg text-center md:text-left ">{{ $comment->user->name }}</h3>
                        </div>


                        <p style="width: 90%" class="text-stone-900 text-lg text-center md:text-left ">{{ $comment->text }}</p>
                        @if(auth("web")->id() === $comment->user_id)
                            <form action="{{ route("deleteComment", $comment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                            </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</div>
