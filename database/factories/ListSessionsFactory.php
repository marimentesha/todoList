<?php

namespace Database\Factories;

use App\Models\listSessions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<listSessions>
 */
class ListSessionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusKey = Arr::random([
            'todo',
            'progress',
            'done'
        ]);
        $userId = User::inRandomOrder()->first()->id;
        $itemArray = [
            'id' => uniqid(),
            'data' => fake()->sentence(10),
            'user_id' => $userId,
        ];

        $finalArray = [
            $statusKey => $itemArray,
        ];

        $serializedArray = serialize($finalArray);

        return [
            'id' => fake()->uuid(),
            'data' => $serializedArray,
            'user_id' => $userId,
        ];
    }
}
