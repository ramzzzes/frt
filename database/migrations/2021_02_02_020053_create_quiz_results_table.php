<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_session_id');
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('answer_id');
            $table->timestamps();

            $table->foreign('quiz_session_id')->references('id')->on('quiz_sessions');
            $table->foreign('quote_id')->references('id')->on('quote');
            $table->foreign('answer_id')->references('id')->on('answer');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_results');
    }
}
