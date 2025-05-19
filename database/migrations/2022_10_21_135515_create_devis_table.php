<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('type')->nullable();
            $table->string('date');
            $table->string('client_id');
            $table->string('entreprise_id');
            $table->string('status');
            $table->double('devis_ht')->default(0);
            $table->double('devis_tva')->default(0);
            $table->double('devis_ttc')->default(0);
            $table->double('devis_remise')->default(0);
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
        Schema::dropIfExists('devis');
    }
}
