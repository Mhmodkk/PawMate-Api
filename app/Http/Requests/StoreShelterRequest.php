<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShelterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:50',
            'phone'=>'required|max:15',
            'address'=>'required|string|max:100',
            'email'=>'required|string|email',
            'city'=>'required|string'
        ];
    }
}
