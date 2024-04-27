<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  User::create([
        //     'name' => 'Nama Pengguna',
        //     'email' => 'email@example.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'),
        //     'remember_token' => Str::random(10),
        //     'role' => '3', 
        // ]);                                         
    }
}
