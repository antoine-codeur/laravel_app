<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryApiController
 *
 * @package App\Http\Controllers\Api
 */
class CategoryApiController extends Controller
{
    /**
     * Get all categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Get a specific category by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Category
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $category->load('products');
    }

    /**
     * Create a new category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Category
     */
    public function store(Request $request)
    {
        return Category::create($request->all());
    }

    /**
     * Update an existing category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Models\Category
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return $category;
    }

    /**
     * Delete a category.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return Category::destroy($id);
    }
}