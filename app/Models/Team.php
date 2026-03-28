<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'livery_image_path'];

    // Ito yung hinahanap ng seeder natin!
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}