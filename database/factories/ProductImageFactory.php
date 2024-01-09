<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $randomProductId = Product::inRandomOrder()->first()->id;

    return [
        'product_id' => $randomProductId,
        'image_url' => 'images/ps51.jpg'
    ];
}
}

