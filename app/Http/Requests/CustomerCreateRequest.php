<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
            'name' => 'required',
            'dob' => 'required',
            'phone' => 'nullable',
            'contact_person' => 'nullable',
            'deposit_amt' => 'required|numeric|max:9999999999',
            'address' => 'nullable',
            'email' => 'nullable',
        ];
    }
}
