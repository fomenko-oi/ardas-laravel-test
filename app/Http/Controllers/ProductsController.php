<?php

namespace App\Http\Controllers;

use App\Entity\Product;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\ProductsRepository;
use App\UseCases\Product\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    const PRODUCTS_PER_PAGE = 15;

    /**
     * @var ProductsRepository
     */
    private $products;
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var CharacteristicsRepository
     */
    private $characteristics;

    public function __construct(ProductsRepository $products, ProductService $productService, CharacteristicsRepository $characteristics)
    {
        $this->products = $products;
        $this->productService = $productService;
        $this->characteristics = $characteristics;
    }

    public function main()
    {
        return view('app.site.index');
    }

    public function index(Request $request)
    {
        if ($query = $request->input('q')) {
            $products = $this->productService->search($request->input('q'), self::PRODUCTS_PER_PAGE);
        } else {
            $products = $this->products->paginate(self::PRODUCTS_PER_PAGE);
        }

        return view('app.products.index', compact('query', 'products'));
    }

    public function edit(Product $product)
    {
        $product->load('characteristicValues');

        $characteristics = $this->characteristics->findAll();

        return view('app.products.edit', compact('product', 'characteristics'));
    }

    public function create()
    {
        $characteristics = $this->characteristics->findAll();

        return view('app.products.create', compact('characteristics'));
    }
}
