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
        Schema::table('listes', function (Blueprint $table) {
            $table->boolean("etat")->default(0);
            $table->boolean("verif")->default(0);
            $table->text("commentaire")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listes', function (Blueprint $table) {
            $table->dropColumn('column');("etat");
            $table->dropColumn("verif");
            $table->dropColumn("commentaire");
    
        });
    }
};
