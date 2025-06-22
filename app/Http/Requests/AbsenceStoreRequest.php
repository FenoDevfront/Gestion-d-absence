<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AbsenceStoreRequest;

class AbsenceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'motif' => 'required|string|max:255',
            'status' => 'required|in:en_attente,en_cours,refuse',
        ];
    }
}
