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

        return redirect('/dm-dashboard/' . $starship->id)->with('success', 'Starship created!');
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
        $characters = Character::where('starship_id', $starship->id)->get();

        $title = $starship->name . (auth()->user()->is_dm ? ' > DM Mode' : '');

        return view('starship.show',
            compact(
                    'divisions',
                    'starship',
                    'character',
                    'characters',
                    'title'
                ));
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
    }

    public function addDefaultSystems(Starship $starship)
    {
        System::insert([
            [
                'starship_id' => $starship->id,
                'name' => 'Navigation',
                'description' => 'This sophisticated navigation system keeps real-time records of your starship\'s position and velocity. It also provides a means of determining the distance and most efficient route to any given target. With navigation systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances greater than one AU.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Steering',
                'description' => 'The steering system determines the direction of your starship\'s thrust. It allows the pilot to make fine adjustments to the ships\'s more immediate course and speed. With steering systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances less than one AU or dodging danger.',
                'description' => 'The steering system determines the direction of your starship\'s thrust. It allows the pilot to make fine adjustments to the ships\'s more immediate course and speed. With steering systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances less than one AU or dodging danger.',
                'division_action' => '<h3>Evasive maneuvers</h3><p>Impose disadvantage on enemy combatants by weaving through space in a random pattern. DC 14 Dexterity (Piloting) skill check.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Thrusters',
                'description' => 'The thrusters are gravity-based engines that allow your starship to travel at speeds less than the speed of light. With thrusters at 25% or less, the starship is unable to move on its own power.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'GravRing Sync',
                'description' => 'The GravRing Sync synchronizes the ship\'s navigation system with the nearest GravRing. The larger GravRing system uses the navigation calculations to generate a wormhole portal to the desired destination. With the GravRing Sync system at 25% or less, the pilot will be unable to access the GravRing system and will not be able to travel any faster than the speed of light.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Computer Core',
                'description' => 'The computer core is used to store and process data. With the computer core at 25% or less, the crew have disadvantage operating any system that requires calculations.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Sensors',
                'description' => 'The sensors are used to detect and track objects and other ships. They are also used to determine the distance and direction to any given target. With sensors at 25% or less, the crew have disadvantage on perception checks utilizing the ship\'s systems.',
                'division_action' => '<h3>Sweep the System</h3><p>Use sensors to make a Wisdom (Perception) check for anything that might be in the same star system as the ship.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Cargo Hold',
                'description' => 'The cargo hold is used to store and transport cargo. It is also used to store and transport passengers. With the cargo hold at 25% or less, the interior doors to the hold will be locked until the hull can be repaired and re-pressurized and there is a 50% chance the cargo is lost.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Grapplers',
                'description' => 'The grapplers are used to hold and release objects. With grapplers at 25% or less, the crew will be unable to manipulate exterior objects in space.',
                'division_action' => '<h3>Grapple</h3><p>Use the Grapplers to attempt to grapple anything on the ship\'s exterior within range. The target can make a DC 15 Dexterity save to avoid being grappled.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Fusion Beams',
                'description' => 'Range 3000 ft: +6 to hit, one target. Hit: 10d8 piercing damage. Fixed forward position. When the fusion beams are at 25% or less, the ship is unable to fire them.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Heavy Lasers',
                'description' => 'Range 4000 ft: +5 to hit, one target. Hit: 8d8 fire damage. Turreted movement. When the heavy lasers are at 25% or less, the ship is unable to fire them.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Shields',
                'description' => 'The shields are used to protect the ship from damage. Shields automatically subtract 15 points of damage from a hit\'s total. With shields at 25% or less, this protection is no longer offered.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Targeting',
                'description' => 'The targeting system is used to determine the direction and distance to any given target. With targeting systems at 25% or less, the crew have disadvantage on any ship\'s weapons attacks.',
                'division_action' => '<h3>Fire Weapons</h3><p>Pick any ship\'s system with an attack roll that you have access to and make two attacks with it.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Air Scrubbers',
                'description' => 'The air scrubbers are used to filter and clean the ship\'s air circulation. With air scrubbers at 25% or less, the crew will be unable to sleep soundly on the ship and will gain 1 exhaustion point per long rest.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Medical Bay',
                'description' => 'The medical bay is used to store and utilize medical equipment. With the medical bay at 25% or less, the crew will have disadvantage on any medical checks or healing spells used within the ship.',
                'division_action' => '<h3>Healing Scan</h3><p>Use equipment from the Medical Bay to give 2d4 + your Wisdom (Medicine) bonus HP to a crewmember.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'O2 Tanks',
                'description' => 'The O2 tank are used to store and distribute breathable air. With O2 tanks at 25% or less, the crew will have 24 hours to repair them before they run out of air.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Food Storage',
                'description' => 'The food storage system holds and preserves food for the crew. With the food storage system at 25% or less, the food will go bad and the crew will go hungry until replenished.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Plumbing',
                'description' => 'The plumbing system is used to maintain and repair the ship\'s plumbing. With plumbing systems at 25% or less, the crew will have disadvantage repairing any of the ship\'s systems.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Main Engine',
                'description' => 'The main engine is used to power the ship\'s thrusters. With the main engine at 25% or less, the ship will be unable to move.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Power Generator',
                'description' => 'The power generator is used to power the ship\'s systems. With the power generator at 25% or less, the crew will have disadvantage utilizing any of of the ship\'s systems.',
                'division_action' => '<h3>Power Down</h3><p>Cut power to all systems to add +10 to all ship stealth checks with the ability to immediately power them back on in case of detection.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Power Distribution',
                'description' => 'The power distribution system is used to distribute power to the ship\'s systems. With power distribution systems at 25% or less, the crew will have disadvantage utilizing any of the ship\'s systems and will be blinded within the ship while the lights are out.',
                'division_action' => '<h3>Divert Power</h3><p>Shut down one system to divert its power to another system giving advantage on any rolls related to the receiving system and temporarily ignoring its damaged effect. This lasts for one minute.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Drone Control',
                'description' => 'The drone control system is used to control the ship\'s drones. With drone control systems at 25% or less, the drones are unable to be controlled remotely.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Networking',
                'description' => 'The networking system connects the computer core to the internet. It connects to the galactic internet through a series photonic signals that also sync with the GravRings. A skilled mage can use the networking system to hack into remote systems. With the computer core at 25% or less, the crew will not be able to access any new data or remote systems.',
                'division_action' => '<h3>Hack</h3><p>Use the ship\'s networking system to hack into remote systems in one action. The remote creature must make a DC 14 Wisdom saving throw to counter the attack. Upon success, the Comms officer may use any available spell against any creature connected to the hacked ship or the ship itself ignoring range or sight requirement. The hack lasts until it is dropped or concentration is lost. The Comms officer must make a concentration check after every time the ship is hit.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Radio Transceiver',
                'description' => 'The radio transceiver is used to communicate with other ships. With the radio transceiver at 25% or less, the crew will have disadvantage communicating with other ships.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'starship_id' => $starship->id,
                'name' => 'Laser Transceiver',
                'description' => 'The laser transceiver is used to communicate with laser receivers on planet surfaces. With the laser transceiver at 25% or less, the crew will have disadvantage communicating with planet surfaces.',
                'division_action' => null,
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
        Starship::where('captain_id', $character->id)->update(['captain_id' => null]);
        $character->starship_id = $starship->id;
        $character->save();

        return back()->with('success', $character->name . ' is now aboard the ' . $starship->name . '!');
    }
}
