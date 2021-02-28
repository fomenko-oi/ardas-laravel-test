<?php

use App\Http\Actions\Product\Delete as DeleteProductAction;
use App\Http\Controllers\ProductsController;
use App\Http\Actions\Product\Create as CreateProductAction;
use App\Http\Actions\Product\Search as SearchProductsAction;
use App\Http\Actions\Product\Update as UpdateProductAction;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::group(['as' => 'products.', 'prefix' => 'products'], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::get('create', [ProductsController::class, 'create'])->name('create');
    Route::get('{product}', [ProductsController::class, 'edit'])->name('edit');

    Route::post('/', [CreateProductAction::class, 'execute'])->name('store');
    Route::delete('{product}', [DeleteProductAction::class, 'execute'])->name('destroy');
    Route::put('{product}', [UpdateProductAction::class, 'execute'])->name('update');
});
