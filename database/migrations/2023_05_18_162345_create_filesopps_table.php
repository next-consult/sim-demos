<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesoppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filesopps', function (Blueprint $table) {
            $table->id();
            $table->string('fichier');
            $table->string('type');
            $table->string('montant')->nullable();
            $table->string('date')->nullable();
            $table->string('oportunity_id');
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
        Schema::dropIfExists('filesopps');
    }
}
