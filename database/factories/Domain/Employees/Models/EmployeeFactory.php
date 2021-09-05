<?php

namespace Database\Factories\Domain\Employees\Models;

use App\Domain\Employees\Models\Department;
use App\Domain\Employees\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->unique()->lastName();
        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => strtolower($firstName . '.' . $lastName) . '@' . config('custom.domain'),
            'department_id' => function () {
                return Department::factory()->create()->id;
            }
        ];
    }
}
