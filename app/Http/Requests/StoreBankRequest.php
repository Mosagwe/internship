<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBankRequest extends FormRequest
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
            'bank_name'=>'required|unique:banks,bank_name,'.$this->id,
            'bank_code'=>'required|unique:banks,bank_code,'.$this->id,
            //'bank_code'=>'required',Rule::unique('banks')->ignore($this->bank)
        ];
    }
}
