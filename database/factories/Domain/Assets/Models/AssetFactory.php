<?php

namespace Database\Factories\Domain\Assets\Models;

use App\Domain\Assets\Models\Asset;
use App\Domain\Assets\Models\AssetType;
use App\Domain\Assets\Models\Product;
use App\Domain\Employees\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serial' => sprintf("%07d", $this->faker->numberBetween(12000, 13999)),
            'asset_type_id' => function () {
                return AssetType::inRandomOrder()->first()->id;
            },
            'product_id' => function () {
                return Product::factory()->create()->id;
            },
            'employee_id' => function () {
                return Employee::factory()->create()->id;
            },
            'primire' => Carbon::now()->toDate(),
            'invoice' => Carbon::now()->toDate()
        ];
    }
}
