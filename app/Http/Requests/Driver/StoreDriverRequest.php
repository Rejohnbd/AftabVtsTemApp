<?php

namespace App\Http\Requests\Driver;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'driver_first_name' => 'required|string',
            'driver_last_name'  => 'required|string',
            // 'driver_NID'        => 'required|string|regex:/^[a-zA-Z0-9]+$/u',
            // 'driver_license'    => 'required|string|regex:/^[a-zA-Z0-9]+$/u',
            'driver_email'      => 'required|email|unique:users,email',
            'driver_password'   => 'required|string',
            // 'driver_join_date'  => 'required|date_format:m/d/Y',
            'driver_mobile'     => 'required|numeric|digits:11|unique:drivers,driver_mobile|unique:drivers,driver_mobile_opt',
            // 'driver_mobile_opt' => 'required|numeric|digits:11|unique:drivers,driver_mobile|unique:drivers,driver_mobile_opt',
            // 'driver_address'    => 'required|string',
            // 'driver_photo'      => 'required|mimes:jpeg,jpg,png|dimensions:max_width=300,max_height=300',
            // 'driver_gender'     => 'required|in:male,female,other',
            'status'            => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'driver_first_name.required'    => 'Driver First Name is Required.',
            'driver_first_name.string'      => 'Driver First Name Must Be Valid String Type Required.',
            'driver_last_name.required'     => 'Driver Last Name is Required.',
            'driver_last_name.string'       => 'Driver Last Name Must Be Valid String Type Required.',
            // 'driver_NID.required'           => 'Driver National Identity is Required.',
            // 'driver_NID.string'             => 'Provide Valid Driver National Identity.',
            // 'driver_NID.regex'              => 'Provide Valid Driver National Identity.',
            // 'driver_license.required'       => 'Driver License Number is Required.',
            // 'driver_license.string'         => 'Provide Valid Driver License Number.',
            // 'driver_license.regex'          => 'Provide Valid Driver License Number.',
            'driver_email.required'         => 'Driver Email is Required.',
            'driver_email.email'            => 'Provide Valid Driver Email.',
            'driver_email.unique'           => 'Provide Valid Driver Email. This Mail Address Already Used.',
            'driver_password.required'      => 'Driver Password is Required.',
            'driver_password.string'        => 'Driver Password Must Be Valid String Type Required.',
            'driver_mobile.required'        => 'Driver Mobile is Required.',
            'driver_mobile.numeric'         => 'Provide Valid Driver Mobile.',
            'driver_mobile.unique'          => 'Provide Valid Driver Mobile. This Number Already Used.',
            // 'driver_mobile_opt.required'    => 'Driver Mobile is Required.',
            // 'driver_mobile_opt.numeric'     => 'Provide Valid Driver Mobile.',
            // 'driver_mobile_opt.unique'      => 'Provide Valid Driver Mobile. This Number Already Used.',
            // 'driver_address.required'       => 'Driver Address is Required.',
            // 'driver_address.string'         => 'Provide Valid Driver Address.',
            // 'driver_photo.required'         => 'Driver Photo is Required.',
            // 'driver_photo.mimes'            => 'Driver Photo Format Must be JPEG, JPG & PNG.',
            // 'driver_photo.dimensions'       => 'Driver Photo Size will be 300x300 pixel.',
            // 'driver_gender.required'        => 'Driver Gender is Reqired.',
            // 'driver_gender.in'              => 'Provide Valid Driver Gender.',
            'status.required'               => 'Select Vehicle Type Status Required.',
            'status.in'                     => 'Please Select Proper Vehicle Type Status.',
            // 'driver_join_date.required'     => 'Driver Join Date is Required',
            // 'driver_join_date.date_format'  => 'Provide Valid Driver Join Date',
        ];
    }
}
