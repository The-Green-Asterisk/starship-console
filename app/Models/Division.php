<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function starship()
    {
        return $this->belongsTo(Starship::class);
    }
    public function systems()
    {
        return $this->hasMany(System::class);
    }
}
