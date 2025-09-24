<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize() { return auth()->user() && auth()->user()->role === 'admin'; }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer|min:0', // store integer rupiah
            'quantity' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:2048' // 2MB
        ];
    }
}
