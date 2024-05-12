<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReviewRequest extends FormRequest
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
            'medicine' => 'required',
            'review_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'diagnosis.required' => trans('dashboard\validation.required'),
            'medicine.required' => trans('dashboard\validation.required'),
            'review_date.required' => trans('dashboard\validation.required'),

        ];
    }
}