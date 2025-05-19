<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInterventionIdToInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interventions', function (Blueprint $table) {
			$table->unsignedBigInteger('intervenant_id')->nullable();
            $table->foreign('intervenant_id')->references('id')->on('users');
            $table->string('intervenant')->nullable()->change();
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
			$table->dropForeign(['intervenant_id']);
            $table->dropColumn('intervenant_id');
            $table->string('intervenant')->nullable(false)->change();
        });
    }
}
