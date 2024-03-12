<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('reciept');
            $table->string('photo', 255);
            $table->string('name');
            $table->string('last_exam');
            $table->string('father_name');
            $table->string('email');
            $table->string('phone');
            $table->string('father_phone');
            $table->string('joining_date');
            $table->enum('status', ['Student', 'Employee', 'Other']);//Student or Employee
            $table->string('current_college_year');
            $table->string('college_name');
            $table->string('college_address');
            $table->string('villege');
            $table->string('town');
            $table->string('district');
            $table->string('post_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
