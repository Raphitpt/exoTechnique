<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    public function types()
    {
        return $this->belongsTo(Type::class);
    }

    public function races()
    {
        return $this->belongsTo(Race::class);
    }
}
