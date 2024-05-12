<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'email' => 'required|email|unique:doctors,email,',
            'password' => 'required',
            'phone' => 'required|numeric',
            'section_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('dashboard\validation.required'),
            'name.max' => trans('dashboard\validation.max'),
            'email.required' => trans('dashboard\validation.required'),
            'email.email' => trans('dashboard\validation.email'),
            'email.unique' => trans('dashboard\validation.unique'),
            'password.required' => trans('dashboard\validation.required'),
            'phone.required' => trans('dashboard\validation.required'),
            'phone.numeric' => trans('dashboard\validation.numeric'),
            'section_id.required' => trans('dashboard\validation.required'),

        ];
    }
}