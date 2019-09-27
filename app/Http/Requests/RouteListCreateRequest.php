<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteListCreateRequest extends FormRequest
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
            // 'order_number'  => 'required',
            'route_list'    => 'required',
            'truck'         => 'required',
            'km_start'      => 'required|not_in:0',
            'km_end'        => 'required|not_in:0',
            'gas_quant'     => 'required|not_in:0',
            'km_run'        => 'required|not_in:0',
            'driver1'       => 'required',
            'driver2'       => 'different:driver1'
            ];
    }

    public function messages() {
        return [
            // 'order_number.required'     => 'Полето е задължително!',
            'route_list.required'       => 'Полето е задължително!',
            'truck.required'            => 'Полето е задължително!',
            'km_start.required'         => 'Полето е задължително!',
            'km_start.not_in'           => 'Въведете стойност, различна от 0!',
            'km_end.required'           => 'Полето е задължително!',
            'km_end.not_in'             => 'Въведете стойност, различна от 0!',
            'gas_quant.required'        => 'Полето е задължително!',
            'gas_quant.not_in'          => 'Въведете стойност, различна от 0!',
            'km_run.required'           => 'Полето е задължително!',
            'km_run.not_in'             => 'Въведете стойност, различна от 0!',
            'driver1.required'          => 'Полето е задължително!',
            'driver2.different'         => 'Водач 1 и Водач 2 трябва да са различни!',
        ];
    }
}
