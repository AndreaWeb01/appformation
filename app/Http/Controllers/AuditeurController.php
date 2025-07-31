<?php

namespace App\Http\Controllers;

use App\Models\Auditeur;
use Illuminate\Http\Request;

class AuditeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditeurs = Auditeur::all();
        return view('auditeurs.index', compact('auditeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auditeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:auditeurs',
            'contact' => 'required|string|max:15',
            'entreprise' => 'required|string|max:255',
        ]);

        // Auditeur::create($request->all());
        Auditeur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'contact' => $request->contact,
            'entreprise' => $request->entreprise,
        ]);

        return redirect()->route('auditeurs.index')->with('success', 'Auditeur créé avec succès');
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
    public function edit(Auditeur $auditeur)
    {
        return view('auditeurs.edit', compact('auditeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auditeur $auditeur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:auditeurs,email,' . $auditeur->id,
            'contact' => 'required|string|max:15',
            'entreprise' => 'required|string|max:255',
        ]);

        $auditeur->nom = $request->nom;
        $auditeur->prenom = $request->prenom;
        $auditeur->email = $request->email;
        $auditeur->contact = $request->contact;
        $auditeur->entreprise = $request->entreprise;
        $auditeur->save();

        return redirect()->route('auditeurs.index')->with('success', 'Auditeur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auditeur $auditeur)
    {
        $auditeur->delete();

        return redirect()->route('auditeurs.index')->with('success', 'Auditeur supprimé avec succès');
    }
}
