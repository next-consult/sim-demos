<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturecontratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturecontrats', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('date_paiement')->nullable();
            $table->string('status')->nullable();
            $table->double('facture_ht')->default(0);
            $table->double('facture_tva')->default(0);
            $table->double('facture_debour')->default(0);
            $table->double('facture_remise')->default(0);
            $table->double('facture_paye')->default(0);
            $table->double('facture_solde')->default(0);
            $table->double('facture_ttc')->default(0);
            $table->double('timbre')->default(1);
            $table->string('footer')->nullable();
            $table->string('contrat_id')->nullable();
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
        Schema::dropIfExists('facturecontrats');
    }
}
