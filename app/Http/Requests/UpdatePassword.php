<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required',
            'password'     => 'required|confirmed'
        ];
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->passes()) {
            $validator->after(function (Validator $validator) {
                if (! Hash::check($this->old_password, $this->user()->password)) {
                    $validator->errors()->add('old_password', 'Şu wagtky parolyňyzy ýalňyş girizdiňiz');
                }
            });
        }
    }
}
