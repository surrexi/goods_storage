<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsCell extends Model
{
    protected $fillable = ['product_amount'];

    public function cell()
    {
        return $this->belongsTo('App\Cell');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
