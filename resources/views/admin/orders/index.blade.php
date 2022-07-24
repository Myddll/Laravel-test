@extends('layout.admin')

@section('title', 'Заказы')
@section('content')

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Заказы</h3>


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ID, Имя пользователя, Название товара, Количество, Цена, Дата</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap w-full border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">ID: {{ $order->id }}</div>
                                    <div class="text-sm leading-5 text-gray-900">Имя пользователя: {{ $order->user->name }}</div>
                                    <div class="text-sm leading-5 text-gray-900">Название товара: {{ $order->product->title }}</div>
                                    <div class="text-sm leading-5 text-gray-900">Количество: {{ $order->amount }}</div>
                                    <div class="text-sm leading-5 text-gray-900">Цена: {{ $order->price }}</div>
                                    <div class="text-sm leading-5 text-gray-900">Дата: {{ $order->created_at }}</div>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
