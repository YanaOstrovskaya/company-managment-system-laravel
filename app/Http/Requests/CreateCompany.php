<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompany extends FormRequest
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
            'logo' => 'required|file|image',
            'name' => 'required|max:255',
            'adress_line1' => 'required',
            'adress_line2' => 'nullable',
            'zip' => 'required|numeric',
            'province' => 'nullable',
            'city' => 'required',
            'country' => 'required',
            'owner_id' => 'nullable'
        ];
    }
}
