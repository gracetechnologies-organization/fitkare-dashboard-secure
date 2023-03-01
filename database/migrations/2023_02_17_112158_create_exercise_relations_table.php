<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ex_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->tinyInteger('from_day')->nullable();
            $table->tinyInteger('till_day')->nullable();
            $table->foreign('ex_id')->references('id')->on('exercises')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
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
        Schema::dropIfExists('exercise_relations');
    }
}
