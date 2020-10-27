<?php

namespace App\Http\Requests\VehicleDevice;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleDeviceRequest extends FormRequest
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
            'vehicle_id'            => 'required|numeric',
            'device_id'             => 'required|numeric',
            'device_assign_date'    => 'required|date_format:m/d/Y',
            'status'                => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required'               => 'Something Happend Wrong Please Try Again',
            'vehicle_id.numeric'                => 'Something Happend Wrong Please Try Again',
            'device_id.required'                => 'Device is Required',
            'device_id.numeric'                 => 'Provide Valid Device',
            'device_assign_date.required'       => 'Assign Date is Required',
            'device_assign_date.date_format'    => 'Provide Valid Assign Date',
            'status.required'                   => 'Select Vehicle Type Status Required.',
            'status.in'                         => 'Please Select Proper Vehicle Type Status.',
        ];
    }
}
