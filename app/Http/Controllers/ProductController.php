<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyForm;
use App\Http\Requests\CommentForm;
use App\Http\Requests\DeleteCommentsRequest;
use App\Mail\BuyMail;
use App\Models\Comment;
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

    public function createComment($id, CommentForm $request)
    {
        $data = $request->only(["text","user_id"]);
        $product = Product::findOrFail($id);

        $product->comments()->create(["user_id" => $data['user_id'], "product_id" => $id, "text" => $data['text']]);
        return redirect(route("products.show", $id));
    }

    public function deleteComment($id, DeleteCommentsRequest $request)
    {
        $comment = Comment::findOrFail($id);
        $productId = $comment['product_id'];
        if (auth("web")->id() === $comment->user_id)
        {
            $comment->destroy($id);
            return redirect(route("products.show", $productId));
        }

        return back()->withErrors("У вас нет прав для выполнения данной команды");
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
