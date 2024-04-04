<?php

namespace Database\Factories;

use App\Models\GuestbookEntry;
use App\Models\Submitter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submitter>
 */
class SubmitterFactory extends Factory
{
    protected $model = Submitter::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'display_name' => $this->faker->userName,
            'real_name' => $this->faker->name,
        ];
    }
}
