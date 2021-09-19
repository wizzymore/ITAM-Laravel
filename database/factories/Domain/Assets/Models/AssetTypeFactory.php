<?php

namespace Database\Factories\Domain\Assets\Models;

use App\Domain\Assets\Models\AssetType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssetType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => strtoupper($this->faker->lexify('???')),
        ];
    }
}
