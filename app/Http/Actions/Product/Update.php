<?php

namespace App\Http\Actions\Product;

use App\Entity\Product;
use App\Http\Actions\ApiResponsesTrait;
use App\Http\Requests\Product\CreateRequest;
use App\UseCases\Product\ProductService;
use Psr\Log\LoggerInterface;

class Update
{
    use ApiResponsesTrait;

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

    public function execute(CreateRequest $request, Product $product)
    {
        try {
            $data = $this->productService->update(
                $product->id,
                $request->input('name'),
                (int)$request->input('price'),
                (array)$request->input('characteristics')
            );

            return redirect()->route('products.index')->with('success', 'Product successful updated.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }
}
