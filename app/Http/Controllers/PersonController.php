<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Affiliation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::with('affiliation')->get();
        return Inertia::render('People/Index', [
            'people' => $people,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $affiliations = Affiliation::all();
        return Inertia::render('People/Create', [
            'affiliations' => $affiliations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:people,email',
            'affiliation_id' => 'nullable|exists:affiliations,id',
        ]);

        Person::create($request->all());

        return redirect()->route('people.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        $affiliations = Affiliation::all();
        return Inertia::render('People/Edit', [
            'person' => $person,
            'affiliations' => $affiliations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:people,email,' . $person->id,
            'affiliation_id' => 'nullable|exists:affiliations,id',
        ]);

        $person->update($request->all());

        return redirect()->route('people.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index');
    }
}
