<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckEditRequest extends FormRequest
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
        $id = request('id');

        return [
            'number' => 'required|unique:trucks,number,'.$id.',id',
            // 'truck_load' => 'required',
            // 'trucks_weight_category' => 'required|numeric|min:1',
            'office' => 'required|numeric|min:1'
        ];
    }

    public function messages() {
        return [
            'number.required'   => 'Полето е задължително!',
            'number.unique'     => 'Този номер съществува!',
            'truck_load.required' => 'Полето е задължително!',
            'trucks_weight_category.required' => 'Полето е задължително!',
            'trucks_weight_category.numeric' => 'Полето е задължително!',
            'trucks_weight_category.min' => 'Полето е задължително!',
            'office.required' => 'Полето е задължително!',
            'office.numeric' => 'Полето е задължително!',
            'office.min' => 'Полето е задължително!',
        ];
    }
}
