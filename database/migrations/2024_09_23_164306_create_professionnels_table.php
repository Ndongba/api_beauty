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
        Schema::create('professionnels', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('registre_commerce');
            $table->text('ninea');
            $table->date('date_ouverture')->nullable();
            $table->date('date_fermeture')->nullable();
            $table->time('heure_ouverture')->nullable();
            $table->time('heure_fermeture')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionnels');
    }
};
