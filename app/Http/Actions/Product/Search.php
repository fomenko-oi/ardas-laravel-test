<?php

namespace App\Http\Actions\Product;

use App\Http\Actions\ApiResponsesTrait;
use App\Http\Requests\Product\SearchRequest;
use App\Http\Resources\ProductResource;
use App\UseCases\Product\ProductService;
use Psr\Log\LoggerInterface;

class Search
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

    public function execute(SearchRequest $request)
    {
        try {
            $products = $this->productService->search($request->input('q'));

            return $this->success(ProductResource::collection($products));
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            return $this->error($e->getMessage());
        }
    }
}
