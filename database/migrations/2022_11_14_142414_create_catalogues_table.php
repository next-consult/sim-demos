<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCataloguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('produit');
            $table->longText('description');
            $table->string('quantites');
            $table->string('prix_ht');
            $table->string('categorie');
            $table->string('fournisseur_id')->nullable();
            $table->string('prix_achat')->nullable();
            $table->string('tva');
            $table->string('type_remise')->nullable();
            $table->string('remise')->nullable();
            $table->string('total_ht')->default(0);
            $table->string('total_remise')->default(0);
            $table->string('total_tva')->default(0);
            $table->string('total_ttc')->default(0);

            $table->string('numero_cle')->nullable();
            $table->string('packcle_id')->nullable();
            $table->string('facture_id')->nullable();
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
        Schema::dropIfExists('catalogues');
    }
}
