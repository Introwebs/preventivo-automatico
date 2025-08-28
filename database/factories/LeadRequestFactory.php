<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Lead;
use App\Models\LeadRequest;

class LeadRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeadRequest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'request_text' => $this->faker->text(),
            'note' => $this->faker->text(),
        ];
    }
}
