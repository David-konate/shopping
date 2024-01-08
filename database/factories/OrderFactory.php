<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {

                return User::inRandomOrder()->first()->id;

            },
            'order_date' => $this->faker->dateTimeThisMonth,
            'status' => $this->faker->randomElement([0, 1, 2, 3, 4]),
            // Ajoutez d'autres colonnes et attributs de votre modèle ici
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            // Ajoutez ici la logique pour associer des produits à la commande si nécessaire
        });
    }
}
