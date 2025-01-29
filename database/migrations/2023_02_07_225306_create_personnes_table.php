<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table réprésentant une personne.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('langue');
            $table->string('genre');
            $table->string('religion');
            $table->string('pays');
            $table->string('indicatif');
            $table->boolean('internet');
            $table->timestamps();
        });
    }

    /**
     * On supprime la table, si elle existe, pour la recréer.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnes');
    }
};
