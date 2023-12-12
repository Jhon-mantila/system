<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create();
        \App\Models\Company::factory()->create();
        \App\Models\Employees::factory()->create();
        
        \App\Models\Programs::factory(50)->create();
        \App\Models\Students::factory(10)->create();
        \App\Models\Company::factory(1)->create();
        \App\Models\Certificate::factory(150)->create();
        \App\Models\Course::factory(50)->create();
        \App\Models\ProgramsCourses::factory(50)->create();
        \App\Models\CertificatesCourses::factory(150)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
