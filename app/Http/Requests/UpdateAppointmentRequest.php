<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appointment_date'=>'sometimes|date',
            'status'=>'sometimes|in:pending,confirmed,cancelled,completed',
            'notes'=>'nullable|string'
        ];
    }
}
