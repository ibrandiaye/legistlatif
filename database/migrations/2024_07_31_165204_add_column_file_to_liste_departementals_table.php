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
            $table->string("extrait_ou_cni")->nullable();
            $table->string("casier")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liste_departementals', function (Blueprint $table) {
            $table->dropColumn("extrait_ou_cni");
            $table->dropColumn("casier");
        });
    }
};
