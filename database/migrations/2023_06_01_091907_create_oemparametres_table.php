<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOemparametresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oemparametres', function (Blueprint $table) {
            $table->id();
            $table->string('produit');
            $table->longText('description');
            $table->string('quantites')->default('1');
            $table->string('prix_ht');
            $table->string('tva');
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
        Schema::dropIfExists('oemparametres');
    }
}
