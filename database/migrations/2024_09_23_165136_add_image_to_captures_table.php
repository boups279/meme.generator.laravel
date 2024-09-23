<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('captures', function (Blueprint $table) {
            // Vérifie si la colonne n'existe pas avant de l'ajouter
            if (!Schema::hasColumn('captures', 'image')) {
                $table->text('image')->nullable(); // Utilise nullable() si besoin
            }
        });
    }

    public function down()
    {
        Schema::table('captures', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
    
};
