<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programs>
 */
class ProgramsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Datos falsos para la base de datos
            'id' =>  (string) Uuid::uuid4(),
            'code' => Str::random(10),
            'name' => $this->faker->name(),
            'credits' => $this->faker->numberBetween(1, 20),
            'hours' => $this->faker->numberBetween(1, 20),
            'active' => $this->faker->numberBetween(0, 1),
            'user_id' => 1,
        ];
    }
}
