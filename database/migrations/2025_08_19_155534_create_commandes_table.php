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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('type_habit');
            $table->text('tissu')->nullable(); // description du tissu (optionnel si géré par stock)
            $table->json('mesures')->nullable(); // ex: {"poitrine": 95, "taille": 80}
            $table->decimal('prix_total', 10, 2);
            $table->decimal('avance', 10, 2)->default(0);
            $table->decimal('reste', 10, 2)->storedAs('prix_total - avance'); // calculé automatiquement
            $table->date('date_livraison');
            $table->dateTime('date_livraison_reelle')->nullable();
            $table->enum('statut', ['En_cours', 'Terminé', 'Livré'])->default('En_cours');
            $table->string('image_tissu')->nullable(); // chemin vers l'image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
