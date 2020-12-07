<?php

namespace App\Http\Requests\Trips;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripsRequest extends FormRequest
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
            'vehicle_id'        => 'required|numeric',
            'company_id'        => 'required|numeric',
            'driver_user_id'    => 'required|numeric',
            'trip_from'         => 'required|string',
            'trip_to'           => 'required|string',
            'trip_details'      => 'required|string',
            'trip_date'         => 'required|date_format:m/d/Y',
            'trip_status'       => 'required|in:1,2,3'
        ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required'       => 'Vehicle is Required for Trip.',
            'vehicle_id.numeric'        => 'Provide Valid Vehicle for Trip.',
            'company_id.required'       => 'Company is Required for Trip.',
            'company_id.numeric'        => 'Provide Valid Company for Trip.',
            'driver_user_id.required'   => 'Driver is Required for Trip.',
            'driver_user_id.numeric'    => 'Provide Valid Driver for Trip.',
            'trip_from.required'        => 'Location From Required for Trip.',
            'trip_from.string'          => 'Provide Valid Location for Trip.',
            'trip_to.required'          => 'Location To Required for Trip.',
            'trip_to.string'            => 'Provide Valid Location for Trip.',
            'trip_details.required'     => 'Trip Details is Required.',
            'trip_details.string'       => 'Provide Valid Trip Details.',
            'trip_date.required'        => 'Trip Date is Required.',
            'trip_date.date_format'     => 'Provide Valid Trip Date.',
            'trip_status.required'      => 'Trip Status is Required.',
            'trip_status.in'            => 'Provide Valid Trip Status.'
        ];
    }
}
