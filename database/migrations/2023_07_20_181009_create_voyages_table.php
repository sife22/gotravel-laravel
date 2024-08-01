<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 30);
            $table->string('type');
            $table->longText('desc');
            $table->json('description');
            $table->float('prix', 10);
            $table->string('categorie', 30);
            $table->string('pays', 30);
            $table->string('ville', 30);
            $table->char('nombre_vues', 10);
            $table->boolean('vip')->default(false);
            $table->date('date_expiration', 30);
            $table->date('date_depart', 30);
            $table->date('date_retour', 30);
            $table->date('date_ajoute');
            $table->unsignedBigInteger('agence_id');
            $table->foreign('agence_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
