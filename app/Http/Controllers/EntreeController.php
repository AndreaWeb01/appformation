<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entree;
use App\Models\Versement;

class EntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $entreesQuery = Entree::query();

        // Filtrer par année et mois si une date est fournie
        if ($request->has('date_filtre')) {
            $dateFiltre = $request->input('date_filtre');
            $entreesQuery->whereYear('created_at', date('Y', strtotime($dateFiltre)))
                            ->whereMonth('created_at', date('m', strtotime($dateFiltre)));
        }

        $entrees = $entreesQuery->get();
        $versementTotal = Versement::sum('montant');
        return view('entrees.index', compact('entrees','versementTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entrees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_entree' => 'required|date',
            'description' => 'required|string|max:225|regex:/^[\pL\s\'-]+$/u',
        ], [
            'date_entree.required' => 'La date est obligatoire.',
            'date_entree.date' => 'La date doit être une date valide.',
            
            'montant.required' => 'Le montant est obligatoire.',
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.min' => 'Le montant doit être au moins de 0.',
            
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 255 caractères.',
            'description.regex' => 'La description ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',
        ]);

        Entree::create([
            'description' => $request->description,
            'montant' => $request->montant,
            'date_entree' => $request->date_entree,
            'session_id' => $request->session_id,
            'caisse_id' => $request->caisse_id,
        ]);

        return redirect()->route('entrees.index')->with('success', 'Entrée créée avec succès.');
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
    public function edit(Entree $entree)
    {
        return view('entrees.edit', compact('entree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entree $entree)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'date_entree' => 'required|date',
            'description' => 'required|string|max:225|regex:/^[\pL\s\'-]+$/u',
            // 'source' => 'required|string',
        ], [
            'date_entree.required' => 'La date est obligatoire.',
            'date_entree.date' => 'La date doit être une date valide.',
            
            'montant.required' => 'Le montant est obligatoire.',
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.min' => 'Le montant doit être au moins de 0.',
            
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 255 caractères.',
            'description.regex' => 'La description ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',
        ]);

        $entree->update($request->all());

        return redirect()->route('entrees.index')->with('success', 'Entrée mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entree $entree)
    {
        $entree->delete();

        return redirect()->route('entrees.index')->with('success', 'Entrée supprimée avec succès.');
    }

}
