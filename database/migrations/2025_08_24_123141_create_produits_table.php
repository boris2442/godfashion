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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            
            $table->string('nom_produit');
            $table->text('description')->nullable();
            $table->string('couleur')->nullable();
            $table->string('taille')->nullable();
            $table->string('matiere')->nullable();
            $table->decimal('prix_unitaire', 8, 2)->nullable();
            $table->string('unite')->nullable()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
