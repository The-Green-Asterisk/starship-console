<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function starship()
    {
        return $this->belongsTo(Starship::class);
    }

    public function divisions()
    {
        return $this->morphToMany(Division::class, 'divisionable');
    }

    public function isCaptain()
    {
        return Starship::where('captain_id', $this->id)->exists();
    }
}
