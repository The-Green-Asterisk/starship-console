<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'starship_id',
        'name',
        'description',
        'weight',
        'volume',
        'quantity',
        'price',
        'job_id',
        'on_board',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function starship()
    {
        return $this->belongsTo(Starship::class);
    }
}
