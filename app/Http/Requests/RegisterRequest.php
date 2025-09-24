<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'fullname' => 'required|string|min:3|max:40',
            'email' => ['required','email','regex:/@gmail\.com$/i','unique:users,email'],
            'password' => 'required|string|min:6|max:12|confirmed',
            'phone' => ['required','string','regex:/^08[0-9]{8,12}$/']
        ];
    }

    public function messages()
    {
        return [
            'email.regex' => 'Email harus berformat @gmail.com',
            'phone.regex' => 'Nomor harus diawali 08 dan angka.'
        ];
    }
}
