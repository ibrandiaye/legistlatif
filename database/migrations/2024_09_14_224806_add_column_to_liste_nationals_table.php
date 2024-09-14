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
        Schema::table('liste_nationals', function (Blueprint $table) {
            $table->string("sur_le_fichier")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liste_nationals', function (Blueprint $table) {
            $table->dropColumn("sur_le_fichier");
        });
    }
};
