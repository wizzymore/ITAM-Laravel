<?php

namespace Database\Factories\Domain\Assets\Models;

use App\Domain\Assets\Models\ProductMaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductMakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductMaker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ''
        ];
    }
}
