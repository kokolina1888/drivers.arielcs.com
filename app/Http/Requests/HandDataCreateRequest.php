<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandDataCreateRequest extends FormRequest
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
            'driver1'       => 'required',
            'driver2'       => 'different:driver1',
            'date'          => 'required',
            'route_list'    => 'required',
            'document'      => 'required',
            'truck'         => 'required',
            'total_weight'  => 'required|not_in:0',
            'km_start'      => 'required|not_in:0',
            'km_end'        => 'required|not_in:0',
            'gas_quant'     => 'required|not_in:0',
            'km_run'        => 'required|not_in:0',
            'doc_receiver'  => 'required',
            'doc_receiver_address' => 'required',
            'sender'        => 'required'            
            ];
    }

    public function messages() {
        return [
            // 'order_number.required'=> 'Полето е задължително!',
            'driver1.required'     => 'Полето е задължително!',
            'driver2.different'    => 'Водач 1 и Водач 2 трябва да са различни!',
            'date.required'        => 'Полето е задължително!',
            'route_list.required'  => 'Полето е задължително!',
            'documents.required'   => 'Полето е задължително!',
            'truck.required'       => 'Полето е задължително!',
            'total_weight.required'   => 'Полето е задължително!',
            'total_weight.not_in'  => 'Въведете стойност, различна от 0!',
            'km_start.required'    => 'Полето е задължително!',
            'km_start.not_in'      => 'Въведете стойност, различна от 0!',
            'km_end.required'      => 'Полето е задължително!',
            'km_end.not_in'        => 'Въведете стойност, различна от 0!',
            'gas_quant.required'   => 'Полето е задължително!',
            'gas_quant.not_in'     => 'Въведете стойност, различна от 0!',
            'km_run.required'      => 'Полето е задължително!',
            'km_run.not_in'        => 'Въведете стойност, различна от 0!',
            'document.required'             => 'Полето е задължително!',
            'doc_receiver.required'         => 'Полето е задължително!',
            'doc_receiver_address.required' => 'Полето е задължително!',
            'sender.required'               => 'Полето е задължително!'     
            
        ];
    }
}
