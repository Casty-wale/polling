<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answerId');
            $table->string('questionNumber');
            $table->string('answers');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            // $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('questionId');
            $table->foreign('questionId')->references('questionId')->on('questions');
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('answers');
    }
};
