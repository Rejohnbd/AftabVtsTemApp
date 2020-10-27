<?php

namespace App\Http\Requests\Helper;

use Illuminate\Foundation\Http\FormRequest;

class StoreHelperRequest extends FormRequest
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
            'helper_name'   => 'required|string',
            'helper_NID'    => 'required|numeric',
            'helper_age'    => 'required|numeric|digits:2',
            'helper_mobile' => 'required|numeric|digits:11|unique:helpers,helper_mobile',
            'status'        => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'helper_name.required'  => 'Helper Name is Required.',
            'helper_name.string'    => 'Provide Valid Helper Name.',
            'helper_NID.required'   => 'Helper NID is Required.',
            'helper_NID.numeric'    => 'Provide Valid Helper NID.',
            'helper_age.required'   => 'Helper Age is Required.',
            'helper_age.numeric'    => 'Provide Valid Helper Age.',
            'helper_age.digits'    => 'Provide Valid Helper Age.',
            'helper_mobile.required' => 'Helper Mobile is Required.',
            'helper_mobile.numeric' => 'Provide Valid Helper Mobile.',
            'helper_mobile.digits'  => 'Provide Valid Helper Mobile.',
            'helper_mobile.unique'  => 'Provide Valid Helper Mobile. This Mobile Number is Already Used',
            'status.required'       => 'Select Vehicle Type Status Required.',
            'status.in'             => 'Please Select Proper Vehicle Type Status.',
        ];
    }
}
