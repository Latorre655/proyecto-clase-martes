<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition()
    {
        return [
            "name" => fake()->name(),
            "descripcion" => fake()->paragraph(),
            "price"=> fake()->randomFloat(2,100,100000),
            "category_id" => Category::inRandomOrder()->first()->id
        ];
    }
}
