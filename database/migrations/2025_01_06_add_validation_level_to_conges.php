<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidationLevelToConges extends Migration
{
    public function up()
    {
        Schema::table('conges', function (Blueprint $table) {
            $table->enum('validation_level', ['niveau1', 'niveau2', 'refuse', 'accepte'])->default('niveau1');
            $table->unsignedBigInteger('validated_by_level1')->nullable();
            $table->unsignedBigInteger('validated_by_level2')->nullable();
        });
    }

    public function down()
    {
        Schema::table('conges', function (Blueprint $table) {
            $table->dropColumn('validation_level');
            $table->dropColumn('validated_by_level1');
            $table->dropColumn('validated_by_level2');
        });
    }
} 