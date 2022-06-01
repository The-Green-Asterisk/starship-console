<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function starship()
    {
        return $this->belongsTo(Starship::class);
    }

    public function divisions()
    {
        return $this->morphToMany(Division::class, 'divisionable');
    }

    public function getHpPercentage()
    {
        $hp = $this->current_hp;
        $maxHp = $this->max_hp;

        if ($hp > 0) {
            $percentage = ($hp / $maxHp) * 100;
        }else{
            $percentage = 0;
        }

        return $percentage;
    }
}
