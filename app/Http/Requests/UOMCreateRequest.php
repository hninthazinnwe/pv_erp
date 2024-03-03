<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UOMCreateRequest extends FormRequest
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
        // dd(Request()->has('btnCreate'));
        return [
            'name' => 'required',
            'symbol' => 'required',
            'unit' => 'required',
        ];
    }
}
