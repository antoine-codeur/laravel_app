<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        try {
            $validatedData = $request->validated();

            // Log the validated data
            Log::info('Validated data: ', $validatedData);

            // Create the product without the categories
            $productData = $validatedData;
            unset($productData['categories']);

            // Handle the image
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $productData['image'] = $path;
            }

            $product = Product::create($productData);

            // Log the created product
            Log::info('Created product: ', $product->toArray());

            // Associate the categories with the product
            if (isset($validatedData['categories'])) {
                $categories = $validatedData['categories'];
                if (is_array($categories)) {
                    $product->categories()->sync($categories);
                }
            }

            // Load the categories for the product
            $product->load('categories');

            return $product;

        } catch (\Exception $e) {
            Log::error('Failed to create product: ', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create product'], 500);
        }
    }

    /**
     * Update an existing product.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @param  int  $id
     * @return \App\Models\Product
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the product
            $product = Product::findOrFail($id);

            // Check if a new image was uploaded
            if ($request->hasFile('image')) {
                // Delete the old image
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                // Store the new image
                $product->image = $request->file('image')->store('images', 'public');
            }

            // Update other product attributes
            $product->name = $request->input('name', $product->name);
            $product->description = $request->input('description', $product->description);
            $product->price = $request->input('price', $product->price);
            $product->stock = $request->input('stock', $product->stock);

            // Save the product
            $product->save();

            return response()->json($product, 200);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error in update method: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while updating the product'], 500);
        }
    }
    /**
     * Delete a product.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        try {
            // Find the product
            $product = Product::findOrFail($id);

            // Delete the image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Delete the product
            $product->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error in destroy method: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while deleting the product'], 500);
        }
    }
}