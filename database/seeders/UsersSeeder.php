<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Leonardo DiCaprio',
            'email' => 'leo.dicaprio@example.com',
            'password' => Hash::make('strongPassword')
        ]);
        
        User::create([
            'name' => 'Meryl Streep',
            'email' => 'meryl.streep@example.com',
            'password' => Hash::make('superStrongPassword')
        ]);
        
        User::create([
            'name' => 'Brad Pitt',
            'email' => 'brad.pitt@example.com',
            'password' => Hash::make('optimalPassword')
        ]);
        
        User::create([
            'name' => 'Julia Roberts',
            'email' => 'julia.roberts@example.com',
            'password' => Hash::make('idealPassword')
        ]);
        
    }
}