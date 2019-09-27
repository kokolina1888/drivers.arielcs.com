<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckWeightCategoryCreateRequest extends FormRequest
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
            'name' =>'required|unique:trucks_weight_categories,name',
            'payment' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required'   => 'Полето е задължително!',
            'name.unique'     => 'Името се използва!',
            'payment.required' => 'Полето е задължително!',
        ];
    }
}
