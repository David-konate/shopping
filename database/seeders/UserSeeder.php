<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // création de l'administrateur
        User::create([
            'last_name' => 'administrateur',
            'first_name' => 'administrateur',
            'password' => Hash::make('Azerty@123'),
            'email' => 'admin@boss.fr',
            'email_verified_at' => now(),

            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);

         // création d'un utilisateur test
         User::create([
            'last_name' => 'administrateur',
            'first_name' => 'administrateur',
            'password' => Hash::make('Azerty@123'),
            'email' => 'utilisateur@use.fr',
            'email_verified_at' => now(),

            'remember_token' => Str::random(10),
            'role_id' => 1
        ]);

        //création de 8 users aléatoires
        User::factory(8)->create();
    }


}
