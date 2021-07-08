<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Http\Requests\FormStore;
use App\Http\Requests\FormUpdate;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->get();

        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function edit(Form $form)
    {
        $form->load('properties.values');
        return view('forms.edit', compact('form'));
    }

    public function store(FormStore $request)
    {
        $form = Form::create($request->validated());

        return redirect()->route('forms.edit', $form);
    }

    public function update(FormUpdate $request, Form $form)
    {
        $form->update($request->validated());

        foreach ($request->properties ?? [] as $order => $data) {
            try {
                $property = $form->properties()->findOrFail($data['id'] ?? null);
                $property->update([
                    'type'  => $data['type'],
                    'name'  => $data['name'],
                    'order' => $order + 1,
                ]);
            } catch (ModelNotFoundException $e) {
                $property = $form->properties()
                                 ->create([
                                     'type'  => $data['type'],
                                     'name'  => $data['name'],
                                     'order' => $order + 1,
                                 ]);
            }

            if (! in_array($property->type, ['select', 'multiple_choice'])) {
                $property->values()->delete();
                continue;
            }

            foreach ($data['values'] as $value) {
                try {
                    $property->values()
                             ->findOrFail($value['id'] ?? null)
                             ->update([
                                 'value'   => $value['value'],
                                 'order'   => $value['order'],
                                 'goto_id' => $value['goto_id'] ?? null,
                             ]);
                } catch (ModelNotFoundException $e) {
                    $property->values()
                             ->create($value);
                }
            }
        }

        return redirect()->route('forms.edit', $form);
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return redirect()->route('forms.index');
    }
}
