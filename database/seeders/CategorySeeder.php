<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined categories
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Beauty & Personal Care',
            'Sports & Outdoors',
            'Toys & Games',
            'Books & Stationery',
            'Jewelry & Accessories',
            'Health & Wellness',
            'Automotive',
            'Garden & Outdoor',
            'Pet Supplies',
            'Office Products',
            'Arts & Crafts',
            'Baby & Kids'
        ];

        // Clear existing categories
        $this->command->info('Clearing existing categories...');
        Category::truncate();
        
        $this->command->info('Creating categories...');
        
        // Create categories from the predefined list
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
            
            $this->command->info("Created category: {$categoryName}");
        }
        
        // Create some additional random categories
        $this->command->info('Creating additional random categories...');
        Category::factory()->count(5)->create();
        
        $this->command->info('Category seeding completed successfully!');
    }
}