<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware("guest:admin")->group(function () {
    Route::get("login", [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name("login");
    Route::post("login_process", [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name("login_process");
});

Route::middleware("auth:admin")->group(function () {
    Route::resource("products", \App\Http\Controllers\Admin\ProductController::class);
    Route::resource("users", \App\Http\Controllers\Admin\UserController::class);
    Route::get("logout", [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name("logout");
});







//Route::get('/', function () {
//    $orders = \App\Models\Order::all();
//
//    foreach ($orders as $order)
//    {
//        echo "{$order['id']}<br>";
//        echo "{$order->user['email']}<br>";
//        echo "{$order->products['title']}<br>";
//        echo "{$order['amount']}<br>";
//        echo "{$order['price']}<br>";
//        echo "{$order['created_at']}<br>";
//        echo "{$order['updated_at']}<br>";
//    }
//});
