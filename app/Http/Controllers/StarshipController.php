<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStarshipRequest;
use App\Http\Requests\UpdateStarshipRequest;
use App\Models\Character;
use App\Models\Division;
use App\Models\Starship;
use App\Models\System;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
        $starship->dm_id = auth()->id();
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

        $character = Character::where('user_id', auth()->user()->id)->where('is_active', true)->first();

        return view('starship.show', compact('divisions', 'starship', 'character'));
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
    public function update(UpdateStarshipRequest $request)
    {
        Starship::where('id', $request->starship_id)->update([
            'name' => $request->name,
            'model' => $request->model,
            'manufacturer' => $request->manufacturer,
            'captain_id' => $request->captain_id,
        ]);

        return back()->with('success', 'Starship updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $starship = Starship::find($request->starship);
        $newStarship = Starship::find($request->newStarship);

        $crew = Character::where('starship_id', $starship->id)->get();
        foreach ($crew as $member) {
            $member->starship_id = $newStarship->id;
            $member->save();
        }
        $starship->divisions()->detach();
        foreach ($starship->systems as $system) {
            $system->divisions()->detach();
        }
        $starship->systems()->delete();
        $starship->delete();

        return back()->with('success', 'Starship deleted!');
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
                'description' => 'This sophisticated navigation system keeps real-time records of your starship\'s position and velocity. It also provides a means of determining the distance and most efficient route to any given target. With navigation systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances greater than one AU.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Steering',
                'description' => 'The steering system determines the direction of your starship\'s thrust. It allows the pilot to make fine adjustments to the ships\'s more immediate course and speed. With steering systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances less than one AU or dodging danger.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Thrusters',
                'description' => 'The thrusters are gravity-based engines that allow your starship to travel at speeds less than the speed of light. With thrusters at 25% or less, the starship is unable to move on its own power.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'GravRing Sync',
                'description' => 'The GravRing Sync synchronizes the ship\'s navigation system with the nearest GravRing. The larger GravRing system uses the navigation calculations to generate a wormhole portal to the desired destination. With the GravRing Sync system at 25% or less, the pilot will be unable to access the GravRing system and will not be able to travel any faster than the speed of light.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Computer Core',
                'description' => 'The computer core is used to store and process data. With the computer core at 25% or less, the crew have disadvantage operating any system that requires calculations.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Sensors',
                'description' => 'The sensors are used to detect and track objects and other ships. They are also used to determine the distance and direction to any given target. With sensors at 25% or less, the crew have disadvantage on perception checks utilizing the ship\'s systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Cargo Hold',
                'description' => 'The cargo hold is used to store and transport cargo. It is also used to store and transport passengers. With the cargo hold at 25% or less, the interior doors to the hold will be locked until the hull can be repaired and re-pressurized and there is a 50% chance the cargo is lost.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Grapplers',
                'description' => 'The grapplers are used to hold and release objects. With grapplers at 25% or less, the crew will be unable to manipulate exterior objects in space.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Fusion Beams',
                'description' => 'Ranged Weapon Attack: +6 to hit, one target. Hit: 3d10 piercing damage. When the fusion beams are at 25% or less, the ship is unable to fire them.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Heavy Lasers',
                'description' => 'Ranged Weapon Attack: +5 to hit, one target. Hit: 5d10 bludgeoning damage. When the heavy lasers are at 25% or less, the ship is unable to fire them.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Shields',
                'description' => 'The shields are used to protect the ship from damage. Shields automatically subtract 15 points of damage from a hit\'s total. With shields at 25% or less, this protection is no longer offered.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Targeting',
                'description' => 'The targeting system is used to determine the direction and distance to any given target. With targeting systems at 25% or less, the crew have disadvantage on any ship\'s weapons attacks.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Air Scrubbers',
                'description' => 'The air scrubbers are used to filter and clean the ship\'s air circulation. With air scrubbers at 25% or less, the crew will be unable to sleep soundly on the ship and will gain 1 exhaustion point per long rest.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Medical Bay',
                'description' => 'The medical bay is used to store and utilize medical equipment. With the medical bay at 25% or less, the crew will have disadvantage on any medical checks or healing spells used within the ship.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'O2 Tanks',
                'description' => 'The O2 tank are used to store and distribute breathable air. With O2 tanks at 25% or less, the crew will have 24 hours to repair them before they run out of air.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Food Storage',
                'description' => 'The food storage system holds and preserves food for the crew. With the food storage system at 25% or less, the food will go bad and the crew will go hungry until replenished.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Plumbing',
                'description' => 'The plumbing system is used to maintain and repair the ship\'s plumbing. With plumbing systems at 25% or less, the crew will have disadvantage repairing any of the ship\'s systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Main Engine',
                'description' => 'The main engine is used to power the ship\'s thrusters. With the main engine at 25% or less, the ship will be unable to move.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Power Generator',
                'description' => 'The power generator is used to power the ship\'s systems. With the power generator at 25% or less, the crew will have disadvantage utilizing any of of the ship\'s systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Power Distribution',
                'description' => 'The power distribution system is used to distribute power to the ship\'s systems. With power distribution systems at 25% or less, the crew will have disadvantage utilizing any of the ship\'s systems and will be blinded within the ship while the lights are out.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Drone Control',
                'description' => 'The drone control system is used to control the ship\'s drones. With drone control systems at 25% or less, the drones are unable to be controlled remotely.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Networking',
                'description' => 'The networking system connects the computer core to the internet. It connects to the galactic internet through a series photonic signals that also sync with the GravRings. A skilled mage can use the networking system to hack into remote systems. With the computer core at 25% or less, the crew will not be able to access any new data or remote systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Radio Transceiver',
                'description' => 'The radio transceiver is used to communicate with other ships. With the radio transceiver at 25% or less, the crew will have disadvantage communicating with other ships.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Laser Transceiver',
                'description' => 'The laser transceiver is used to communicate with laser receivers on planet surfaces. With the laser transceiver at 25% or less, the crew will have disadvantage communicating with planet surfaces.',
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
