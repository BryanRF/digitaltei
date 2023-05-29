<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Contract;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Contract::class;
    public function definition()
    {
        $startDate = $this->faker->date();
        $monthsToAdd = $this->faker->numberBetween(3, 6); // Genera un número aleatorio entre 3 y 6
        $endDate = Carbon::parse($startDate)->addMonths($monthsToAdd)->format('Y-m-d');
        
        return [
            'employee_id' => rand(1, 10),
            'job_id' => rand(1, 5),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $this->faker->jobTitle,
            'salary' => $this->faker->numberBetween(1000, 5000),
        ];
    }
}
