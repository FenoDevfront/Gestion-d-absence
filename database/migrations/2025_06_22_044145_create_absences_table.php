<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\AbsenceStoreRequest;
use App\Models\Absence;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('date_absence');
            $table->string('motif');
            $table->boolean('justifiee')->default(false);
            $table->timestamps();
            $table->enum('status', ['en_attente', 'en_cours', 'refuse'])->default('en_attente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }

    public function store(AbsenceStoreRequest $request)
    {
        Absence::create($request->validated());

        return redirect()->route('absences.index')
            ->with('success', 'Absence enregistrée avec succès.');
    }
};
