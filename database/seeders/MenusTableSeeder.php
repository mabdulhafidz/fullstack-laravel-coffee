<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('menus')->insert([
                'name' => Str::random(10),
                'description' => Str::random(50),
                'image' => 'image_' . Str::random(5) . '.jpg',
                'price' => rand(1000, 5000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
