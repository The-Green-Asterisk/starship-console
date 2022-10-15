<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function read()
    {
        $this->read = !$this->read;
        $this->save();

        $archived = $this->archived;
        $read = $this->read;

        return compact('archived', 'read');
    }

    public function archive()
    {
        $this->archived = !$this->archived;
        $this->save();

        $archived = $this->archived;
        $read = $this->read;

        return compact('archived', 'read');
    }
}
