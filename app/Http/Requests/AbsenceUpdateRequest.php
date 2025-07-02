<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_absence' => 'sometimes|required|date',
            'motif' => 'sometimes|required|string|max:255',
            'justificatif' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'status' => 'sometimes|required|in:en_attente,validee,rejetee',
        ];
    }
}