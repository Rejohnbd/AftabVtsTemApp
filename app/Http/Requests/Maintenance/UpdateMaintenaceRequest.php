<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenaceRequest extends FormRequest
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
            'maintenance_type_id'   => 'required|numeric',
            'vehicle_id'            => 'required|numeric',
            'maintenance_details'   => 'required|string',
            'maintenance_date'      => 'required|date_format:m/d/Y',
            'maintenance_next_date' => 'required|date_format:m/d/Y',
        ];
    }

    public function messages()
    {
        return [
            'maintenance_type_id.required'      => 'Maintenance Type is Required',
            'maintenance_type_id.numeric'       => 'Provide Valid Maintenance Type',
            'vehicle_id.required'               => 'Vehicle Select is Required',
            'vehicle_id.numeric'                => 'Provide Valid Vehicle',
            'maintenance_details.required'      => 'Maintenace Details is Required',
            'maintenance_details.string'        => 'Provide Valid Maintenace Details',
            'maintenance_date.required'         => 'Maintenance Date is Required',
            'maintenance_date.date_format'      => 'Provide Valid Maintenance Date',
            'maintenance_next_date.required'    => 'Maintenance Next Date is Required',
            'maintenance_next_date.date_format' => 'Provide Valid Maintenance Next Date'
        ];
    }
}
