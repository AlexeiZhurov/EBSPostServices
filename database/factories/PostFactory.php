<?php

namespace Database\Factories;

use App\Domain\Posts\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            "title" => $this->faker->company(),
            "preview" => $this->faker->imageUrl(360, 360, 'animals', true, 'cats'),
            "tags" => $this->faker->word(),
            "text" => $this->faker->paragraph(),
            "user_id" => $this->faker->randomDigit(),
        ];
    }
}
