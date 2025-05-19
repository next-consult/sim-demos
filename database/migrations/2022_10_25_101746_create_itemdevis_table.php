<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemdevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemdevis', function (Blueprint $table) {
            $table->id();
            $table->string('produit')->nullable();
            $table->longText('description');
            $table->string('quantites');
            $table->string('prix_ht');
            $table->string('tva');
            $table->string('type_remise')->nullable();
            $table->string('type_tva')->nullable();
            $table->string('remise')->nullable();
            $table->string('total_ht');
            $table->string('total_remise');
            $table->string('total_tva');
            $table->string('total_ttc');
            $table->string('devis_id');
            $table->string('catalogue_id')->nullable();
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
        Schema::dropIfExists('itemdevis');
    }
}
