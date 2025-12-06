<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicPet extends Model
{
    protected $guarded=['id'];
    protected $table = 'publicpets';

    public function adoption_requests()
    {
        return $this->hasMany(Adoption::class);
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
