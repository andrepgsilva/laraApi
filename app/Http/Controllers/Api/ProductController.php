<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Controllers\Api\BaseController;

class ProductController extends BaseController
{
    public function index(Product $products)
    {
        return $this->sendResponse(
            $products->all(), 
            'Products successfully fetched'
        );
    }

    public function show(Product $product)
    {
        if (! $product) {
            return $this->sendError('Product not found');
        }

        return $this->sendResponse(
            $product->toArray(),
            'Product successfully fetched'
        );
    }

    public function store(StoreProduct $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);
        return $this->sendResponse(
            Product::create($validated)->toArray(),
            'Product Created successfully'
        );
    }

    public function update(StoreProduct $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        return $this->sendResponse(
            $product->toArray(), 
            'Product update successfully'
        );
    }

    public function delete(Product $product)
    {
        $product->delete();

        return $this->sendResponse(
            $product->toArray(),
            'Product deleted successfully'
        );
    }
}
