<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\ServiceOption;

class ServiceOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceOption::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 99999999.99),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
