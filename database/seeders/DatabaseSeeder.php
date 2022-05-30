<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Division;
use App\Models\Starship;
use App\Models\System;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'starship_id' => 1,
                'name' => 'Piloting'
            ],
            [
                'id' => 2,
                'name' => 'Operations',
                'starship_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Defense',
                'starship_id' => 1
            ],
            [
                'id' => 4,
                'name' => 'Life Support',
                'starship_id' => 1
            ],
            [
                'id' => 5,
                'name' => 'Engineering',
                'starship_id' => 1
            ],
            [
                'id' => 6,
                'name' => 'Comms',
                'starship_id' => 1
            ]
            ]);

        System::insert([
            [
                'id' => 1,
                'starship_id' => 1,
                'division_id' => 1,
                'name' => 'Navigation',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 2,
                'starship_id' => 1,
                'division_id' => 1,
                'name' => 'Steering',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 3,
                'starship_id' => 1,
                'division_id' => 1,
                'name' => 'Thrusters',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 4,
                'starship_id' => 1,
                'division_id' => 1,
                'name' => 'GravRing Sync',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 5,
                'starship_id' => 1,
                'division_id' => 2,
                'name' => 'Computer Core',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 6,
                'starship_id' => 1,
                'division_id' => 2,
                'name' => 'Sensors',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 7,
                'starship_id' => 1,
                'division_id' => 2,
                'name' => 'Cargo Hold',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 8,
                'starship_id' => 1,
                'division_id' => 2,
                'name' => 'Grapplers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 9,
                'starship_id' => 1,
                'division_id' => 3,
                'name' => 'Fusion Beams',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 10,
                'starship_id' => 1,
                'division_id' => 3,
                'name' => 'Heavy Lasers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 11,
                'starship_id' => 1,
                'division_id' => 3,
                'name' => 'Shields',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 12,
                'starship_id' => 1,
                'division_id' => 3,
                'name' => 'Targeting',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 13,
                'starship_id' => 1,
                'division_id' => 4,
                'name' => 'Air Scrubbers',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 14,
                'starship_id' => 1,
                'division_id' => 4,
                'name' => 'Lighting',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 15,
                'starship_id' => 1,
                'division_id' => 4,
                'name' => 'O2 Tanks',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 16,
                'starship_id' => 1,
                'division_id' => 4,
                'name' => 'Food Storage',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 17,
                'starship_id' => 1,
                'division_id' => 4,
                'name' => 'Plumbing',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 18,
                'starship_id' => 1,
                'division_id' => 5,
                'name' => 'Main Engine',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 19,
                'starship_id' => 1,
                'division_id' => 5,
                'name' => 'Power Generator',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 20,
                'starship_id' => 1,
                'division_id' => 5,
                'name' => 'Power Distribution',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 21,
                'starship_id' => 1,
                'division_id' => 6,
                'name' => 'Drone Control',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 22,
                'starship_id' => 1,
                'division_id' => 6,
                'name' => 'Networking',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 23,
                'starship_id' => 1,
                'division_id' => 6,
                'name' => 'Radio Transceiver',
                'max_hp' => 15,
                'current_hp' => 15
            ],
            [
                'id' => 24,
                'starship_id' => 1,
                'division_id' => 6,
                'name' => 'Laser Transceiver',
                'max_hp' => 15,
                'current_hp' => 15
            ]
        ]);

        Starship::create([
            'id' => 1,
            'name' => 'Desert Rose'
        ]);

        User::create([
            'id' => 1,
            'name' => 'Steve Beaudry',
            'email' => 'live.remix@gmail.com',
            'password' => 'iforgot',
            'is_admin' => true,
            'is_dm' => true
        ]);

        Character::create([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Randy Mallard',
            'starship_id' => 1,
            'is_captain' => true
        ]);
    }
}
