<?php

use App\Http\Actions\Product\Search as SearchProductsAction;

Route::post('products/search', [SearchProductsAction::class, 'execute']);
