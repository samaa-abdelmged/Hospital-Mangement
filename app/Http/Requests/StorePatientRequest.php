<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            "name" => 'required',
            "email" => 'required|email|unique:patients,email,' . $this->id,
            "password" => 'required|sometimes',
            "Phone" => 'required|numeric|unique:patients,Phone,' . $this->id,
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            "Gender" => 'required|integer|in:1,2',
            "Blood_Group" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('dashboard\validation.required'),
            'email.unique' => trans('dashboard\validation.unique'),
            'password.required' => trans('dashboard\validation.required'),
            'password.sometimes' => trans('dashboard\validation.sometimes'),
            'Phone.required' => trans('dashboard\validation.required'),
            'Phone.unique' => trans('dashboard\validation.unique'),
            'Phone.numeric' => trans('dashboard\validation.numeric'),
            'Date_Birth.required' => trans('dashboard\validation.required'),
            'Date_Birth.date' => trans('dashboard\validation.date'),
            'Gender.required' => trans('dashboard\validation.required'),
            'Gender.integer' => trans('dashboard\validation.integer'),
            'Blood_Group.required' => trans('dashboard\validation.required'),
        ];
    }
}