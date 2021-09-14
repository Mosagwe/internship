<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'firstname'=>'required',
            'lastname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'idno' => 'required|unique:employees|max:15',
            'email' => 'required|email|unique:employees',
            'phonenumber' => 'required|unique:employees|max:15',
            'krapin' => 'required|unique:employees|max:15',
            'qualification_id' => 'required',
            'coursename' => 'required',
            'date_hired' => 'required',
            'emptype_id' => 'required',
            'station_id' => 'required',
            'category_id' => 'required',
            'start_date' => 'required',
            'next_of_kin'=>'required',
            'next_of_kin_phone'=>'required',
            'next_of_kin_relation'=>'required',
            'pwd'=>'required',
            'pwd_no'=>'required_if:pwd,1',
            'ref1_name'=>'required',
            'ref1_email'=>'required',
            'ref1_phone'=>'required',
            'ref1_occupation'=>'required',
            'ref1_period'=>'required',
            'ref2_name'=>'required',
            'ref2_email'=>'required',
            'ref2_phone'=>'required',
            'ref2_occupation'=>'required',
            'ref2_period'=>'required',
        ];
    }
}
