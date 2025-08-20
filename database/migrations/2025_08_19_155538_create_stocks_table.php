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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nom_article'); // ex: "Soie rouge", "Boutons nacrés"
            $table->string('type_article'); // ex: "Tissu", "Accessoire"
            $table->integer('quantite'); // quantité disponible
            $table->decimal('prix_unitaire', 10, 2)->nullable(); // prix d'achat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
