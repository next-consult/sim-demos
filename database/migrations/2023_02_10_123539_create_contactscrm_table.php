<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactscrmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactscrm', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('raison_social')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email')->nullable();

            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mf')->nullable();
            $table->string('secteur')->nullable();
            $table->string('poste')->nullable();

            $table->longText('web')->nullable();
            $table->longText('fax')->nullable();
            $table->longText('adresse')->nullable();
            $table->longText('code_postal')->nullable();

            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();

            $table->longtext('comentaire')->nullable();
            $table->string('photo')->nullable();

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
        Schema::dropIfExists('contactscrm');
    }
}
