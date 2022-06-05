<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Division;
use App\Models\Starship;
use App\Models\System;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Division::insert([
            [
                'id' => 1,
                'name' => 'Piloting'
            ],
            [
                'id' => 2,
                'name' => 'Operations',
            ],
            [
                'id' => 3,
                'name' => 'Defense',
            ],
            [
                'id' => 4,
                'name' => 'Life Support',
            ],
            [
                'id' => 5,
                'name' => 'Engineering',
            ],
            [
                'id' => 6,
                'name' => 'Comms',
            ]
            ]);

        System::insert([
            [
                'id' => 1,
                'starship_id' => 1,
                'name' => 'Navigation',
                'description' => 'This sophisticated navigation system keeps real-time records of your starship\'s position and velocity. It also provides a means of determining the distance and most efficient route to any given target. With navigation systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances greater than one AU.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 2,
                'starship_id' => 1,
                'name' => 'Steering',
                'description' => 'The steering system determines the direction of your starship\'s thrust. It allows the pilot to make fine adjustments to the ships\'s more immediate course and speed. With steering systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances less than one AU or dodging danger.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 3,
                'starship_id' => 1,
                'name' => 'Thrusters',
                'description' => 'The thrusters are gravity-based engines that allow your starship to travel at speeds less than the speed of light. With thrusters at 25% or less, the starship is unable to move on its own power.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 4,
                'starship_id' => 1,
                'name' => 'GravRing Sync',
                'description' => 'The GravRing Sync synchronizes the ship\'s navigation system with the nearest GravRing. The larger GravRing system uses the navigation calculations to generate a wormhole portal to the desired destination. With the GravRing Sync system at 25% or less, the pilot will be unable to access the GravRing system and will not be able to travel any faster than the speed of light.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 5,
                'starship_id' => 1,
                'name' => 'Computer Core',
                'description' => 'The computer core is used to store and process data. With the computer core at 25% or less, the crew have disadvantage operating any system that requires calculations.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 6,
                'starship_id' => 1,
                'name' => 'Sensors',
                'description' => 'The sensors are used to detect and track objects and other ships. They are also used to determine the distance and direction to any given target. With sensors at 25% or less, the crew have disadvantage on perception checks utilizing the ship\'s systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 7,
                'starship_id' => 1,
                'name' => 'Cargo Hold',
                'description' => 'The cargo hold is used to store and transport cargo. It is also used to store and transport passengers. With the cargo hold at 25% or less, the interior doors to the hold will be locked until the hull can be repaired and re-pressurized and there is a 50% chance the cargo is lost.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 8,
                'starship_id' => 1,
                'name' => 'Grapplers',
                'description' => 'The grapplers are used to hold and release objects. With grapplers at 25% or less, the crew will be unable to manipulate exterior objects in space.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 9,
                'starship_id' => 1,
                'name' => 'Fusion Beams',
                'description' => 'Ranged Weapon Attack: +6 to hit, one target. Hit: 3d10 piercing damage. When the fusion beams are at 25% or less, the ship is unable to fire them.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 10,
                'starship_id' => 1,
                'name' => 'Heavy Lasers',
                'description' => 'Ranged Weapon Attack: +5 to hit, one target. Hit: 5d10 bludgeoning damage. When the heavy lasers are at 25% or less, the ship is unable to fire them.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 11,
                'starship_id' => 1,
                'name' => 'Shields',
                'description' => 'The shields are used to protect the ship from damage. Shields automatically subtract 15 points of damage from a hit\'s total. With shields at 25% or less, this protection is no longer offered.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 12,
                'starship_id' => 1,
                'name' => 'Targeting',
                'description' => 'The targeting system is used to determine the direction and distance to any given target. With targeting systems at 25% or less, the crew have disadvantage on any ship\'s weapons attacks.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 13,
                'starship_id' => 1,
                'name' => 'Air Scrubbers',
                'description' => 'The air scrubbers are used to filter and clean the ship\'s air circulation. With air scrubbers at 25% or less, the crew will be unable to sleep soundly on the ship and will gain 1 exhaustion point per long rest.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 14,
                'starship_id' => 1,
                'name' => 'Medical Bay',
                'description' => 'The medical bay is used to store and utilize medical equipment. With the medical bay at 25% or less, the crew will have disadvantage on any medical checks or healing spells used within the ship.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 15,
                'starship_id' => 1,
                'name' => 'O2 Tanks',
                'description' => 'The O2 tank are used to store and distribute breathable air. With O2 tanks at 25% or less, the crew will have 24 hours to repair them before they run out of air.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 16,
                'starship_id' => 1,
                'name' => 'Food Storage',
                'description' => 'The food storage system holds and preserves food for the crew. With the food storage system at 25% or less, the food will go bad and the crew will go hungry until replenished.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 17,
                'starship_id' => 1,
                'name' => 'Plumbing',
                'description' => 'The plumbing system is used to maintain and repair the ship\'s plumbing. With plumbing systems at 25% or less, the crew will have disadvantage repairing any of the ship\'s systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 18,
                'starship_id' => 1,
                'name' => 'Main Engine',
                'description' => 'The main engine is used to power the ship\'s thrusters. With the main engine at 25% or less, the ship will be unable to move.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 19,
                'starship_id' => 1,
                'name' => 'Power Generator',
                'description' => 'The power generator is used to power the ship\'s systems. With the power generator at 25% or less, the crew will have disadvantage utilizing any of of the ship\'s systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 20,
                'starship_id' => 1,
                'name' => 'Power Distribution',
                'description' => 'The power distribution system is used to distribute power to the ship\'s systems. With power distribution systems at 25% or less, the crew will have disadvantage utilizing any of the ship\'s systems and will be blinded within the ship while the lights are out.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 21,
                'starship_id' => 1,
                'name' => 'Drone Control',
                'description' => 'The drone control system is used to control the ship\'s drones. With drone control systems at 25% or less, the drones are unable to be controlled remotely.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 22,
                'starship_id' => 1,
                'name' => 'Networking',
                'description' => 'The networking system connects the computer core to the internet. It connects to the galactic internet through a series photonic signals that also sync with the GravRings. A skilled mage can use the networking system to hack into remote systems. With the computer core at 25% or less, the crew will not be able to access any new data or remote systems.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 23,
                'starship_id' => 1,
                'name' => 'Radio Transceiver',
                'description' => 'The radio transceiver is used to communicate with other ships. With the radio transceiver at 25% or less, the crew will have disadvantage communicating with other ships.',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 24,
                'starship_id' => 1,
                'name' => 'Laser Transceiver',
                'description' => 'The laser transceiver is used to communicate with laser receivers on planet surfaces. With the laser transceiver at 25% or less, the crew will have disadvantage communicating with planet surfaces.',
                'max_hp' => 15,
                'current_hp' => 15
            ]
        ]);
        System::find(1)->divisions()->attach(1);
        System::find(2)->divisions()->attach(1);
        System::find(3)->divisions()->attach(1);
        System::find(4)->divisions()->attach(1);
        System::find(5)->divisions()->attach(2);
        System::find(6)->divisions()->attach(2);
        System::find(7)->divisions()->attach(2);
        System::find(8)->divisions()->attach(2);
        System::find(9)->divisions()->attach(3);
        System::find(10)->divisions()->attach(3);
        System::find(11)->divisions()->attach(3);
        System::find(12)->divisions()->attach(3);
        System::find(13)->divisions()->attach(4);
        System::find(14)->divisions()->attach(4);
        System::find(15)->divisions()->attach(4);
        System::find(16)->divisions()->attach(4);
        System::find(17)->divisions()->attach(4);
        System::find(18)->divisions()->attach(5);
        System::find(19)->divisions()->attach(5);
        System::find(20)->divisions()->attach(5);
        System::find(21)->divisions()->attach(6);
        System::find(22)->divisions()->attach(6);
        System::find(23)->divisions()->attach(6);
        System::find(24)->divisions()->attach(6);

        DB::statement('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0');
        Starship::create([
            'id' => 1,
            'name' => 'Desert Rose',
            'captain_id' => 1,
            'dm_id' => 1,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS');
        for ($i = 0; $i < Division::all()->count(); $i++) {
            Starship::find(1)->divisions()->attach($i + 1);
        }

        User::create([
            'id' => 1,
            'name' => 'Steve Beaudry',
            'email' => 'live.remix@gmail.com',
            'password' => 'iforgot',
            'is_admin' => true,
            'is_dm' => true
        ]);
        User::find(1)->starships()->attach(Starship::find(1));

        Character::create([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Randy Mallard',
            'starship_id' => 1,
            'is_captain' => true,
            'is_active' => true
        ]);
    }
}
