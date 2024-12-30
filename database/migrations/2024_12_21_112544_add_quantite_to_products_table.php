<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute la colonne 'quantite' à la table 'products'.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantite')->default(0)->after('prix');
        });
    }

    /**
     * Supprime la colonne 'quantite' de la table 'products'.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('quantite');
        });
    }
};
