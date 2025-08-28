<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'short_description' => $this->faker->text(),
            'description' => $this->faker->text(),
            'base_price' => $this->faker->randomFloat(2, 0, 99999999.99),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
