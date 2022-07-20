<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("created_at", "DESC")->limit(6)->get();

        //dd($products);

        return view('welcome', [
            'products' =>$products,
        ]);
    }
}
