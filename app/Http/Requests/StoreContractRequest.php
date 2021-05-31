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
            'employee_type'=>'required',
            'start_date'=>'required',
            'station_id'=>'required',
            'unit_id'=>'required',
            'salary'=>'required_if:employee_type,casual',
            'bank_id'=>'required',
            'bank_branch'=>'required',
            'bank_account'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'employee_type'=>'type of employee',
            'employee_id'=>'employee',
            'station_id'=>'station',
            'unit_id'=>'unit',
            'bank_id'=>'bank',
        ];
    }

    public function messages()
    {
        return [
            'employee_type.required'=>'Employee type is required',
        ];

    }
}
