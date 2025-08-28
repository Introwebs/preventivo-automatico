<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\ServiceKeyword;

class ServiceKeywordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceKeyword::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'name' => $this->faker->name(),
            'priority' => $this->faker->numberBetween(-8, 8),
            'is_exclusive' => $this->faker->boolean(),
        ];
    }
}
