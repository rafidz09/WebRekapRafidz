<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'role' => 'admin',
            'password' => Hash::make("admin"), 
        ]);

        User::create([
            'name' => "ps",
            'email' => "ps@gmail.com",
            'role' => 'ps',
            'password' => Hash::make("pembimbing"), 
        ]);
    }
}
