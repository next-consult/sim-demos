<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunitys', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('contactcrm_id');
            $table->string('expected_revenue');
            $table->string('rating')->nullable();
            $table->string('status')->nullable();
            $table->string('type_projet')->nullable();
            $table->string('step')->nullable();
            $table->string('date_deal')->nullable();
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
        Schema::dropIfExists('oportunitys');
    }
}
