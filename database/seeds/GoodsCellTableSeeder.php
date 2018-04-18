<?php

use Illuminate\Database\Seeder;

class GoodsCellTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\GoodsCell', 20)->create();
    }
}
