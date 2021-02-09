<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email'     => 'required|string|email|max:255',
            'type'      => 'required|in:super_admin,expense_trip,maintenance,dashboard_report',
            'password'  => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'email.required'        => 'User Email is Required.',
            'email.string'          => 'Provide Valid Email Address.',
            'email.email'           => 'Provide Valid Email Address.',
            'email.max'             => 'Provide Valid Email Address.',
            'type.required'         => 'Please Select User Role.',
            'type.in'               => 'Please Select Proper User Role.',
            'password.required'     => 'Password is Required.',
            'password.string'       => 'Provide Valid Password.',
            'password.min'          => 'Password must be at least 8 Characters.',
            'password.confirmed'    => 'Password Confirmation does not Match.',
        ];
    }
}
