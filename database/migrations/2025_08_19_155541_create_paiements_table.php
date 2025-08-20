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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')
                ->constrained('commandes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('type_paiement', ['avance', 'solde', 'remboursement']);
            $table->dateTime('date_paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
