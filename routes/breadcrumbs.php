<?php

use App\Entity\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('index', function ($crumbs) {
    $crumbs->push('Main page', route('index'));
});

// products
Breadcrumbs::for('products.index', function ($crumbs) {
    $crumbs->push('Products List', route('products.index'));
});

Breadcrumbs::for('products.create', function ($crumbs) {
    $crumbs->parent('products.index');
    $crumbs->push('New product', route('products.create'));
});

Breadcrumbs::for('products.edit', function ($crumbs, Product $product) {
    $crumbs->parent('products.index');
    $crumbs->push("Editing: {$product->name}", route('products.edit', $product));
});

