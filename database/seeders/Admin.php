<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Admin extends Seeder
{
    // Declare static property
    protected static $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => $this->getPassword(),
            'remember_token' => Str::random(10),
            'role' => 1
        ]);

    }

    /**
     * Get the password, initializing it if not set.
     *
     * @return string
     */
    protected function getPassword(): string
    {
        return static::$password ?? static::$password = Hash::make('password');
    }
}
