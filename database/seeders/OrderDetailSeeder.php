<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Récupère toutes les commandes et produits disponibles dans la base de données
        $orders = Order::all();
        $products = Product::all();

        // Remplis la table OrderDetail avec des données fictives
        foreach ($orders as $order) {
            foreach ($products as $product) {
                OrderDetail::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 10), // Change this to suit your requirements
                    'unit_price' => $product->price, // You might want to modify this based on your logic
                ]);
            }
        }
    }
}
