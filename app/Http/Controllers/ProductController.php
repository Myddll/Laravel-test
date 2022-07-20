<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyForm;
use App\Http\Requests\CommentForm;
use App\Mail\BuyMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderBy("created_at", "DESC")->paginate(6);


        //dd($products->links());

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        //dd(1);
        $product = Product::findOrFail($id);
        return view('products.show', [
            'product' => $product,
        ]);
    }

    public function comment($id, CommentForm $request)
    {
        $data = $request->only(["text","user_id"]);
        $product = Product::findOrFail($id);

        $product->comments()->create(["user_id" => $data['user_id'], "product_id" => $id, "text" => $data['text']]);
        return redirect(route("products.show", $id));
    }

    public function buy($id, BuyForm $request)
    {
        $data = $request->only(["user_id"]);
        $product = Product::findOrFail($id);

        $user = Auth::user();

        $message = [
            'name' => $user->name,
            'title' => $product->title,
            'price' => $product->price,
        ];
        $product->orders()->create(["user_id" => $data['user_id'], "product_id" => $id, "amount" => '1', "price" => $product->price]);
        Mail::to($user->email)->send(new BuyMail($message));
        return redirect(route("products.show", $id));
    }
}
