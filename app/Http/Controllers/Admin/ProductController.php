<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy("created_at", "DESC")->paginate(10);
        return view("admin.products.index", [
            "products" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.create", []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $data = $request->validated();

        if($request->has("image"))
        {
            $imagePath = $request->file("image")->store("/storage/products/");

            $image = $request->file("image");
            $image->store("public/products");

            $data['image'] = str_replace("storage/products//", "", $imagePath);
        }

        Product::create($data);

        return redirect(route("admin.products.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
        //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view("admin.products.edit", [
            "product" => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();

        if($request->has("image"))
        {
            $imagePath = $request->file("image")->store("/storage/products/");

            $image = $request->file("image");
            $image->store("public/products");

            $data['image'] = str_replace("storage/products//", "", $imagePath);
        }

        $product->update($data);
        return redirect(route("admin.products.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect(route("admin.products.index"));
    }
}
