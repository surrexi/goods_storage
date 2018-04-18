<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::resource('products', 'ProductsController', ['except' => ['create', 'edit']]);
    Route::resource('cells', 'CellsController', ['except' => ['create', 'edit']]);
    Route::resource('goods-cells', 'GoodsCellsController', ['except' => ['index', 'create', 'edit']]);
});
