<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CongeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date|after_or_equal:date_debut',
            'motif' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:en_attente,validee,rejetee',
        ];
    }
}
