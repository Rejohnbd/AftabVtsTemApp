<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpensesRequest extends FormRequest
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
            'expense_type_id'       => 'required|numeric',
            'trip_id'               => 'required|numeric',
            'expense_amount'        => 'required|numeric|min:0',
            'expense_date'          => 'required|date_format:m/d/Y',
            'expense_description'   => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'expense_type_id.required'      => 'Expenses Type is Required',
            'expense_type_id.numeric'       => 'Provide Valid Expenses Type',
            'trip_id.required'              => 'Trip Select is Required',
            'trip_id.numeric'               => 'Provide Valid Trip',
            'expense_amount.required'       => 'Expenses Amount is Required',
            'expense_amount.numeric'        => 'Expenses Amount is Numeric',
            'expense_amount.min'            => 'Provide Valid Expenses Amount',
            'expense_date.required'         => 'Expenses Date is Required',
            'expense_date.date_format'      => 'Provide Valid Expenses Date',
            'expense_description.required'  => 'Expenses Description is Required',
            'expense_description.string'    => 'Provide Valid Expenses Description'
        ];
    }
}
