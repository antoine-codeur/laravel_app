<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

/**
 * Class ProductApiController
 *
 * @package App\Http\Controllers\Api
 */
class ProductApiController extends Controller
{
    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Get a specific product by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Product
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Create a new product.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \App\Models\Product
     */
    public function store(StoreProductRequest $request)
    {
        return Product::create($request->validated());
    }

    /**
     * Update an existing product.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  int  $id
     * @return \App\Models\Product
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->validated());
        return $product;
    }

    /**
     * Delete a product.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
}