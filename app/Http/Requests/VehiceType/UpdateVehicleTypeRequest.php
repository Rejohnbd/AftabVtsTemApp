<?php

namespace App\Http\Requests\VehiceType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleTypeRequest extends FormRequest
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
            'vehicle_type_name' => 'required|string',
            'status'            => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'vehicle_type_name.required'    => 'Vehicle Type Name is Required.',
            'status.required'               => 'Select Vehicle Type Status Required.',
            'status.in'                     => 'Please Select Proper Vehicle Type Status.',
        ];
    }
}
