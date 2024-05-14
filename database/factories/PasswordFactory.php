<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'password' => static::$password ??= Hash::make('password'),
            'login' => fake()->word(),
            'description' => fake()->paragraph(),
            'website_id' => fake()->numberBetween(1,3),
            'user_id' => fake()->numberBetween(1,10)
        ];
    }
}
