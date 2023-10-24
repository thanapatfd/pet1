<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';

    public function type() {
        return $this->belongsTo('App\Models\Type');
    }

    
}
