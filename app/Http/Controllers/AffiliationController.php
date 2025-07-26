<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AffiliationsExport;

class AffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affiliations = Affiliation::with('parent')->get();
        return Inertia::render('Affiliations/Index', [
            'affiliations' => $affiliations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Affiliation::all();
        return Inertia::render('Affiliations/Create', [
            'parents' => $parents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:affiliations,id',
        ]);

        Affiliation::create($request->all());

        return redirect()->route('affiliations.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(Affiliation $affiliation)
    {
        return Inertia::render('Affiliations/Show', [
            'affiliation' => $affiliation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Affiliation $affiliation)
    {
        $parents = Affiliation::where('id', '!=', $affiliation->id)->get();
        return Inertia::render('Affiliations/Edit', [
            'affiliation' => $affiliation,
            'parents' => $parents,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Affiliation $affiliation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:affiliations,id',
        ]);

        $affiliation->update($request->all());

        return redirect()->route('affiliations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affiliation $affiliation)
    {
        $affiliation->delete();

        return redirect()->route('affiliations.index');
    }

    /**
     * Export affiliations to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new AffiliationsExport, 'affiliations.xlsx');
    }
}
