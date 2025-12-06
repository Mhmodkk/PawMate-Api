<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdoptionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pet_id'=>'required',
            'message'=>'required|string',
            'home_type'=>'required|string',
            'yard_size'=>'required|string',
            'experience'=>'required|string',
            'reason_for_adoption'=>'required|string'
        ];
    }
}
