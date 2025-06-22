<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Conge extends Model
{
    protected $fillable = [
        'employee_id',
        'date_debut',
        'date_fin',
        'type_conge',
        'valide'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
