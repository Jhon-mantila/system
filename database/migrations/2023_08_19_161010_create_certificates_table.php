<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('code');
            $table->uuid('program_id');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->uuid('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_certificate')->nullable();
            $table->string('type_certificate')->nullable();
            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('title')->nullable();
            $table->string('type_code')->nullable();
            $table->string('references')->nullable();
            $table->string('process')->nullable();
            $table->integer('book')->nullable();
            $table->integer('acta')->nullable();
            $table->integer('folio')->nullable();
            $table->integer('accredited')->nullable();
            $table->integer('notified')->nullable();
            $table->string('module');
            $table->string('file')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
