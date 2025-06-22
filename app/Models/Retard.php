<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Retard extends Model
{
    protected $fillable = [
        'employee_id',
        'heure_prevue',
        'heure_reelle',
        'motif',
        'justifie',
        'status'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
