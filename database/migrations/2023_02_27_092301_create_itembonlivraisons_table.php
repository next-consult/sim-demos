<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItembonlivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itembonlivraisons', function (Blueprint $table) {
            $table->id();
            $table->string('produit')->nullable();
            $table->longText('description');
            $table->string('quantites');
            $table->string('bonlivraison_id');
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
        Schema::dropIfExists('itembonlivraisons');
    }
}
