<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['team_id', 'name'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}