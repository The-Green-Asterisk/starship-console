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

    public function dm()
    {
        return $this->belongsTo(User::class, 'dm_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function systems()
    {
        return $this->hasMany(System::class);
    }

    public function divisions()
    {
        return $this->morphToMany(Division::class, 'divisionable');
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
        $pilotDamage = 0;
        $opsDamage = 0;
        $defDamage = 0;
        $lifeDamage = 0;
        $engDamage = 0;
        $commsDamage = 0;

        if ($this->systems->where('name', 'Shields')->first()->getHpPercentage() > 25) $damage = $damage - 15;

        for ($i = 0; $i < $damage ; $i++) {
            $system = $this->systems()->inRandomOrder()->first();
            if ($system->getHpPercentage() < 25) {
                if ($system->divisions()->first()->id == 1) $pilotDamage++;
                if ($system->divisions()->first()->id == 2) $opsDamage++;
                if ($system->divisions()->first()->id == 3) $defDamage++;
                if ($system->divisions()->first()->id == 4) $lifeDamage++;
                if ($system->divisions()->first()->id == 5) $engDamage++;
                if ($system->divisions()->first()->id == 6) $commsDamage++;
            }
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
            'current' => $this->getCurrentHp(),
            'officerDamage' => view('modals.officer-damage', [
                'pilot' => $pilotDamage,
                'ops' => $opsDamage,
                'def' => $defDamage,
                'life' => $lifeDamage,
                'eng' => $engDamage,
                'comms' => $commsDamage
            ])->render()
        ];

        if (auth()->user()->characters->where('is_active', true)->first()->starship->id == $this->id || $this->dm_id == auth()->user()->id) {
            HpUpdate::dispatch($response);
        }
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
