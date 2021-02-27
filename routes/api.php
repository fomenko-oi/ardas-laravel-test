<?php

use App\Http\Actions\Product\Create as CreateProductAction;
use App\Http\Actions\Product\Search as SearchProductsAction;
use App\Http\Actions\Product\Update as UpdateProductAction;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('products', [CreateProductAction::class, 'execute']);
Route::put('products/{product}', [UpdateProductAction::class, 'execute']);
Route::post('products/search', [SearchProductsAction::class, 'execute']);
