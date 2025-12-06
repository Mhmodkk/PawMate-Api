<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicPetRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:25',
            'type'=>'required',
            'age'=>'required|integer',
            'gender'=>'required',
            'description'=>'nullable|string',
            'is_adopted'=>'required',
            'shelter_id'=>'required',
            
        ];
    }
}
