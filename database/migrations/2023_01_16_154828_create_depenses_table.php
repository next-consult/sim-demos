<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('date');
            $table->string('date_paiement');
            $table->string('fournisseur_id')->nullable();
            $table->string('entreprise_id')->nullable();
            $table->string('status')->nullable();
            $table->double('retenu')->default(0);
            $table->double('facture_retenu')->default(1);
            $table->double('facture_ht')->default(0);
            $table->double('facture_tva')->default(0);
            $table->double('facture_debour')->default(0);
            $table->double('facture_remise')->default(0);
            $table->double('facture_paye')->default(0);
            $table->double('facture_solde')->default(0);
            $table->double('facture_ttc')->default(0);
            $table->double('timbre')->default(1);
            $table->string('footer')->nullable();
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
        Schema::dropIfExists('depenses');
    }
}
