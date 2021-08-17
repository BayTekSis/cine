<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_seats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ticket_seats_cinema_film_id');
            $table->integer('ticket_seats_seat_id');
            $table->integer('ticket_seats_ticket_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_seats');
    }
}
