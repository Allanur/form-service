<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use App\Http\Resources\Form as FormResource;

class FormController
{
    public function index()
    {
        return FormResource::collection(Form::all());
    }
}
