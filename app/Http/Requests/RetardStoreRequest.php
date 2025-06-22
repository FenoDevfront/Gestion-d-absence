<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\RetardStoreRequest;


class RetardStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // change à false si tu veux restreindre
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'motif' => 'required|string|max:255',
        ];
    }
}
