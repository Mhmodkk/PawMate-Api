<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShelterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'sometimes|string|max:50',
            'phone'=>'sometimes|max:15',
            'address'=>'sometimes|string|max:100',
            'email'=>'sometimes|string|email',
            'city'=>'sometimes|string'
        ];
    }
}
