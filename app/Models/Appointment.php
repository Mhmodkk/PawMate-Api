<?php

namespace App\Models;

use App\Http\Requests\AdoptionRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $table = 'appointments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function adoptionRequest()
    {
        return $this->belongsTo(AdoptionRequest::class);
    }
}
