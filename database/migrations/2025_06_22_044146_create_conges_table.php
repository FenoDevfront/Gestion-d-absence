<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\CongeStoreRequest;
use App\Models\Conge;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('type_conge');
            $table->boolean('valide')->default(false);
            $table->timestamps();
            $table->enum('status', ['en_attente', 'en_cours', 'refuse'])->default('en_attente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
    
    public function store(CongeStoreRequest $request)
    {
        Conge::create($request->validated());

        return redirect()->route('conges.index')
            ->with('success', 'Congé enregistré avec succès.');
    }
};
