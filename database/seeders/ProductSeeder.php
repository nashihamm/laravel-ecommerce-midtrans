<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create uploads directory if it doesn't exist
        $uploadsPath = public_path('uploads');
        if (!File::exists($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0755, true);
        }

        // Get all seller users
        $sellers = User::where('role', 'seller')->get();
        if ($sellers->isEmpty()) {
            $this->command->info('No sellers found. Creating one seller user...');
            $seller = User::factory()->create([
                'role' => 'seller',
                'name' => 'Demo Seller',
                'email' => 'seller@example.com',
            ]);
            $sellers = collect([$seller]);
        }

        // Get all categories
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->command->info('No categories found. Creating categories...');
            $categoryNames = ['Electronics', 'Fashion', 'Home & Kitchen', 'Beauty', 'Sports', 'Toys', 'Books', 'Jewelry'];
            
            foreach ($categoryNames as $name) {
                Category::create(['name' => $name]);
            }
            $categories = Category::all();
        }

        // Product data
        $productCount = 20;
        $this->command->info("Creating {$productCount} unique products...");

        // Product types by category
        $productTypes = [
            'Electronics' => [
                [
                    'name' => 'Premium Wireless Headphones',
                    'description' => 'Experience crystal-clear audio with our premium noise-cancelling wireless headphones. Perfect for music enthusiasts and professionals.',
                    'price' => rand(1200000, 3500000),
                    'query' => 'headphones'
                ],
                [
                    'name' => 'Smart Watch Series X',
                    'description' => 'Track your fitness, receive notifications, and monitor your health with this sleek, water-resistant smartwatch.',
                    'price' => rand(1500000, 4000000),
                    'query' => 'smartwatch'
                ],
                [
                    'name' => 'Ultra HD Drone Camera',
                    'description' => 'Capture breathtaking aerial footage with this advanced drone featuring 4K video recording and 30-minute flight time.',
                    'price' => rand(5000000, 12000000),
                    'query' => 'drone'
                ],
                [
                    'name' => 'Portable Bluetooth Speaker',
                    'description' => 'Powerful sound in a compact design. Waterproof, dustproof, and with 24-hour battery life.',
                    'price' => rand(500000, 1500000),
                    'query' => 'speaker'
                ],
            ],
            'Fashion' => [
                [
                    'name' => 'Classic Leather Jacket',
                    'description' => 'Timeless style meets modern comfort in this genuine leather jacket with premium stitching and durable lining.',
                    'price' => rand(800000, 2500000),
                    'query' => 'jacket'
                ],
                [
                    'name' => 'Designer Sunglasses',
                    'description' => 'UV protection with polarized lenses in an elegant, lightweight frame that complements any outfit.',
                    'price' => rand(500000, 1500000),
                    'query' => 'sunglasses'
                ],
                [
                    'name' => 'Premium Denim Jeans',
                    'description' => 'Expertly crafted denim with the perfect balance of comfort and durability. Available in various washes.',
                    'price' => rand(600000, 1200000),
                    'query' => 'jeans'
                ],
            ],
            'Home & Kitchen' => [
                [
                    'name' => 'Professional Chef Knife Set',
                    'description' => 'High-carbon stainless steel knives with ergonomic handles perfect for professional chefs and home cooking enthusiasts.',
                    'price' => rand(900000, 2500000),
                    'query' => 'knives'
                ],
                [
                    'name' => 'Smart Home Coffee Maker',
                    'description' => 'Programmable coffee machine with built-in grinder and smartphone control for the perfect brew every time.',
                    'price' => rand(1200000, 3000000),
                    'query' => 'coffee'
                ],
                [
                    'name' => 'Luxury Bedding Set',
                    'description' => '100% Egyptian cotton sheets with a 1000 thread count for the ultimate sleeping experience.',
                    'price' => rand(1000000, 3000000),
                    'query' => 'bedding'
                ],
            ],
            'Beauty' => [
                [
                    'name' => 'Premium Skincare Collection',
                    'description' => 'Complete skincare routine with natural ingredients to nourish, hydrate, and rejuvenate your skin.',
                    'price' => rand(800000, 2000000),
                    'query' => 'skincare'
                ],
                [
                    'name' => 'Professional Hair Styling Kit',
                    'description' => 'Salon-quality hair tools including ionic dryer, ceramic straightener, and curling wand.',
                    'price' => rand(1200000, 2500000),
                    'query' => 'haircare'
                ],
            ],
            'Sports' => [
                [
                    'name' => 'Ultra-Lightweight Running Shoes',
                    'description' => 'Engineered for maximum comfort and performance with responsive cushioning and breathable mesh.',
                    'price' => rand(800000, 2000000),
                    'query' => 'shoes'
                ],
                [
                    'name' => 'Smart Fitness Tracker',
                    'description' => 'Track your workouts, heart rate, sleep quality and more with this water-resistant fitness band.',
                    'price' => rand(600000, 1500000),
                    'query' => 'fitness'
                ],
                [
                    'name' => 'Professional Yoga Mat',
                    'description' => 'Eco-friendly, non-slip yoga mat with perfect cushioning for all yoga styles.',
                    'price' => rand(300000, 800000),
                    'query' => 'yoga'
                ],
            ],
            'Toys' => [
                [
                    'name' => 'Educational Building Blocks',
                    'description' => 'Stimulate creativity and logical thinking with these colorful, compatible building blocks for ages 3-12.',
                    'price' => rand(400000, 1200000),
                    'query' => 'blocks'
                ],
                [
                    'name' => 'Remote Control Racing Car',
                    'description' => 'High-speed RC car with precise control, durable construction, and rechargeable battery.',
                    'price' => rand(500000, 1500000),
                    'query' => 'toycar'
                ],
            ],
            'Books' => [
                [
                    'name' => 'Classic Literature Collection',
                    'description' => 'Beautifully bound collection of the world\'s greatest literary works with premium paper and typography.',
                    'price' => rand(600000, 1500000),
                    'query' => 'books'
                ],
                [
                    'name' => 'Business Strategy Handbook',
                    'description' => 'Comprehensive guide to modern business strategies with case studies from leading global companies.',
                    'price' => rand(400000, 900000),
                    'query' => 'business'
                ],
            ],
            'Jewelry' => [
                [
                    'name' => 'Elegant Pearl Necklace',
                    'description' => 'Lustrous freshwater pearls with 18K gold clasp, perfect for special occasions or everyday elegance.',
                    'price' => rand(1000000, 5000000),
                    'query' => 'necklace'
                ],
                [
                    'name' => 'Minimalist Silver Bracelet',
                    'description' => 'Hand-crafted sterling silver bracelet with contemporary design that complements any style.',
                    'price' => rand(500000, 1500000),
                    'query' => 'bracelet'
                ],
            ],
        ];
        
        // Predefined image URLs using source.unsplash.com random service
        $imageUrls = [
            'Electronics' => [
                'https://source.unsplash.com/random/800x600/?headphones',
                'https://source.unsplash.com/random/800x600/?smartwatch',
                'https://source.unsplash.com/random/800x600/?drone',
                'https://source.unsplash.com/random/800x600/?speaker',
                'https://source.unsplash.com/random/800x600/?laptop',
            ],
            'Fashion' => [
                'https://source.unsplash.com/random/800x600/?fashion',
                'https://source.unsplash.com/random/800x600/?jacket',
                'https://source.unsplash.com/random/800x600/?sunglasses',
                'https://source.unsplash.com/random/800x600/?jeans',
                'https://source.unsplash.com/random/800x600/?shoes',
            ],
            'Home & Kitchen' => [
                'https://source.unsplash.com/random/800x600/?kitchen',
                'https://source.unsplash.com/random/800x600/?knives',
                'https://source.unsplash.com/random/800x600/?coffee',
                'https://source.unsplash.com/random/800x600/?bedding',
                'https://source.unsplash.com/random/800x600/?furniture',
            ],
            'Beauty' => [
                'https://source.unsplash.com/random/800x600/?skincare',
                'https://source.unsplash.com/random/800x600/?makeup',
                'https://source.unsplash.com/random/800x600/?cosmetics',
                'https://source.unsplash.com/random/800x600/?beauty',
            ],
            'Sports' => [
                'https://source.unsplash.com/random/800x600/?running',
                'https://source.unsplash.com/random/800x600/?fitness',
                'https://source.unsplash.com/random/800x600/?yoga',
                'https://source.unsplash.com/random/800x600/?sports',
            ],
            'Toys' => [
                'https://source.unsplash.com/random/800x600/?toys',
                'https://source.unsplash.com/random/800x600/?blocks',
                'https://source.unsplash.com/random/800x600/?toy+car',
                'https://source.unsplash.com/random/800x600/?games',
            ],
            'Books' => [
                'https://source.unsplash.com/random/800x600/?books',
                'https://source.unsplash.com/random/800x600/?book',
                'https://source.unsplash.com/random/800x600/?library',
                'https://source.unsplash.com/random/800x600/?reading',
            ],
            'Jewelry' => [
                'https://source.unsplash.com/random/800x600/?jewelry',
                'https://source.unsplash.com/random/800x600/?necklace',
                'https://source.unsplash.com/random/800x600/?bracelet',
                'https://source.unsplash.com/random/800x600/?ring',
            ],
        ];

        $productCount = min($productCount, 50); // Limit to 50 products max
        $createdCount = 0;
        
        // Iterate through categories and create products
        foreach ($categories as $category) {
            if (!isset($productTypes[$category->name])) {
                continue;
            }
            
            foreach ($productTypes[$category->name] as $productData) {
                if ($createdCount >= $productCount) {
                    break 2; // Break out of both loops
                }
                
                // Generate a product variant
                $variant = rand(1, 3);
                $variantName = $productData['name'] . ' ' . $this->getVariantSuffix($variant);
                
                // Generate unique filename
                $nameParts = explode(' ', $variantName);
                $shortName = implode('_', array_slice($nameParts, 0, 2));
                $filename = $shortName . '_' . now()->format('YmdHis') . '.jpg';
                $filePath = 'uploads/' . $filename;
                
                // Get random image URL for this category
                $categoryImages = $imageUrls[$category->name] ?? $imageUrls['Electronics'];
                $imageUrl = $categoryImages[array_rand($categoryImages)];
                
                // Download image and save to uploads folder
                try {
                    $this->command->info("Downloading image from: {$imageUrl}");
                    $randomParam = '&random=' . rand(1, 1000); // Add random parameter to prevent caching
                    $imageContents = file_get_contents($imageUrl . $randomParam);
                    File::put(public_path($filePath), $imageContents);
                } catch (\Exception $e) {
                    $this->command->error('Error downloading image: ' . $e->getMessage());
                    $filename = null;
                }
                
                // Calculate price with variant
                $basePrice = $productData['price'];
                $price = $basePrice + ($variant * $basePrice * 0.15); // 15% price increase per variant level
                
                // Assign to random seller
                $seller = $sellers->random();
                
                // Create the product
                Product::create([
                    'name' => $variantName,
                    'description' => $productData['description'],
                    'price' => $price,
                    'stock' => rand(5, 50),
                    'category_id' => $category->id,
                    'seller_id' => $seller->id,
                    'image' => $filename,
                ]);
                
                $createdCount++;
                $this->command->info("Created product: {$variantName}");
                
                // Add a slight delay to make sure image names are unique and Unsplash gives different images
                sleep(1);
            }
        }
        
        $this->command->info("Successfully created {$createdCount} products!");
    }
    
    /**
     * Get a variant suffix based on the variant level
     */
    private function getVariantSuffix($variant)
    {
        $suffixes = [
            1 => ['Standard', 'Classic', 'Basic', 'Essential'],
            2 => ['Pro', 'Plus', 'Premium', 'Advanced'],
            3 => ['Elite', 'Ultra', 'Deluxe', 'Signature', 'Luxury'],
        ];
        
        $variantSuffixes = $suffixes[$variant] ?? $suffixes[1];
        return $variantSuffixes[array_rand($variantSuffixes)];
    }
}