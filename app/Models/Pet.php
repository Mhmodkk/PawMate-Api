<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    
    protected $guarded=['id'];
    protected $table = 'pets';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adoption_requests()
    {
        return $this->hasMany(Adoption::class);
    }

    public function favoriteByUser()
    {
        return $this->belongsToMany(User::class,'favorites');
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
