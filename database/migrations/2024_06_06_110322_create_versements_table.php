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
        Schema::create('versements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditeur_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('session_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('description');
            $table->decimal('montant', 15, 0);
            $table->decimal('resteapayer', 15, 0);
            $table->date('date_versement');
            $table->string('mode_paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versements');
    }
};
