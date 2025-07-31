<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('entreprises.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entreprises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:entreprises,email|max:255',
            'telephone' => 'required|string|max:15',
            'adresse' => 'required|string|max:255',
            'logo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour le logo
        ]);


        if($request->has('logo'))
        {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $logoPath = "logos_".time().'.'.$extension;
            $file->move('uploads/logos/', $logoPath);
        }

        // Création de l'entreprise
        $entreprise = new Entreprise();
        $entreprise->nom = $request->input('nom');
        $entreprise->email = $request->input('email');
        $entreprise->telephone = $request->input('telephone');
        $entreprise->adresse = $request->input('adresse');
        $entreprise->logo = $logoPath; // Sauvegarder le chemin du logo

        // Sauvegarder dans la base de données
        $entreprise->save();

        // Redirection avec un message de succès
        return redirect()->route('entreprises.index')->with('success', 'Entreprise créée avec succès.');
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
    public function destroy(string $id)
    {
        //
    }
}
