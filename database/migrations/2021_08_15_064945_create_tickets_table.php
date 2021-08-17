<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ticket_user_id');
            $table->integer('ticket_cinema_id');
            $table->integer('ticket_film_id');
            $table->integer('ticket_seance_id');
            $table->integer('ticket_seat_id');
            $table->integer('ticket_cinema_film_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
