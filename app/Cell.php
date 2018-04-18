<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = ['barcode', 'number'];

    public function goodsCells()
    {
        return $this->hasMany('App\GoodsCell');
    }
}
