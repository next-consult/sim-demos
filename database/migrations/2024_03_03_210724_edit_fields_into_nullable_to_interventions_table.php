<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFieldsIntoNullableToInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->date('datefin')->nullable()->change();
            $table->date('datedebut')->nullable()->change();
            $table->string('repeat_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->date('datefin')->nullable(false)->change();
            $table->date('datedebut')->nullable(false)->change();
            $table->string('repeat_type')->nullable(false)->change();
        });
    }
}
