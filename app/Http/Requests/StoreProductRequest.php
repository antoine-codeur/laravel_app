<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}