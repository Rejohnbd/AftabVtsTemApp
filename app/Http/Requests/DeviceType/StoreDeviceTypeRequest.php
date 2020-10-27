<?php

namespace App\Http\Requests\DeviceType;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceTypeRequest extends FormRequest
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
            'device_type_name' => 'required|string',
            'status' => 'required|in:0,1'
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'device_type_name'  => 'Device Type Name is Required.',
    //         'status'            => 'Select Device Type Status.',
    //     ];
    // }

    public function messages()
    {
        return [
            'device_type_name.required' => 'Device Type Name is Required.',
            'status.required'           => 'Select Device Type Status Required.',
            'status.in'             => 'Please Select Proper Device Type Status.',
        ];
    }
}
