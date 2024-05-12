<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RayRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:laboratorie_employees,email,',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('dashboard\validation.required'),
            'email.required' => trans('dashboard\validation.required'),
            'email.email' => trans('dashboard\validation.email'),
            'email.unique' => trans('dashboard\validation.unique'),
            'password.required' => trans('dashboard\validation.required'),
            'password.min' => trans('dashboard\validation.min'),
        ];
    }
}