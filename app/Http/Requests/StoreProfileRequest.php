<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|max:15',
            'address' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'bio' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ];
    }
}
