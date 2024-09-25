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
        Schema::create('proprestations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professionnel_id');
            $table->foreign('professionnel_id')->references('id')->on('professionnels')->onDelete('cascade');
            $table->unsignedBigInteger('prestation_id');
            $table->foreign('prestation_id')->references('id')->on('prestations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprestations');
    }
};
