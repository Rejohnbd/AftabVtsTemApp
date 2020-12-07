<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'company_name'  => 'required|string',
            'status'        => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Company Name is Required.',
            'status.required'       => 'Select Company Status Required.',
            'status.in'             => 'Please Select Proper Company Status.',
        ];
    }
}
