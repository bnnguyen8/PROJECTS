<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Menu\MenuService;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;

    public function __construct(ProductService $productService, MenuService $menuService)
    {
        $this->productService = $productService;
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getAll($request);
        return view('products.index', [
            'title' => "List of all products",
            'products' => $products,
            'menuProduct' => $this->menuService->getAll(),
            'cat' => $request->input('cat') != null ? $request->input('cat') : 0,
        ]);
    }

    public function detail($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id, $product->menu_id);

        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productsMore
        ]);
    }
}
