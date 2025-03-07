<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $categories = CategoryFactory::new()->count(10)->create();

        return [
            // title is json {en: 'title', ar: 'title'}
            'title'=>[
                'en'=>fake()->sentence(3),
                'ar'=>fake()->sentence(3)
            ],
            'content'=>[
                'en'=>fake()->paragraph(6),
                'ar'=>fake()->paragraph(6)
            ],
            'category_id'=> $categories->random()->id,
            'created_at'=>now()
        ];
    }
}
