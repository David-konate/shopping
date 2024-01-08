<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $orders = Order::factory(20)->create();

        $products = Product::all();


        foreach ($orders as $order) {
            // Choisis un nombre aléatoire de produits à ajouter à la commande
            $numProductsToAdd = rand(1, count($products));

            // Mélange la collection de produits
            $shuffledProducts = $products->shuffle();

            // Prends les premiers $numProductsToAdd produits de la collection mélangée
            $selectedProducts = $shuffledProducts->take($numProductsToAdd);

            // Attache les produits à la commande avec une quantité aléatoire
            $order->products()->attach($selectedProducts->pluck('id'), ['quantity' => rand(1, 10)]);
        }
    }
}
