<?php

namespace App\Http\Requests\ExpensesType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpensesTypeRequest extends FormRequest
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
            'expense_type_name' => 'required|string',
            'status'            => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'expense_type_name.required'    => 'Expenses Type Name is Required.',
            'status.required'               => 'Select Expenses Type Status Required.',
            'status.in'                     => 'Please Select Proper Expenses Type Status.',
        ];
    }
}
