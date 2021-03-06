<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'barcode', 'title', 'title_manufacturer'
    ];

    public function goodsCells()
    {
        return $this->hasMany('App\GoodsCell');
    }
}
