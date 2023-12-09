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
        Schema::create('legal_advice_order_details', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('researcher_name');
            $table->string('researcher_title');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('time_id');
            $table->foreign('time_id')->references('id')->on('times')->onDelete('cascade');
            $table->string('meet_link');
            $table->integer('type');
            $table->integer('case_language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_advice_order_details');
    }
};
