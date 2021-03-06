<?php

namespace App\Http\Requests\TripType;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripTypeRequest extends FormRequest
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
            'trip_type_name'    => 'required|string|unique:trip_types,trip_type_name',
            'status'            => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'trip_type_name.required'   => 'Trip Type Name is Required.',
            'trip_type_name.unique'     => 'Trip Type Name Already Exist.',
            'status.required'           => 'Select Trip Type Status Required.',
            'status.in'                 => 'Please Select Proper Trip Type Status.',
        ];
    }
}
