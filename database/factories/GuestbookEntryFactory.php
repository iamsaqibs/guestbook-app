<?php

namespace Database\Factories;

use App\Models\GuestbookEntry;
use App\Models\Submitter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuestbookEntry>
 */
class GuestbookEntryFactory extends Factory
{
    protected $model = GuestbookEntry::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'submitter_id' => Submitter::factory()->create()->id,
        ];
    }
}
