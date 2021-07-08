<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;

class GroupController
{
    public function index(Form $form)
    {
        return view('groups.index', compact('form'));
    }

    public function create(Form $form)
    {
        $groupedProperties = $form->groups()
                                  ->get()
                                  ->pluck('properties')
                                  ->flatten()
                                  ->pluck('id');

        $properties = $form->properties()->whereKeyNot($groupedProperties)->get();

        return view('groups.create', compact('form', 'properties'));
    }

    public function edit(Form $form, Group $group)
    {
        $groupedProperties = $form->groups()
                                  ->get()
                                  ->pluck('properties')
                                  ->flatten()
                                  ->whereNotIn('id', $group->properties()->pluck('properties.id'))
                                  ->pluck('id');

        $properties = $form->properties()->whereKeyNot($groupedProperties)->get();

        return view('groups.edit', compact('form', 'group', 'properties'));
    }

    public function store(GroupRequest $request, Form $form)
    {
        $form->groups()
             ->create($request->only('title'))
             ->properties()
             ->sync($request->properties);

        return redirect()->route('forms.groups.index', $form);
    }

    public function update(GroupRequest $request, Form $form, Group $group)
    {
        $group->update($request->only('title'));

        $group->properties()->sync($request->properties);

        return redirect()->route('forms.groups.index', $form);
    }

    public function destroy(Form $form, Group $group)
    {
        $group->delete();

        return back();
    }
}
