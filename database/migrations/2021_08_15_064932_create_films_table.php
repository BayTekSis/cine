<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('film_name');
            $table->date('film_release_date');
            $table->integer('genre_id');
            $table->text('detail');
            $table->double('film_price');
            $table->integer('film_duration');
            $table->string('film_file');
            $table->double('film_rate');
            $table->string('film_trailer');
            $table->string('film_slug');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
