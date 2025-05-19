<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoncommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boncommandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('type')->nullable();
            $table->string('date');
            $table->string('fournisseur_id');
            $table->string('entreprise_id');
            $table->string('status');
            $table->string('devise')->default('TND');
            $table->double('commande_ht')->default(0);
            $table->double('commande_tva')->default(0);
            $table->double('commande_ttc')->default(0);
            $table->double('commande_remise')->default(0);
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
        Schema::dropIfExists('boncommandes');
    }
}
