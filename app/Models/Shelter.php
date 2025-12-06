<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;
    
    protected $guarded=['id'];
    protected $table = 'shelters';
    public function publicpets()
    {
        return $this->hasMany(Pet::class);
    }

}
