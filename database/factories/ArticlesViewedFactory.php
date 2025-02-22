<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ArticlesViewed;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticlesViewed>
 */
class ArticlesViewedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    // Specify model to use
    protected $model = ArticlesViewed::class;
    
    public function definition(): array
    {
        return [
            //
            'title' => 'Default',
            'views' => '1',
            'url' => 'Default',
            'publication_id' => '1'
        ];
    }
}
