<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $eventTypes = [
            'The Flow Worship Gathering',
            'Birmingham House of Prayer (BHOP)',
            'Missional Kingdom Community Event',
            'Discipleship Hub Meetup',
            'University Footprint Mission',
        ];

        // --- UPCOMING EVENTS ---
        for ($i = 1; $i <= 5; $i++) {
            $starts = Carbon::now()->addDays(fake()->numberBetween(3, 20));
            $ends = $starts->copy()->addHours(4);

            Event::create([
                'title'        => "Upcoming Event $i",
                'description'  => "A future gathering inspired by EveryCity's mission.",
                'first_name'   => fake()->firstName(),
                'last_name'    => fake()->lastName(),
                'email'        => fake()->unique()->safeEmail(),
                'phone'        => fake()->phoneNumber(),
                'max_tickets'  => fake()->numberBetween(50, 300),
                'starts_at'    => $starts,
                'ends_at'      => $ends,
                'status'       => 'upcoming',
                'event_type'   => Arr::random($eventTypes),
            ]);
        }

        // --- CURRENT EVENTS ---
        for ($i = 1; $i <= 5; $i++) {
            $starts = Carbon::now()->subHours(fake()->numberBetween(1, 2));
            $ends = Carbon::now()->addHours(fake()->numberBetween(1, 4));

            Event::create([
                'title'        => "Current Event $i",
                'description'  => "A live EveryCity event focused on prayer and mission.",
                'first_name'   => fake()->firstName(),
                'last_name'    => fake()->lastName(),
                'email'        => fake()->unique()->safeEmail(),
                'phone'        => fake()->phoneNumber(),
                'max_tickets'  => fake()->numberBetween(50, 300),
                'starts_at'    => $starts,
                'ends_at'      => $ends,
                'status'       => 'current',
                'event_type'   => Arr::random($eventTypes),
            ]);
        }

        // --- PAST EVENTS ---
        for ($i = 1; $i <= 5; $i++) {
            $starts = Carbon::now()->subDays(fake()->numberBetween(5, 20));
            $ends   = $starts->copy()->addHours(4);

            Event::create([
                'title'        => "Past Event $i",
                'description'  => "A past EveryCity event for prayer and discipleship.",
                'first_name'   => fake()->firstName(),
                'last_name'    => fake()->lastName(),
                'email'        => fake()->unique()->safeEmail(),
                'phone'        => fake()->phoneNumber(),
                'max_tickets'  => fake()->numberBetween(50, 300),
                'starts_at'    => $starts,
                'ends_at'      => $ends,
                'status'       => 'past',
                'event_type'   => Arr::random($eventTypes),
            ]);
        }
    }
}
