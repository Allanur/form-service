<?php

namespace Database\Factories;

use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormFactory extends Factory
{
    protected $model = Form::class;

    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(),
        ];
    }
}
