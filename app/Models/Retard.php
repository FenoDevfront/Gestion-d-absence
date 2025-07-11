<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Retard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_retard',
        'duree',
        'motif',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
