<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStarshipRequest;
use App\Http\Requests\UpdateStarshipRequest;
use App\Models\Division;
use App\Models\Starship;
use App\Models\System;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class StarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStarshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStarshipRequest $request)
    {
        $starship = new Starship();
        $starship->name = $request->name;
        $starship->model = $request->model;
        $starship->manufacturer = $request->manufacturer;
        $starship->captain_id = $request->captain_id;
        $starship->save();
        $this->addDefaultSystems(Starship::find($starship->id));

        User::find(auth()->user()->id)->starships()->attach(Starship::find($starship->id));

        return back()->with('success', 'Starship created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function show($starship)
    {
        if ($starship == 0) {
            return back()->with('success', 'Please create ' . (auth()->user()->is_dm == false ? 'or have your DM assign you' : true) . ' a starship.');
        }

        $starship = Starship::find($starship);

        $divisions = Division::whereHas('starships', function (Builder $query) use ($starship) {
            $query->where('id', $starship->id);
        })->get();

        for ($i = 0; $i < count($divisions); $i++) {
            $divisions[$i]->systems = System::where('starship_id', $starship->id)->whereHas('divisions', function (Builder $query) use ($divisions, $i) {
                $query->where('division_id', $divisions[$i]->id);
            })->get();
        }

        return view('starship.show', compact('divisions', 'starship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function edit(Starship $starship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStarshipRequest  $request
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStarshipRequest $request, Starship $starship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Starship $starship)
    {
        //
    }

    public function takeDamage(Starship $starship, $damage)
    {
        $starship->takeDamage($damage);
    }

    public function resetDamage(Starship $starship)
    {
        $starship->resetDamage();

        return redirect()->back();
    }

    public function addDefaultSystems(Starship $starship)
    {
        System::insert([
            [
                'starship_id' => $starship->id,
                'name' => 'Navigation',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Steering',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Thrusters',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'GravRing Sync',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Computer Core',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Sensors',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Cargo Hold',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Grapplers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Fusion Beams',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Heavy Lasers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Shields',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Targeting',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Air Scrubbers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Lighting',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'O2 Tanks',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Food Storage',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Plumbing',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Main Engine',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Power Generator',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Power Distribution',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Drone Control',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Networking',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Radio Transceiver',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Laser Transceiver',
                'max_hp' => 15,
                'current_hp' => 15
            ]
        ]);


        for($i = 0; $i < $starship->systems->count(); $i++) {
            $starship->systems->get($i)->divisions()->attach(ceil(($i +1) / 4));
        }
        $starship->systems->get(16)->divisions()->attach(4);
        $starship->systems->get(16)->divisions()->detach(5);
        $starship->systems->get(20)->divisions()->attach(6);
        $starship->systems->get(20)->divisions()->detach(5);

        for ($i = 0; $i < Division::all()->count(); $i++) {
            $starship->divisions()->attach($i + 1);
        }

        $starship->save();
      }

    public function makeActive(Starship $starship)
    {
        $character = auth()->user()->characters->where('is_active', true)->first();
        $character->starship_id = $starship->id;
        $character->save();

        return back()->with('success', $character->name . ' is now aboard the ' . $starship->name . '!');
    }
}
