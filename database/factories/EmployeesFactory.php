<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Services\DropdownService;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
        $activeOptions = new DropdownService();

        return [
            //Datos falsos para la base de datos
            'id' =>  (string) Uuid::uuid4(),
            'type_document' => $this->faker->randomElement(array_keys($activeOptions->getTypeDocumento())),
            'document' => $this->faker->numberBetween(20000, 10000000),
            'first_name' => $this->faker->firstName(),
            'second_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'second_last_name' => $this->faker->lastName(),
            'mobile' => $this->faker->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'profession' => $this->faker->text(150),
            'specialty' => $this->faker->text(150),
            'description' => $this->faker->text(2000),
            'signature' => $this->faker->name(),
            'type_employee' => $this->faker->randomElement(array_keys($activeOptions->getTypeEmployee())),
            'active' => $this->faker->numberBetween(1, 2),
            'user_id' => 1,
        ];
    }
}
