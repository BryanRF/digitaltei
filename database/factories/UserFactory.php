<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employeesIds = Employee::pluck('id')->toArray();
        $counter = 1;
        return [
            'name' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(),
            'email_verified_at' => now(),
            'user_type_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'employee_id' => function() use ($counter, $employeesIds) {
                $result = $employeesIds[$counter - 1];
                $counter++;
                return $result;
            },
        ];
    }
}
