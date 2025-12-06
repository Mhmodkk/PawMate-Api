<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'sometimes|string|max:25',
            'type'=>'sometimes|string',
            'age'=>'sometimes|integer',
            'gender'=>'sometimes|string',
            'description'=>'sometimes|nullable|string',
            'is_adopted'=>'sometimes|string'
        ];
    }
}
