<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinema_films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cinema_film_cinema_id');
            $table->integer('cinema_film_film_id');
            $table->integer('cinema_film_seance_id');
            $table->date('cinema_film_date_start');
            $table->date('cinema_film_date_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cinema_films');
    }
}
