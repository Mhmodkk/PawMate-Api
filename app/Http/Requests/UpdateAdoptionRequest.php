<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdoptionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message'=>'sometimes|string',
            'home_type'=>'sometimes|string',
            'yard_size'=>'sometimes|string',
            'experience'=>'sometimes|string',
            'reason_for_adoption'=>'sometimes|string'
        ];
    }
}
