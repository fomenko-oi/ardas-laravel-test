<?php

use App\Http\Actions\Product\Delete as DeleteProductAction;
use App\Http\Controllers\SiteController;
use App\Http\Actions\Product\Create as CreateProductAction;
use App\Http\Actions\Product\Search as SearchProductsAction;
use App\Http\Actions\Product\Update as UpdateProductAction;

// TODO RENAME
Route::get('/', [SiteController::class, 'main'])->name('index');

Route::group(['as' => 'products.', 'prefix' => 'products'], function() {
    Route::get('/', [SiteController::class, 'index'])->name('index');
    Route::get('create', [SiteController::class, 'create'])->name('create');
    Route::get('{product}', [SiteController::class, 'edit'])->name('edit');

    Route::post('/', [CreateProductAction::class, 'execute'])->name('store');
    Route::delete('{product}', [DeleteProductAction::class, 'execute'])->name('destroy');
    Route::put('{product}', [UpdateProductAction::class, 'execute'])->name('update');
});
