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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->unsignedBigInteger('user_id'); // Référence à l'utilisateur
            $table->unsignedBigInteger('product_id'); // Référence au produit
            $table->decimal('prix', 10, 2); // Prix du produit
            $table->integer('quantite')->default(1); // Quantité (par défaut : 1)
            $table->timestamps(); // Colonnes created_at et updated_at

            // Clés étrangères
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
