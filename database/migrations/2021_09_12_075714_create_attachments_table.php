<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('file')->default('file.pdf');
            $table->string('title')->default('title');
            $table->double('size')->default('0');
            $table->boolean('type')->default(false);
            $table->unsignedBigInteger('attachmentable_id')->nullable();

            $table->string('attachmentable_type')->nullable();
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
        Schema::dropIfExists('attachments');
    }
}
