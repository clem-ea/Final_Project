<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string|min:10|max:100',
            'postal_code' => ['required','regex:/^[0-9]{5}$/']
        ];
    }

    public function messages()
    {
        return [
            'postal_code.regex' => 'Kode pos harus 5 digit angka'
        ];
    }
}
