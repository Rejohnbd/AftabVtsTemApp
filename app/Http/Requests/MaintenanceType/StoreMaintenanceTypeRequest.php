<?php

namespace App\Http\Requests\MaintenanceType;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceTypeRequest extends FormRequest
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
            'maintenance_type_name' => 'required|string',
            'status'                => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'maintenance_type_name.required'    => 'Maintenance Type Name is Required.',
            'status.required'                   => 'Select Maintenance Type Status Required.',
            'status.in'                         => 'Please Select Proper Maintenance Type Status.',
        ];
    }
}
