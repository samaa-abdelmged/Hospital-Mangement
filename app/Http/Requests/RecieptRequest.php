<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecieptRequest extends FormRequest
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
            'patient_id' => 'required',
            'Debit' => 'required|numeric',
            'description' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => trans('dashboard\validation.required'),
            'Debit.required' => trans('dashboard\validation.required'),
            'Debit.numeric' => trans('dashboard\validation.numeric'),
            'description.required' => trans('dashboard\validation.required'),
        ];
    }
}