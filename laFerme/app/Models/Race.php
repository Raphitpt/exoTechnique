<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    public function types()
    {
        return $this->belongsTo(Type::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
