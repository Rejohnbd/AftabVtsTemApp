<?php

namespace App\Http\Requests\TripBill;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripBillRequest extends FormRequest
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
            'trip_id'           => 'required|numeric',
            'chalan_no'         => 'required|string',
            'product_weight'    => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'trip_id.required'              => 'Trip Select is Required.',
            'trip_id.numeric'               => 'Provide Valid Trip.',
            'chalan_no.required'            => 'Chalan No. Required.',
            'chalan_no.string'              => 'Provide Valid Chalan No.',
            'product_weight.required'       => 'Product Quantity is Required.',
            'product_weight.numeric'        => 'Provide Valid Product Quantity.'
        ];
    }
}
