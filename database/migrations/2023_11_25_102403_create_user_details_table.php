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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nationality')->nullable();
            $table->string('sponsor_name')->nullable();
            $table->string('national_address')->nullable();
            $table->date('date_of_entering')->nullable();
            $table->string('passport_number')->nullable();
            $table->double('salary', 10, 2)->nullable();
            $table->string('sponsor_residence')->nullable();
            $table->string('labor_city')->nullable();
            $table->string('id_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
