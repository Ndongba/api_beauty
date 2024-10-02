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
        Schema::create('images_professionnels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professionnel_id');
            $table->foreign('professionnel_id')->references('id')->on('professionnels')->onDelete('cascade');
            $table->string('image_path'); // Chemin de l'image sur le disque local
            $table->string('image_type')->nullable(); // Type de l'image (facultatif, exemple: couverture, galerie)
            $table->integer('ordre')->nullable(); // Indique l'ordre d'affichage de l'image (facultatif)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_professionnels');
    }
};
