<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'employee_id'=>'required',
            'start_date'=>'required',
            'station_id'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'employee_id'=>'employee',
            'station_id'=>'station',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required'=>'Please select employee!',
        ];

    }
}
