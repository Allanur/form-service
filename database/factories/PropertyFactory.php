<?php

namespace Database\Factories;

use App\Models\Property;
use App\Tools\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'type'  => $this->faker->randomElement(PropertyType::LIST),
            'name'  => $this->faker->words(3, true),
            'order' => 1
        ];
    }
}
