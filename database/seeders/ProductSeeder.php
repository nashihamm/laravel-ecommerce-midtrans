<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str; // Tambahkan ini untuk menghasilkan slug
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan kategori "Laptop" sudah ada
        $category = Category::firstOrCreate(
            ['name' => 'Laptop'], // Kunci unik untuk mencari kategori
            [
                'description' => 'Kategori untuk produk laptop',
                'slug' => Str::slug('Laptop'), // Generate slug dari nama kategori
            ]
        );

        // Data dummy untuk produk laptop
        $laptops = [
            [
                'name' => 'MacBook Air M1',
                'price' => 12000000,
                'stock' => 50,
                'description' => 'Laptop ringan dengan chip M1 dari Apple.',
                'image' => 'macbook_air_m1.jpg',
            ],
            [
                'name' => 'Dell XPS 13',
                'price' => 15000000,
                'stock' => 30,
                'description' => 'Laptop premium dengan layar InfinityEdge.',
                'image' => 'dell_xps_13.jpg',
            ],
            [
                'name' => 'HP Spectre x360',
                'price' => 18000000,
                'stock' => 20,
                'description' => 'Laptop convertible dengan desain elegan.',
                'image' => 'hp_spectre_x360.jpg',
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'price' => 14000000,
                'stock' => 40,
                'description' => 'Laptop bisnis dengan keyboard terbaik.',
                'image' => 'lenovo_thinkpad_x1_carbon.jpg',
            ],
            [
                'name' => 'Asus ROG Zephyrus G14',
                'price' => 20000000,
                'stock' => 25,
                'description' => 'Laptop gaming dengan performa tinggi.',
                'image' => 'asus_rog_zephyrus_g14.jpg',
            ],
        ];

        // Loop untuk menyimpan data produk
        foreach ($laptops as $laptop) {
            // Gunakan updateOrCreate untuk menghindari duplikasi
            $product = Product::updateOrCreate(
                ['name' => $laptop['name']], // Kunci unik untuk mencari produk
                [
                    'price' => $laptop['price'],
                    'stock' => $laptop['stock'],
                    'description' => $laptop['description'],
                    'image' => $laptop['image'],
                    'category_id' => $category->id,
                    'seller_id' => 1, // Asumsi seller_id adalah 1 (admin atau seller default)
                ]
            );

            // Jika ingin menambahkan gambar dummy ke storage
            if (!Storage::disk('public')->exists($laptop['image'])) {
                // Simpan gambar dummy ke folder storage/app/public
                Storage::disk('public')->put($laptop['image'], file_get_contents(public_path('dummy_images/' . $laptop['image'])));
            }
        }
    }
}