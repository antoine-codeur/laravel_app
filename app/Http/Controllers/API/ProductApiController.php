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
        $products = Product::with('categories')->get();
        return $products;
    }

    /**
     * Get a specific product by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Product
     */
    public function show($id)
    {
        $product = Product::with('categories')->find($id);
        foreach ($product->categories as $category) {
            $category->makeHidden(['created_at', 'updated_at', 'description']);
        }
        return $product;
    }

    /**
     * Create a new product.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \App\Models\Product
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        // Créez le produit sans les catégories
        $productData = $validatedData;
        unset($productData['categories']);
        $product = Product::create($productData);

        // Associez les catégories au produit
        $product->categories()->attach($validatedData['categories']);

        // Chargez les catégories pour le produit
        $product->load('categories');
        
        // Limitez les détails de la catégorie à id, title et description
        if ($product->categories) {
            foreach ($product->categories as $category) {
                $category->makeHidden(['created_at', 'updated_at', 'pivot', 'description']);
            }
        }

        return response()->json($product, 201);
    }

    /**
     * Update an existing product.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @param  int  $id
     * @return \App\Models\Product
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->validated());
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        $product->load('categories');
        foreach ($product->categories as $category) {
            $category->makeHidden(['created_at', 'updated_at', 'pivot', 'description']);
        }
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