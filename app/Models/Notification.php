<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function read()
    {
        $this->read = ! $this->read;
        $this->date_read = new DateTime();
        $this->save();
    }

    public function archive()
    {
        $this->archived = ! $this->archived;
        $this->date_archived = new DateTime();
        $this->save();
    }
}
