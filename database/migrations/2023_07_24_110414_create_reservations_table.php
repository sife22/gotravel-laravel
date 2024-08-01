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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date_reservation');
            $table->boolean('etat_validation')->default(false);
            $table->string('type');
            $table->unsignedBigInteger('client_id')->nullable()->default(null);
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('voyage_id')->nullable()->default(null);
            $table->foreign('voyage_id')->references('id')->on('voyages');
            $table->unsignedBigInteger('agence_id')->nullable()->default(null);
            $table->foreign('agence_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
