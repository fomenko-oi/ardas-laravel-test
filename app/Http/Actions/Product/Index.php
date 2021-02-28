<?php

namespace App\Http\Actions\Product;

use App\Http\Actions\ApiResponsesTrait;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductsRepository;
use App\UseCases\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

class Index
{
    /**
     * @var ProductsRepository
     */
    private $products;
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductsRepository $products, ProductService $productService)
    {
        $this->products = $products;
        $this->productService = $productService;
    }

    public function execute(Request $request)
    {
        if ($query = $request->input('q')) {
            $products = $this->productService->search($request->input('q'));
        } else {
            $products = $this->products->paginate();
        }

        return view('app.products.index', compact('query', 'products'));
    }
}
