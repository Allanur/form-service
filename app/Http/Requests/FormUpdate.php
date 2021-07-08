<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'                 => 'required',
            'description'           => 'required',
            'properties'            => 'nullable|array|min:1',
            'properties.*.name'     => 'required',
            'properties.*.type'     => 'required|in:text,number,select,multiple_choice,date',
            'properties.*.values'   => 'nullable|array|min:1',
            'properties.*.values.*' => 'required',
        ];
    }
}
