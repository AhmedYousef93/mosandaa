<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_time_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_id')->nullable()->constrained('times')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_time_dates');
    }
};
