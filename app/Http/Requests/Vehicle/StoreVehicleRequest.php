<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'vehicle_type_id'                   => 'required|numeric',
            'company_id'                        => 'required|numeric',
            'vehicle_plate_number'              => 'required|string',
            'vehicle_kpl'                       => 'required|between:0,99.99',
            'vehicle_brand'                     => 'required|string',
            'vehicle_model'                     => 'required|string',
            'vehicle_model_year'                => 'required|numeric|min:0',
            'vehicle_insurance_expire_date'     => 'required|date_format:m/d/Y',
            'vehicle_registration_expire_date'  => 'required|date_format:m/d/Y',
            'vehicle_tax_token_expire_date'     => 'required|date_format:m/d/Y',
            'vehicle_ownership_type'            => 'required|in:1,2'
        ];
    }

    public function messages()
    {
        return [
            'vehicle_type_id.required'                      => 'Vehicle Type is Required',
            'vehicle_type_id.numeric'                       => 'Provide Valid Vehicle Type',
            'company_id.required'                           => 'Company Select is Required',
            'company_id.numeric'                            => 'Provide Valid Company Name',
            'vehicle_plate_number.required'                 => 'Registration Number is Required',
            'vehicle_plate_number.string'                   => 'Provide Valid Registration Number',
            'vehicle_kpl.required'                          => 'Fuel Consumption is Required',
            'vehicle_kpl.between'                           => 'Provide Valid Fuel Consumption',
            'vehicle_brand.required'                        => 'Vehicle Brand is Required',
            'vehicle_brand.string'                          => 'Provide Valid Vehicle Brand',
            'vehicle_model.required'                        => 'Vehicle Model is Required',
            'vehicle_model.string'                          => 'Provide Valid Vehicle Model',
            'vehicle_model_year.required'                   => 'Vehicle Model Year is Required',
            'vehicle_model_year.numeric'                    => 'Provide Valid Vehicle Model Year',
            'vehicle_model_year.min'                        => 'Provide Valid Vehicle Model Year',
            'vehicle_insurance_expire_date.required'        => 'Insurance Expire Date is Required',
            'vehicle_insurance_expire_date.date_format'     => 'Provide Valid Insurance Expire Date',
            'vehicle_registration_expire_date.required'     => 'Registration Expire Date is Required',
            'vehicle_registration_expire_date.date_format'  => 'Provide Valid Registration Expire Date',
            'vehicle_tax_token_expire_date.required'        => 'Tax Token Expire Date is Required',
            'vehicle_tax_token_expire_date.date_format'     => 'Provide Valid Tax Token Expire Date',
            'vehicle_ownership_type.required'               => 'Vehicle Ownership Type is Required.',
            'vehicle_ownership_type.in'                     => 'Please Select Proper Vehicle Ownership Type.',
        ];
    }
}
