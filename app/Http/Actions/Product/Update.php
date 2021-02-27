<?php

namespace App\Http\Actions\Product;

use App\Entity\Product;
use App\Http\Actions\ApiResponsesTrait;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Resources\ProductResource;
use App\UseCases\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

            return $this->success(new ProductResource($data));
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            return $this->error($e->getMessage());
        }
    }
}
