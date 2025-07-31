<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $depensesQuery = Depense::query();

        // Filtrer par année et mois si une date est fournie
        if ($request->has('date_filtre')) {
            $dateFiltre = $request->input('date_filtre');
            $depensesQuery->whereYear('created_at', date('Y', strtotime($dateFiltre)))
                            ->whereMonth('created_at', date('m', strtotime($dateFiltre)));
        }

        $depenses = $depensesQuery->get();

        return view('depenses.index', compact('depenses'));

        // $depenses = Depense::all();
        // return view('depenses.index', compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_depense' => 'required|date',
            'description' => 'required|string|max:255|regex:/^[\pL\s\'-]+$/u',
        ], [
            'date_depense.required' => 'La date est obligatoire.',
            'date_depense.date' => 'La date doit être une date valide.',
    
            'montant.required' => 'Le montant est obligatoire.',
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.min' => 'Le montant doit être au moins de 0.',
    
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 255 caractères.',
            'description.regex' => 'La description ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',
        ]);

        Depense::create([
            'description' => $request->description,
            'montant' => $request->montant,
            'date_depense' => $request->date_depense,
            'caisse_id' => $request->caisse_id,
        ]);

        return redirect()->route('depenses.index')->with('success', 'Depense ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->route('depenses.index')->with('success', 'Depense supprimée avec succès.');
    }
}
