<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition()
    {
        $order = Order::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();

        return [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $product->price,
            // Ajoutez d'autres colonnes si nécessaire
        ];
    }
}
