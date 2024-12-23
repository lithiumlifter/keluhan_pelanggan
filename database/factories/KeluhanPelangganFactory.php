<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeluhanPelanggan>
 */
class KeluhanPelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'nomor_hp' => $this->faker->numerify('0812########'),
            'status_keluhan' => $this->faker->randomElement(['0', '1', '2']),
            'keluhan' => $this->faker->text(255),
        ];
    }
}
