<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function systems()
    {
        return $this->morphedByMany(System::class, 'divisionable');
    }

    public function characters()
    {
        return $this->morphedByMany(Character::class, 'divisionable');
    }

    public function starships()
    {
        return $this->morphedByMany(Starship::class, 'divisionable');
    }
}
