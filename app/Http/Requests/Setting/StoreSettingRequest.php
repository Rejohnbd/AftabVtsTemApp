<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'alert_min_temp'        => 'required|numeric|lt:alert_max_temp',
            'alert_max_temp'        => 'required|numeric|gt:alert_min_temp',
            'alert_min_humidity'    => 'required|numeric|lt:alert_max_humidity',
            'alert_max_humidity'    => 'required|numeric|gt:alert_min_humidity',
            'email_from'            => 'required|email',
            'notification_emails'   => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'alert_min_temp.required'       => 'Min Temperature is Required.',
            'alert_min_temp.numeric'        => 'Provide Valid Min Temperature.',
            'alert_min_temp.lt'             => 'Min Temperature Must be Less tahn Max Temperature.',
            'alert_max_temp.required'       => 'Max Temperature is Required.',
            'alert_max_temp.numeric'        => 'Provide Valid Max Temperature.',
            'alert_max_temp.gt'             => 'Max Temperature Must be Greater than Min Temperature.',
            'alert_min_humidity.required'   => 'Min Humidity is Required.',
            'alert_min_humidity.numeric'    => 'Provide Valid Min Humidity.',
            'alert_min_humidity.lt'         => 'Min Humidity Must be Less than Max Humidity.',
            'alert_max_humidity.required'   => 'Max Humidity is Required.',
            'alert_max_humidity.numeric'    => 'Provide Valid Max Humidity.',
            'alert_max_humidity.gt'         => 'Max Humidity Must be Greater than Min Humidity.',
            'email_from.required'           => 'Email From is Required',
            'email_from.email'              => 'Provide Valid Email From',
            'notification_emails.required'  => 'Notification Email is Required.',
            'notification_emails.string'    => 'Provide Valid Notification Email.',
        ];
    }
}
