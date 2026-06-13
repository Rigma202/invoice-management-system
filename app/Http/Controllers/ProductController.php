<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->store(
            $request->validated()
        );

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully'
        ]);
    }

    public function edit(int $id)
    {
        $product = $this->productService->find($id);

        return view('product.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request,Product $product)
    {
        $this->productService->update(
            $product->id,
            $request->validated()
        );

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $result = $this->productService->delete(
            $id,
            $request->force_delete ?? false
        );

        return response()->json($result);
    }
}
