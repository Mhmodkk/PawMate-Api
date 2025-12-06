<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'type'=>$this->type,
            'gender'=>$this->gender,
            'age'=>$this->age,
            'description'=>$this->description,
            'image'=>$this->image,
            'is_adopted'=>$this->is_adopted,
            'Date'=>$this->created_at->format('Y-m-d')
        ];
    }
}
