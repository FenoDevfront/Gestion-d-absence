<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceStoreRequest extends FormRequest
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
            'employee_id' => 'required|exists:users,id',
            'date_absence' => 'required|date',
            'motif' => 'required|string|max:255',
            'justificatif' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ];
    }
}