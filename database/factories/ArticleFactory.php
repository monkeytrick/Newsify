<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Article::class;

    public function definition(): array
    {
        return [
            //
            'publication' => 'The Sun',
            'country' => 'uk',
            'title' => 'Big Titties',
            'views' => 10,
            'search_type' => 'default'
            
        ];
    }
}
