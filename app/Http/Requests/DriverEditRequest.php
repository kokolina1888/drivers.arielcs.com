<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverEditRequest extends FormRequest
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
        // dd($id);

        return [
            'name' => 'required|unique:drivers,name,'.$id.',id',
            'office' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Полето е задължително!',
            'name.unique'   => 'Името вече съществува!',
            'office.required' => 'Полето е задължително!',           
        ];
    }
}
