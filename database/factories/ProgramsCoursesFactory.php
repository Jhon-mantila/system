<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Programs;
use App\Models\Course;
use Ramsey\Uuid\Uuid;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramsCourses>
 */
class ProgramsCoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $programs_id = Programs::pluck('id');
        $courses_id = Course::pluck('id');
        
        return [
            //
            'id' => (string) Uuid::uuid4(),
            'programs_id' =>  $this->faker->randomElement($programs_id),
            'course_id' =>  $this->faker->randomElement($courses_id),
        ];
    }
}
