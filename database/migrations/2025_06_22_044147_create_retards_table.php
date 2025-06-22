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
        Schema::create('retards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->datetime('heure_prevue');
            $table->datetime('heure_reelle');
            $table->string('motif');
            $table->boolean('justifie')->default(false);
            $table->timestamps();
            $table->enum('status', ['en_attente', 'en_cours', 'refuse'])->default('en_attente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retards');
    }
};
