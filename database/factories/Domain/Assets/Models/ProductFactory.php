<?php

namespace Database\Factories\Domain\Assets\Models;

use App\Domain\Assets\Models\Product;
use App\Domain\Assets\Models\ProductMaker;
use App\Domain\Assets\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model' => 'OPTIPLEX ' . $this->faker->unique()->numberBetween(100, 999),
            'product_maker_id' => function () {
                return ProductMaker::inRandomOrder()->first()->id;
            },
            'product_type_id' => function () {
                return ProductType::inRandomOrder()->first()->id;
            }
        ];
    }
}
