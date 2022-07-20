<div class="px-4 py-8 max-w-xl">
    <div class="bg-white shadow-2xl h-full flex flex-col justify-between">
        <div class="max-h-80">
            <img src=@if ($product->image == 0) "http://placekitten.com/g/1350/900" @else "/storage/products/{{$product->image}}" @endif>
        </div>
        <div class="px-4 py-2 mt-2 bg-white">
            <h2 class="font-bold text-2xl text-gray-800">{{$product->title}}</h2>
            <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                {{$product->description}}<br><br>
                <b>{{$product->price}} Рублей</b>
            </p>
        </div>
        <div>
            <a href="{{ route("products.show", $product->id) }}" class="flex w-full justify-end">
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-b h-full w-full">
                Подробнее
                </button>
            </a>
        </div>
    </div>
</div>
