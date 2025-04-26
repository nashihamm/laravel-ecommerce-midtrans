<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get random category and seller IDs
        $categoryId = Category::exists() ? Category::inRandomOrder()->first()->id : null;
        $sellerId = User::where('role', 'seller')->exists() ? 
            User::where('role', 'seller')->inRandomOrder()->first()->id : null;

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->numberBetween(50000, 5000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => $categoryId,
            'seller_id' => $sellerId,
            'image' => null, // This will be set in the seeder
        ];
    }
}