<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Value;
use App\Models\Property;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run()
    {
        Form::factory(5)
            ->has(
                Property::factory(7)
                        ->has(
                            Value::factory(4)
                        )
            )
            ->create();
    }
}
