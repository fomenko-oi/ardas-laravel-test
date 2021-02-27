<?php

use App\Http\Actions\Product\Create as CreateProductAction;
use App\Http\Actions\Product\Search as SearchProductsAction;
use App\Http\Actions\Product\Update as UpdateProductAction;

Route::post('products', [CreateProductAction::class, 'execute']);
Route::put('products/{product}', [UpdateProductAction::class, 'execute']);
Route::post('products/search', [SearchProductsAction::class, 'execute']);
