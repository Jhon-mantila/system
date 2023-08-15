<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' =>  (string) Uuid::uuid4(),
            'name' => $this->faker->name(),
            'nit' => $this->faker->numberBetween(20000, 10000000),
            'web' => "https://3ztech.com.co",
            'direction' => $this->faker->address(),
            'city' => $this->faker->city(),
            'mobile' => $this->faker->phoneNumber(),
            'phone' => $this->faker->phoneNumber(),
            'agent' => $this->faker->name(),
            'logo' => "https://3ztech.com.co",
            'user_id' => 1,
        ];
    }
}
