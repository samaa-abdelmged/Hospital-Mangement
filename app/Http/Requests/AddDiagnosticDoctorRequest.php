<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDiagnosticDoctorRequest extends FormRequest
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
            'diagnosis' => 'required',
            'medicine' => 'required|',
        ];
    }

    public function messages()
    {
        return [
            'diagnosis.required' => trans('dashboard\validation.required'),
            'medicine.required' => trans('dashboard\validation.required'),

        ];
    }
}