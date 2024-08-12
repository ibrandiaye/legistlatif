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
        Schema::table('liste_departementals', function (Blueprint $table) {
            $table->string("domicile")->nullable();
            $table->string("se")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liste_departementals', function (Blueprint $table) {
            $table->dropColumn("domicile");
            $table->dropColumn("se");
        });
    }
};
