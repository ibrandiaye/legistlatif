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
        Schema::create('validation_nationals', function (Blueprint $table) {
            $table->id();
            $table->integer("etat");
            $table->unsignedBigInteger("liste_id");
            $table->foreign("liste_id")
            ->references("id")
            ->on("listes");
            $table->text("commentaire")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validation_nationals');
    }
};
