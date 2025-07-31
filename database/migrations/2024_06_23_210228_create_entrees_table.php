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
        Schema::create('entrees', function (Blueprint $table) {
            $table->id(); 
            $table->string('description');
            $table->decimal('montant', 15, 0);
            $table->date('date_entree');
            $table->foreignId('versement_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('caisse_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrees');
    }
};
