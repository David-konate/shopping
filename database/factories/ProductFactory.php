<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        // Obtenez un ID d'utilisateur existant de manière aléatoire
        $userId = User::inRandomOrder()->first()->id;

        return [
            'name' => $this->faker->word,
            'presentation' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'stock' => $this->faker->randomNumber(2),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'welcome' => $this->faker->randomElement([true, false, false, false, false]), // 80% de chance d'être false, 20% d'être true
        ];
    }
}
