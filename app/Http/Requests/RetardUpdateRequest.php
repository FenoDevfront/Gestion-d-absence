<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetardUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_retard' => 'sometimes|required|date',
            'duree' => 'sometimes|required|integer|min:1',
            'motif' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:en_attente,validee,rejetee',
        ];
    }
}
