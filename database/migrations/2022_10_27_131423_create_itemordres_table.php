<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemordresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemordres', function (Blueprint $table) {
            $table->id();
            $table->string('adress_enlev')->nullable();
            $table->string('date_enlev')->nullable();
            $table->string('nom_enlev')->nullable();
            $table->string('adress_livraison')->nullable();
            $table->string('date_livraison')->nullable();
            $table->string('nom_livraison')->nullable();
            $table->string('nature')->nullable();
            $table->string('poids')->nullable();
            $table->string('nb_coliss')->nullable();
            $table->string('volume')->nullable();
            $table->string('specif')->nullable();
            $table->string('no_dossier')->nullable();
            $table->longText('remarques')->nullable();
            $table->string('prix_achat')->nullable();
            $table->string('prix_vente')->nullable();
            $table->string('chauffeur_id')->nullable();
            $table->string('camion_id')->nullable();
            $table->string('matricule_camion')->nullable();
            $table->longText('evaluation')->nullable();
            $table->string('ordre_id');
            $table->string('itemdevis_id');
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
        Schema::dropIfExists('itemordres');
    }
}
