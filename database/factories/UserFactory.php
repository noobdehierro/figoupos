<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Roberto Guzman',
            'role_id' => 1,
            'brand_id' => 0,
            'email' => 'roberto.guzman@leancommerce.mx',
            'email_verified_at' => now(),
            'password' => '$2y$10$jPNQiy5hnP4Vqk9inlnh1Ob06capgEo5xxG9HX7hJQ8yaSa2yzTCe', // Admin1234
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
