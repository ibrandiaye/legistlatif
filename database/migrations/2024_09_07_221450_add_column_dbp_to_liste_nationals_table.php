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
            $table->string("doublon_externe")->nullable();
            $table->string("doublon_interne")->nullable();
            $table->string("parite")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liste_nationals', function (Blueprint $table) {
            $table->dropColumn("doublon_externe");
            $table->dropColumn("doublon_interne");
            $table->dropColumn("parite");
        });
    }
};
