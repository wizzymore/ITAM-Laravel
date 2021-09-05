<?php

namespace Database\Seeders;

use App\Domain\Assets\Models\Asset;
use App\Domain\Assets\Models\ProductMaker;
use App\Domain\Assets\Models\ProductType;
use App\Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@itam.test')->find(1)) {
            User::factory()->create([
                'email' => 'admin@itam.test'
            ]);
        }

        if (ProductType::count() === 0) {
            ProductType::factory()->createMany([
                [
                    'name' => 'Laptop'
                ],
                [
                    'name' => 'Desktop'
                ]
            ]);
        }

        if (ProductMaker::count() === 0) {
            ProductMaker::factory()->create(
                [
                    'name' => 'Dell'
                ]
            );
        }

        Asset::factory(10)->create();
    }
}
