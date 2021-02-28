<?php

namespace App\Http\Actions\Product;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Resources\ProductResource;
use App\UseCases\Product\ProductService;
use Psr\Log\LoggerInterface;

class Create
{
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ProductService $productService, LoggerInterface $logger)
    {
        $this->productService = $productService;
        $this->logger = $logger;
    }

    public function execute(CreateRequest $request)
    {
        try {
            $product = $this->productService->create(
                $request->input('name'),
                (int)$request->input('price'),
                (array)$request->input('characteristics')
            );

            return redirect()->route('products.index')->with('success', 'Product successful created.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }
}
