<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function races()
    {
        return $this->hasMany(Race::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
