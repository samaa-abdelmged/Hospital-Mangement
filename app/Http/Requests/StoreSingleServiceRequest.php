<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSingleServiceRequest extends FormRequest
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
            "name" => 'required|unique:service_translations,name,' . $this->id,
            'price' => 'numeric|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('dashboard\validation.required'),
            'name.unique' => trans('dashboard\validation.unique'),
            'price.required' => trans('dashboard\validation.required'),
            'price.numeric' => trans('dashboard\validation.numeric'),
        ];
    }
}