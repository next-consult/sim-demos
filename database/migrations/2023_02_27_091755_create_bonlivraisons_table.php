<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonlivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonlivraisons', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('date');
            $table->string('client_id');
            $table->string('entreprise_id');
            $table->string('status');
            $table->string('devis_id')->nullable();
            $table->longText('condition')->nullable();
            $table->longText('footer')->nullable();
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
        Schema::dropIfExists('bonlivraisons');
    }
}
