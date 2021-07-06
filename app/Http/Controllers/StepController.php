<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Step;
use App\Http\Requests\StepStore;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StepController
{
    public function create(Form $form)
    {
        return view('steps.create', compact('form'));
    }

    public function edit(Form $form, Step $step)
    {
        $step->load('properties.values');
        return view('steps.edit', compact('form', 'step'));
    }

    public function store(StepStore $request, Form $form)
    {
        $step = $form->steps()->create($request->only('title'));

        foreach ($request->properties as $order => $data) {
            $step->properties()
                 ->create([
                     'type'  => $data['type'],
                     'name'  => $data['name'],
                     'order' => $order + 1,
                 ])
                 ->values()
                 ->createMany($data['values'] ?? []);
        }

        return redirect()->route('forms.edit', $form);
    }

    public function update(StepStore $request, Form $form, Step $step)
    {
        $step->update($request->only('title'));

        foreach ($request->properties as $order => $data) {
            try {
                $property = $step->properties()->findOrFail($data['id'] ?? null);
                $property->update([
                    'type'  => $data['type'],
                    'name'  => $data['name'],
                    'order' => $order + 1,
                ]);
            } catch (ModelNotFoundException $e) {
                $property = $step->properties()
                                 ->create([
                                     'type'  => $data['type'],
                                     'name'  => $data['name'],
                                     'order' => $order + 1,
                                 ]);
            }

            if (!in_array($property->type, ['select', 'multiple_choice'])) {
                $property->values()->delete();
                continue;
            }

            foreach ($data['values'] as $value) {
                try {
                    $property->values()
                             ->findOrFail($value['id'] ?? null)
                             ->update([
                                 'value' => $value['value'],
                                 'order' => $value['order'],
                             ]);
                } catch (ModelNotFoundException $e) {
                    $property->values()
                             ->create($value);
                }
            }
        }

        return redirect()->route('forms.edit', $form);
    }

    public function destroy(Form $form, Step $step)
    {
        $form->steps()->whereKey($step)->delete();
        return back();
    }
}
