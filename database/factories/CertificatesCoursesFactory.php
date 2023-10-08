<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Employees;
use App\Models\Course;
use App\Models\Students;
use Ramsey\Uuid\Uuid;
use App\Services\DropdownService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CertificatesCourses>
 */
class CertificatesCoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student_id = Students::pluck('id');
        $employee_id = Employees::pluck('id');
        $company_id = Company::pluck('id');
        $courses_id = Course::pluck('id');

        $activeOptions = new DropdownService();
        
        return [
            //
            'id' =>  (string) Uuid::uuid4(),
            'courses_id' =>  $this->faker->randomElement($courses_id),
            'student_id' =>  $this->faker->randomElement($student_id),
            'employee_id' =>  $this->faker->randomElement($employee_id),
            'date_start' =>  $this->faker->date(),
            'date_end' =>  $this->faker->date(),
            'type_certificate' =>  $this->faker->randomElement(array_keys($activeOptions->getTypeCertificate())),
            'company_id' =>  $this->faker->randomElement($company_id),
            'accredited' =>  $this->faker->numberBetween(0, 1),
            'notified' =>  $this->faker->numberBetween(0, 1),
            'user_id' => 1,
        ];
    }
}
