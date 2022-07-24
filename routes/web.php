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



// Роутинги, доступные только зарегестрированным
Route::middleware("auth")->group(function (){
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::post('/products/comment/create/{id}', [\App\Http\Controllers\ProductController::class, 'createComment'])->name('createComment');
    Route::post('/products/comment/delete/{id}', [\App\Http\Controllers\ProductController::class, 'deleteComment'])->name('deleteComment');
    Route::post('/products/buy/{id}', [\App\Http\Controllers\ProductController::class, 'buy'])->name('buy');
    //Route::get('/me', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('me');
});

// Роутинги, доступные только незарегестрированным
Route::middleware("guest")->group(function (){
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');


    Route::get('/forgot', [\App\Http\Controllers\AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot_process', [\App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot_process');
});

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'show'])->name('contacts');

Route::post('/contact_form_process', [\App\Http\Controllers\ContactController::class, 'contactForm'])->name('contact_form_process');





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
