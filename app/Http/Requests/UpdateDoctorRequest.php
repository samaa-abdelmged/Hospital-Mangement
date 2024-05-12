<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'name' => 'required|max:30',
            'email' => 'required|email',
            'phone' => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('dashboard\validation.required'),
            'name.max' => trans('dashboard\validation.max'),
            'email.required' => trans('dashboard\validation.required'),
            'email.email' => trans('dashboard\validation.email'),
            'phone.required' => trans('dashboard\validation.required'),
            'phone.numeric' => trans('dashboard\validation.numeric'),

        ];
    }
}