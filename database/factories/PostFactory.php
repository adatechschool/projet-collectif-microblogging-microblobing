<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(3), // Une phrase de 5 mots
            "content" => fake()->text(), 
            "tag" => fake() -> sentence(1),// Une chaîne de texte de 200 caractères (par défaut)
            "user_id" => User::inRandomOrder()->first()
        ];
    }
}
