<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomnotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customnotifs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('type_notif');
            $table->string('description');
            $table->string('client_type_notif')->nullable();
            $table->string('client_id')->nullable();
            $table->string('facture_id')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->string('camion_id')->nullable();
            $table->string('camion_type_notif')->nullable();
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
        Schema::dropIfExists('customnotifs');
    }
}
