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
        Schema::create('bmi_records', function (Blueprint $table) {
            $table->id();
            // Foreign key: bmi_id corresponds to the id of the BMI table
            $table->unsignedBigInteger('bmi_id');
            // Column to store the BMI value
            $table->float('BMI');
            $table->float('height');
            $table->float('weight');
            $table->enum('category', ['UNDERWEIGHT', 'NORMAL_WEIGHT', 'OVERWEIGHT', 'OBESE']);
            // Default timestamp columns (created_at, updated_at)
            $table->string('token')->unique(); // Add token column
            $table->timestamps();
            // Define the foreign key constraint
            $table->foreign('bmi_id')->references('id')->on('bmi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmi_records');
    }
};
