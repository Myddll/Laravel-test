<div class="w-full bg-amber-300">
    <nav class="w-full font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 sm:items-baseline w-full container mx-auto">
        <div class="mb-2 sm:mb-0 inner">

            <a href="{{ route("home") }}" class="text-2xl no-underline text-stone-900 font-sans font-bold">Laravel магазин</a><br>
            <span class="text-xs text-grey-dark">Покупай легче!</span>

        </div>

        <div class="sm:mb-0 self-center">
            <a href="{{ route("products.index") }}" class="text-md no-underline text-stone-900 hover:text-stone-500">Товары</a>
            <a href="{{ route("contacts") }}" class="ml-2 text-md no-underline text-stone-900 hover:text-stone-500">Связатся с нами</a>
        </div>
        <div class="sm:mb-0 self-center">

            @auth("web")
                Привет, <b>{{ auth("web")->user()->name }}</b>! <a href="{{ route("logout") }}" class="text-md no-underline text-stone-900 hover:text-stone-500">Выйти?</a>
            @endauth
            @guest("web")
                <a href="{{ route("login") }}" class="text-md no-underline text-stone-900 hover:text-stone-500">Войти</a>
            @endguest()
        </div>
    </nav>
</div>
