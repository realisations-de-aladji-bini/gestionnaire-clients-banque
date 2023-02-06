<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('abonne_id')->unsigned();
            $table->foreign('abonne_id')->references('id')->on('abonne')->onUpdate('cascade')->onDelete('cascade');
            $table->string('libelle');
            $table->string('description');
            $table->integer('agence');
            $table->string('banque');
            $table->integer('numero');
            $table->integer('rib');
            $table->float('montant');
            $table->string('domiciliation');
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
        Schema::dropIfExists('comptes');
    }
};
