<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::inRandomOrder()->first()->id,
            'receiver_id' =>User::inRandomOrder()->first()->id,
            'subject' => $this->faker->sentence,
            'message' => $this->faker->text($maxNbChars = 852),
            'read_at' => null, // You can adjust this based on your logic
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
