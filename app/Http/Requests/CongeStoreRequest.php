<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CongeStoreRequest;

class CongeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'date_debut' => 'required|date|before_or_equal:date_fin',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type' => 'required|string|max:100',
            'status' => 'required|in:en_attente,en_cours,refuse',
        ];
    }
}
