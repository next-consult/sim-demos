<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('nom');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mf')->nullable();
            $table->string('rne')->nullable();
            $table->string('type')->nullable();
            $table->string('raison_social')->nullable();
            $table->string('categorie_id')->nullable();
            $table->string('categorie_text')->nullable();

            $table->double('total')->default('0');
            $table->double('solde')->default('0');
            $table->double('paye_total')->default('0');
            $table->double('paye_factures')->default('0');
            $table->double('paye_avance')->default('0');
            $table->string('photo')->nullable();
            $table->longText('adresse')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('fax')->nullable();
            $table->string('web')->nullable();
            $table->string('status_date')->nullable();
            $table->string('status_montant')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
