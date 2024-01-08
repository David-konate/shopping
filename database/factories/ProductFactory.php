<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
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
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'stock' => $this->faker->randomNumber(2),
            'image_url' => $this->faker->imageUrl(),
            'user_id' => $userId,
            // Ajoutez d'autres colonnes et attributs de votre modèle ici
        ];
    }
}
