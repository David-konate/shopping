<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solde>
 */
class SoldeFactory extends Factory
{
    public function definition(): array
    {
        // Récupère un ID utilisateur aléatoire
        $userId = $this->faker->randomElement(User::pluck('id')->toArray());

        // Génère une date de début aléatoire dans l'intervalle des 3 derniers jours à aujourd'hui plus 12 jours
        $startDate = $this->faker->dateTimeBetween('-3 days', '+12 days');

        // Génère une date de fin aléatoire dans l'intervalle de la date de début à 30 jours plus tard
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->modify('+30 days'));

        // Génère un pourcentage aléatoire
        $percentage = $this->faker->randomFloat(2, 0, 100);

        // Détermine aléatoirement si la solde sera liée à un produit ou à une catégorie
        $isProduct = $this->faker->boolean;

        if ($isProduct) {
            // Récupère un ID de produit aléatoire
            $productId = $this->faker->randomElement(Product::pluck('id')->toArray());

            return [
                'name' => $this->faker->word,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $percentage,
                'user_id' => $userId,
                'product_id' => $productId,
                'category_id' => null, // Set category_id to null when the solde is linked to a product
            ];
        } else {
            // Récupère un ID de catégorie aléatoire
            $categoryId = $this->faker->randomElement(Category::pluck('id')->toArray());

            return [
                'name' => $this->faker->word,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $percentage,
                'user_id' => $userId,
                'product_id' => null, // Set product_id to null when the solde is linked to a category
                'category_id' => $categoryId,
            ];
        }
    }
}
