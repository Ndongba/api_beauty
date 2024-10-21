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
        Schema::table('professionnels', function (Blueprint $table) {
            $table->string('telephone', 20); // Utilisation de string pour un numéro de téléphone (limité à 20 caractères)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionnels', function (Blueprint $table) {
            $table->dropColumn('telephone');
        });
    }
};
