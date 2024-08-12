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
        Schema::create('liste_nationals', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->integer("numelecteur");
            $table->string("sexe");
            $table->string("profession")->nullable();
            $table->date("datenaiss");
            $table->string("lieunaiss");
            $table->string("numcni");
            $table->string("type");
            $table->unsignedBigInteger("liste_id");
            $table->foreign("liste_id")
            ->references("id")
            ->on("listes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liste_nationals');
    }
};
