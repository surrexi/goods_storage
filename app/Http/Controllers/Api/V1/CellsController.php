<?php

namespace App\Http\Controllers\Api\V1;

use App\Cell;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Cell[]
     */
    public function index()
    {
        $cells = Cell::all();
        foreach ($cells as $cell) {
            $cell->goodsCells;
        }
        return $cells;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Cell
     */
    public function show($id)
    {
        $cell = Cell::findOrFail($id);

        $productIds = [];
        foreach ($cell->goodsCells as $goodsCell) {
            $goodsCell->product;
            $productIds[] = $goodsCell->product->id;
        }
        $cell->productsNotInCell = $this->productsNotInCell($productIds);

        return $cell;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return Cell
     */
    public function update(Request $request, $id)
    {
        $cell = Cell::findOrFail($id);
        $cell->update($request->all());
        return $cell;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Cell
     */
    public function store(Request $request)
    {
        $cell = Cell::create($request->all());

        return $cell;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return null
     */
    public function destroy($id)
    {
        $cell = Cell::findOrFail($id);
        foreach ($cell->goodsCells as $goodsCell) {
            $goodsCell->delete();
        }
        $cell->delete();
        return null;
    }


    private function productsNotInCell($product_ids) {
        return Product::whereNotIn('id', $product_ids)->get(['id', 'title']);
    }
}
