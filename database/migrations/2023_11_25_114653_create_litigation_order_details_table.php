<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('litigation_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->longText('legitimate_documents')->nullable();
            $table->longText('statutory_documents')->nullable();
            $table->longText('legal_recommendation')->nullable();
            $table->json('strong_points')->nullable();
            $table->json('weakness_points')->nullable();
            $table->string('defendants_name')->nullable();
            $table->text('Jurisdiction')->nullable();
            $table->string('owner_case')->nullable();
            $table->string('prosecutor')->nullable();
            $table->string('id_number_accused')->nullable();
            $table->string('nationality_accused')->nullable();
            $table->integer('type');
            $table->boolean('admin_review')->default(false);
            $table->integer('case_language')->nullable();
            $table->boolean('need_to_arbitration')->default(false);
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('litigation_order_details');
    }
};
