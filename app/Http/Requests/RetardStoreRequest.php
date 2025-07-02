<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetardStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employee_id' => 'required|exists:users,id',
            'date_retard' => 'required|date',
            'duree' => 'required|integer|min:1',
            'motif' => 'required|string|max:255',
        ];
    }
}