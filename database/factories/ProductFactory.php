<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ja_JP');
        $id = Product::max('id') + 1;
        $categories = Category::pluck('id')->toArray();
        $store_nos = Store::pluck('store_no')->toArray();
        return [
            'name' => 'Product ' . $id,
            'category_id' => $categories[array_rand($categories)],
            'store_no' => $store_nos[array_rand($store_nos)],
            'product_id' => '1234',
            'is_frozen' => $faker->numberBetween(0, 1),
            'unit' => $faker->numberBetween(1, 4),
            'volume' => '10',
            'created_at' => now(),
            'create_user' => 'GORO',
        ];
    }
}
