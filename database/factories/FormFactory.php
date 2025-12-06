<?php

namespace Database\Factories;

use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormFactory extends Factory
{
    protected $model = Form::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['contact', 'prayer', 'bhop_application', 'mail_list']),
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['pending', 'reviewed', 'resolved']),
        ];
    }

    public function contact(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'contact',
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
        ]);
    }

    public function prayer(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'prayer',
            'address' => fake()->address(),
            'type_of_prayer' => fake()->randomElement(['Healing', 'Guidance', 'Thanksgiving', 'Intercession']),
            'prayer_request' => fake()->paragraph(),
        ]);
    }

    public function bhopApplication(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'bhop_application',
            'location' => fake()->city(),
            'church' => fake()->company() . ' Church',
            'team_volunteering_to' => fake()->randomElement(['Media', 'Ushering', 'Protocol', 'Welfare']),
            'want_to_be_part_of_team' => fake()->boolean(),
            'reason' => fake()->paragraph(),
        ]);
    }

    public function mailList(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'mail_list',
            'content' => fake()->optional()->sentence(),
        ]);
    }
}
