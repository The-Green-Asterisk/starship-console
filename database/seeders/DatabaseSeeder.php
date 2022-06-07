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
                'name' => 'Piloting',
                'description' => 'The Pilot is in charge of where the starship goes after consulting with the captain and crew.'
            ],
            [
                'id' => 2,
                'name' => 'Operations',
                'description' => 'The Operations officer is in charge of operating the ship\'s internal systems.'
            ],
            [
                'id' => 3,
                'name' => 'Defense',
                'description' => 'The Defense officer is in charge of defending the ship against enemy fire and dealing damage to attackers.'
            ],
            [
                'id' => 4,
                'name' => 'Life Support',
                'description' => 'The Life Support officer is in charge of maintaining the ship\'s life-sustaining systems and ensuring the ship is in good health.'
            ],
            [
                'id' => 5,
                'name' => 'Engineering',
                'description' => 'The Engineering officer may access any system from any division to affect repairs throughout the ship.'
            ],
            [
                'id' => 6,
                'name' => 'Comms',
                'description' => 'The Comms officer is in charge of communicating with other ships and crewmembers.'
            ]
            ]);

        System::insert([
            [
                'id' => 1,
                'starship_id' => 1,
                'name' => 'Navigation',
                'description' => 'This sophisticated navigation system keeps real-time records of your starship\'s position and velocity. It also provides a means of determining the distance and most efficient route to any given target. With navigation systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances greater than one AU.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 2,
                'starship_id' => 1,
                'name' => 'Steering',
                'description' => 'The steering system determines the direction of your starship\'s thrust. It allows the pilot to make fine adjustments to the ships\'s more immediate course and speed. With steering systems at 25% or less, the pilot has disadvantage on any skill check involving maneuvering distances less than one AU or dodging danger.',
                'division_action' => '<h3>Evasive maneuvers</h3><p>Impose disadvantage on enemy combatants by weaving through space in a random pattern. DC 14 Dexterity (Piloting) skill check.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 3,
                'starship_id' => 1,
                'name' => 'Thrusters',
                'description' => 'The thrusters are gravity-based engines that allow your starship to travel at speeds less than the speed of light. With thrusters at 25% or less, the starship is unable to move on its own power.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 4,
                'starship_id' => 1,
                'name' => 'GravRing Sync',
                'description' => 'The GravRing Sync synchronizes the ship\'s navigation system with the nearest GravRing. The larger GravRing system uses the navigation calculations to generate a wormhole portal to the desired destination. With the GravRing Sync system at 25% or less, the pilot will be unable to access the GravRing system and will not be able to travel any faster than the speed of light.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 5,
                'starship_id' => 1,
                'name' => 'Computer Core',
                'description' => 'The computer core is used to store and process data. With the computer core at 25% or less, the crew have disadvantage operating any system that requires calculations.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 6,
                'starship_id' => 1,
                'name' => 'Sensors',
                'description' => 'The sensors are used to detect and track objects and other ships. They are also used to determine the distance and direction to any given target. With sensors at 25% or less, the crew have disadvantage on perception checks utilizing the ship\'s systems.',
                'division_action' => '<h3>Sweep the System</h3><p>Use sensors to make a Wisdom (Perception) check for anything that might be in the same star system as the ship.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 7,
                'starship_id' => 1,
                'name' => 'Cargo Hold',
                'description' => 'The cargo hold is used to store and transport cargo. It is also used to store and transport passengers. With the cargo hold at 25% or less, the interior doors to the hold will be locked until the hull can be repaired and re-pressurized and there is a 50% chance the cargo is lost.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 8,
                'starship_id' => 1,
                'name' => 'Grapplers',
                'description' => 'The grapplers are used to hold and release objects. With grapplers at 25% or less, the crew will be unable to manipulate exterior objects in space.',
                'division_action' => '<h3>Grapple</h3><p>Use the Grapplers to attempt to grapple anything on the ship\'s exterior within range. The target can make a DC 15 Dexterity save to avoid being grappled.</p>',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 9,
                'starship_id' => 1,
                'name' => 'Fusion Beams',
                'description' => 'Ranged Weapon Attack: +6 to hit, one target. Hit: 3d10 piercing damage. When the fusion beams are at 25% or less, the ship is unable to fire them.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 10,
                'starship_id' => 1,
                'name' => 'Heavy Lasers',
                'description' => 'Ranged Weapon Attack: +5 to hit, one target. Hit: 5d10 bludgeoning damage. When the heavy lasers are at 25% or less, the ship is unable to fire them.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 11,
                'starship_id' => 1,
                'name' => 'Shields',
                'description' => 'The shields are used to protect the ship from damage. Shields automatically subtract 15 points of damage from a hit\'s total. With shields at 25% or less, this protection is no longer offered.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 12,
                'starship_id' => 1,
                'name' => 'Targeting',
                'description' => 'The targeting system is used to determine the direction and distance to any given target. With targeting systems at 25% or less, the crew have disadvantage on any ship\'s weapons attacks.',
                'division_action' => '<h3>Fire Weapons</h3><p>Pick any ship\'s system with an attack roll that you have access to and make two attacks with it.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 13,
                'starship_id' => 1,
                'name' => 'Air Scrubbers',
                'description' => 'The air scrubbers are used to filter and clean the ship\'s air circulation. With air scrubbers at 25% or less, the crew will be unable to sleep soundly on the ship and will gain 1 exhaustion point per long rest.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 14,
                'starship_id' => 1,
                'name' => 'Medical Bay',
                'description' => 'The medical bay is used to store and utilize medical equipment. With the medical bay at 25% or less, the crew will have disadvantage on any medical checks or healing spells used within the ship.',
                'division_action' => '<h3>Healing Scan</h3><p>Use equipment from the Medical Bay to give 2d4 + your Wisdom (Medicine) bonus HP to a crewmember.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 15,
                'starship_id' => 1,
                'name' => 'O2 Tanks',
                'description' => 'The O2 tank are used to store and distribute breathable air. With O2 tanks at 25% or less, the crew will have 24 hours to repair them before they run out of air.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 16,
                'starship_id' => 1,
                'name' => 'Food Storage',
                'description' => 'The food storage system holds and preserves food for the crew. With the food storage system at 25% or less, the food will go bad and the crew will go hungry until replenished.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 17,
                'starship_id' => 1,
                'name' => 'Plumbing',
                'description' => 'The plumbing system is used to maintain and repair the ship\'s plumbing. With plumbing systems at 25% or less, the crew will have disadvantage repairing any of the ship\'s systems.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 18,
                'starship_id' => 1,
                'name' => 'Main Engine',
                'description' => 'The main engine is used to power the ship\'s thrusters. With the main engine at 25% or less, the ship will be unable to move.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 19,
                'starship_id' => 1,
                'name' => 'Power Generator',
                'description' => 'The power generator is used to power the ship\'s systems. With the power generator at 25% or less, the crew will have disadvantage utilizing any of of the ship\'s systems.',
                'division_action' => '<h3>Power Down</h3><p>Cut power to all systems to add +10 to all ship stealth checks with the ability to immediately power them back on in case of detection.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 20,
                'starship_id' => 1,
                'name' => 'Power Distribution',
                'description' => 'The power distribution system is used to distribute power to the ship\'s systems. With power distribution systems at 25% or less, the crew will have disadvantage utilizing any of the ship\'s systems and will be blinded within the ship while the lights are out.',
                'division_action' => '<h3>Divert Power</h3><p>Shut down one system to divert its power to another system giving advantage on any rolls related to the receiving system and temporarily ignoring its damaged effect. This lasts for one minute.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 21,
                'starship_id' => 1,
                'name' => 'Drone Control',
                'description' => 'The drone control system is used to control the ship\'s drones. With drone control systems at 25% or less, the drones are unable to be controlled remotely.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 22,
                'starship_id' => 1,
                'name' => 'Networking',
                'description' => 'The networking system connects the computer core to the internet. It connects to the galactic internet through a series photonic signals that also sync with the GravRings. A skilled mage can use the networking system to hack into remote systems. With the computer core at 25% or less, the crew will not be able to access any new data or remote systems.',
                'division_action' => '<h3>Hack</h3><p>Use the ship\'s networking system to hack into remote systems in one action. The remote creature must make a DC 14 Wisdom saving throw to counter the attack. Upon success, the Comms officer may use any available spell against any creature connected to the hacked ship or the ship itself ignoring range or sight requirement. The hack lasts until it is dropped or concentration is lost. The Comms officer must make a concentration check after every time the ship is hit.</p>',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 23,
                'starship_id' => 1,
                'name' => 'Radio Transceiver',
                'description' => 'The radio transceiver is used to communicate with laser receivers on planet surfaces. With the laser transceiver at 25% or less, the crew will have disadvantage communicating with planet surfaces.',
                'division_action' => null,
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 24,
                'starship_id' => 1,
                'name' => 'Laser Transceiver',
                'description' => 'The laser transceiver is used to communicate with other ships. With the radio transceiver at 25% or less, the crew will have disadvantage communicating with other ships.',
                'division_action' => null,
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

        User::create([
            'id' => 1,
            'name' => 'Steve Beaudry',
            'email' => 'live.remix@gmail.com',
            'password' => 'iforgot',
            'is_admin' => true,
            'is_dm' => true
        ]);
        Starship::create([
            'id' => 1,
            'name' => 'Desert Rose',
            'dm_id' => 1,
        ]);
        for ($i = 0; $i < Division::all()->count(); $i++) {
            Starship::find(1)->divisions()->attach($i + 1);
        }
        User::find(1)->starships()->attach(Starship::find(1));

        Character::create([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Randy Mallard',
            'starship_id' => 1,
            'is_active' => true
        ]);
        Starship::find(1)->captain_id = 1;
    }
}
