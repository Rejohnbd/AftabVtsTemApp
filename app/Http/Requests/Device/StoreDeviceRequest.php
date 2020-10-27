<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
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
            'device_type_id'    => 'required|numeric',
            'device_unique_id'  => 'required|string|unique:devices,device_unique_id',
            'device_model'      => 'required|string',
            'device_sim_number' => 'required|numeric|digits:11|unique:devices,device_sim_number',
            'device_sim_type'   => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'device_type_id.required'   => 'Device Type Name is Required.',
            'device_type_id.numeric'    => 'Provide Valid Device Type Name.',
            'device_unique_id.required' => 'Device Unique Id is Required.',
            'device_unique_id.unique'   => 'Provide Device Unique Device Id, This Device is Already Used.',
            'device_model.required'     => 'Device Model is Required.',
            'device_sim_number.required' => 'Device SIM Number is Required.',
            'device_sim_number.numeric' => 'Please Provide Valid SIM Number',
            'device_sim_number.unique'  => 'Please Provide Valid SIM Number, This SIM is Already Used.',
            'device_sim_number.digits'  => 'Please Provide Valid SIM Number',
            'status.required'           => 'Select Device Type Status Required.',
            'status.in'                 => 'Please Select Proper Device Type Status.'
        ];
    }
}
