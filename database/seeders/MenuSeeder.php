<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        // Buat kategori terlebih dahulu
        $categories = [
            ['name' => 'Makanan Ringan', 'description' => 'Makanan ringan yang lezat dan mengenyangkan', 'image' => 'snacks.jpg'],
            ['name' => 'Makanan Berat', 'description' => 'Menu makanan berat yang penuh gizi dan bergizi', 'image' => 'main-courses.jpg'],
            ['name' => 'Makanan Penutup', 'description' => 'Makanan penutup yang manis dan menyegarkan', 'image' => 'desserts.jpg'],
            ['name' => 'Minuman Hangat', 'description' => 'Minuman hangat yang dapat menghangatkan tubuh', 'image' => 'hot-drinks.jpg'],
            ['name' => 'Minuman Dingin', 'description' => 'Minuman dingin yang menyegarkan di hari yang panas', 'image' => 'cold-drinks.jpg'],
            ['name' => 'Minuman Biasa', 'description' => 'Minuman biasa yang dapat melepaskan dahaga', 'image' => 'regular-drinks.jpg'],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
            ]);
        }

        $menus = [
            ['name' => 'Keripik Kentang', 'category' => 'Makanan Ringan'],
            ['name' => 'Kacang Panggang', 'category' => 'Makanan Ringan'],
            ['name' => 'Popcorn', 'category' => 'Makanan Ringan'],
            ['name' => 'Nasi Goreng', 'category' => 'Makanan Berat'],
            ['name' => 'Ayam Goreng', 'category' => 'Makanan Berat'],
            ['name' => 'Mie Goreng', 'category' => 'Makanan Berat'],
            ['name' => 'Es Krim', 'category' => 'Makanan Penutup'],
            ['name' => 'Puding', 'category' => 'Makanan Penutup'],
            ['name' => 'Coklat Lava', 'category' => 'Makanan Penutup'],
            ['name' => 'Kopi', 'category' => 'Minuman Hangat'],
            ['name' => 'Teh', 'category' => 'Minuman Hangat'],
            ['name' => 'Coklat Panas', 'category' => 'Minuman Hangat'],
            ['name' => 'Es Teh', 'category' => 'Minuman Dingin'],
            ['name' => 'Es Jeruk', 'category' => 'Minuman Dingin'],
            ['name' => 'Es Campur', 'category' => 'Minuman Dingin'],
            ['name' => 'Air Mineral', 'category' => 'Minuman Biasa'],
            ['name' => 'Soda', 'category' => 'Minuman Biasa'],
            ['name' => 'Air Putih', 'category' => 'Minuman Biasa'],
        ];

        foreach ($menus as $menuData) {
            $category = Category::where('name', $menuData['category'])->first();

            $menu = Menu::create([
                'name' => $menuData['name'],
                'image' => 'default-image.jpg',
                'price' => number_format($faker->randomFloat(2, 1, 10), 2), // Menggunakan format decimal dengan 2 angka di belakang koma
                'description' => $faker->sentence,
            ]);

            $menu->categories()->attach($category->id);
        }
    }
}