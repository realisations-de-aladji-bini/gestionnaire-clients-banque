<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * la table "abonnes" représentant les clients de la banque 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('contact');
            $table->boolean('active');
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
        Schema::dropIfExists('abonnes');
    }
};
