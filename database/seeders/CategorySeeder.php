<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate data dummy untuk kategori
        for ($i = 1; $i <= 100; $i++) {
            $imagePath = 'images/image_' . $i . '.jpg'; // Path gambar
            $imageName = 'image_' . $i . '.jpg'; // Nama gambar
        
            // Simpan gambar ke dalam storage
            Storage::copy('default-image.jpg', $imagePath);
        
            // Kategori bergantung pada nilai genap/ganjil dari $i
            $categoryType = ($i % 2 === 0) ? 'Makanan' : 'Minuman';
        
            // Tambahkan data kategori ke dalam database
            Category::create([
                'name' => $categoryType . ' ' . $i,
                'image' => $imageName,
                'description' => 'Deskripsi untuk ' . $categoryType . ' ' . $i,
            ]);
        }
        
    }
}
