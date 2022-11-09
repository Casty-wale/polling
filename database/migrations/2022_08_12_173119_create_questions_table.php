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
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('questionId');
            $table->primary('questionId');
            $table->string('organisation')->nullable();
            $table->string('description')->nullable();
            $table->string('previousName');
            $table->string('questionName');
            $table->string('category');
            $table->string('questionPath');
            $table->string('critirial')->nullable();
            $table->enum('priority',["1", "2", "3"])->default("3");
            $table->date('startDate');
            $table->date('endDate')->nullable();
            // $table->foreignId('user_id')->constrained();

            // $table->unsignedBigInteger('user_id');
 
            // $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('questions');
    }
};
