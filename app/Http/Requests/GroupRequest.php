<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'        => 'required|string',
            'properties'   => 'required|array|min:1',
            'properties.*' => 'required|exists:properties,id'
        ];
    }
}
