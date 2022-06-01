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
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 2,
                'starship_id' => 1,
                'name' => 'Steering',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 3,
                'starship_id' => 1,
                'name' => 'Thrusters',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 4,
                'starship_id' => 1,
                'name' => 'GravRing Sync',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 5,
                'starship_id' => 1,
                'name' => 'Computer Core',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 6,
                'starship_id' => 1,
                'name' => 'Sensors',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 7,
                'starship_id' => 1,
                'name' => 'Cargo Hold',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 8,
                'starship_id' => 1,
                'name' => 'Grapplers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 9,
                'starship_id' => 1,
                'name' => 'Fusion Beams',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 10,
                'starship_id' => 1,
                'name' => 'Heavy Lasers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 11,
                'starship_id' => 1,
                'name' => 'Shields',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 12,
                'starship_id' => 1,
                'name' => 'Targeting',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 13,
                'starship_id' => 1,
                'name' => 'Air Scrubbers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 14,
                'starship_id' => 1,
                'name' => 'Lighting',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 15,
                'starship_id' => 1,
                'name' => 'O2 Tanks',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 16,
                'starship_id' => 1,
                'name' => 'Food Storage',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 17,
                'starship_id' => 1,
                'name' => 'Plumbing',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 18,
                'starship_id' => 1,
                'name' => 'Main Engine',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 19,
                'starship_id' => 1,
                'name' => 'Power Generator',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 20,
                'starship_id' => 1,
                'name' => 'Power Distribution',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 21,
                'starship_id' => 1,
                'name' => 'Drone Control',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 22,
                'starship_id' => 1,
                'name' => 'Networking',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 23,
                'starship_id' => 1,
                'name' => 'Radio Transceiver',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 24,
                'starship_id' => 1,
                'name' => 'Laser Transceiver',
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
            'captain_id' => 1
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
