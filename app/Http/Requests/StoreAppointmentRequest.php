<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'=>'required|exists:users,id',
            'pet_id'=>'required|exists:pets,id',
            'adoption_request_id'=>'nullable|exists:adoption_requests,id',
            'appointment_date'=>'required|date',
            'status'=>'in:pending,confirmed,cancelled|completed'
        ];
    }
}
