<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

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

    protected $model = Post::class;
    public function definition()
    {
        $privacy = ['public', 'friend', 'private'];
        return [
            'slug' => $this->faker->slug(),
            'user_id' => rand(1, 50),
            'caption' => $this->faker->paragraph(2),
            'privacy' => $privacy[rand(0, 2)],

        ];
    }
}
