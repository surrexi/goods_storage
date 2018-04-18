<?php

namespace App\Http\Controllers\Api\V1;

use App\GoodsCell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsCellsController extends Controller
{

    public function show($id)
    {
        return GoodsCell::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $goodCell = GoodsCell::findOrFail($id);
        $goodCell->update($request->all());

        return $goodCell;
    }

    public function store(Request $request)
    {
        $goodCell = GoodsCell::create($request->all());

        return $goodCell;
    }

    public function destroy($id)
    {
        $goodCell = GoodsCell::findOrFail($id);
        $goodCell->delete();

        return null;
    }
}
