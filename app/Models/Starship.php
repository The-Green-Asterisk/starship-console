<?php

namespace App\Models;

use App\Events\HpUpdate;
use App\Http\Livewire\Hp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Starship extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function systems()
    {
        return $this->hasMany(System::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function getMaxHp()
    {
        return $this->systems()->sum('max_hp');
    }

    public function getCurrentHp()
    {
        return $this->systems()->sum('current_hp');
    }

    public function getHpPercentage()
    {
        $hp = $this->getCurrentHp();
        $maxHp = $this->getMaxHp();

        if ($hp > 0) {
            $percentage = ($hp / $maxHp) * 100;
        }else{
            $percentage = 0;
        }

        return $percentage;
    }

    public function takeDamage($damage)
    {
        $response = [];

        if ($this->systems->where('name', 'Shields')->first()->current_hp > 0) $damage = $damage - 15;

        for ($i = 0; $i < $damage ; $i++) {
            $system = $this->systems()->where('current_hp', '>=', 0)->inRandomOrder()->first();
            if ($system == null) continue;
            if ($system->current_hp <= 0) $system->current_hp = 1;
            $system->current_hp--;

            $response[] = [
                'systemId' => $system->id,
                'hp' => $system->getHpPercentage(),
                'current' => $system->current_hp
            ];

            $system->save();
        }
        $response[] = [
            'systemId' => $this->id,
            'hp' => $this->getHpPercentage(),
            'current' => $this->getCurrentHp()
        ];

        HpUpdate::dispatch($response);
    }

    public function resetDamage()
    {
        for ($i = 0; $i < $this->systems()->where('starship_id', $this->id)->count() ; $i++) {
            $system = $this->systems()->where('starship_id', $this->id)->get()[$i];
            $system->current_hp = $system->max_hp;
            $system->save();
        }
    }

    public function index()
    {
        $data = [
            'starship' => $this->first(),
            'divisions' => $this->first()->divisions()->get()
        ];
        return view('index')->with($data);
    }
}
