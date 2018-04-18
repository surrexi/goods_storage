<?php

namespace App\Http\Controllers\Api\V1;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Product[]
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Product
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return Product
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Product
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return null
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->goodsCells as $goodsCell) {
            $goodsCell->delete();
        }
        $product->delete();
        return null;
    }
}
