<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Formation;
use App\Models\Auditeur;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $formations = Formation::all();
        return view('sessions.create', compact('formations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'nbreplaces' => 'required|integer|min:1',
        ],[
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_debut.after' => 'La date de début doit être postérieure à aujourd\'hui.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
            'nbreplaces.required' => 'Le nombre de places est obligatoire.',
            'nbreplaces.integer' => 'Le nombre de places doit être un entier.',
            'nbreplaces.min' => 'Le nombre de places doit être au moins 1.',
        ]);

        // Session::create($request->all());
        Session::create([
            'formation_id' => $request->formation_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'nbre_place' => $request->nbreplaces,
        ]);

        return redirect()->route('sessions.by_formation', ['formation' => $request->formation_id])->with('success', 'Session créée avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $session = Session::with('auditeurs', 'formation')->findOrFail($id);
        $auditeurs = Auditeur::all(); // Récupérer tous les auditeurs disponibles
        return view('sessions.show', compact('session', 'auditeurs'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        $formations = Formation::all();
        return view('sessions.edit', compact('session', 'formations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'nbreplaces' => 'required|integer|min:1',
        ],[
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_debut.after' => 'La date de début doit être postérieure à aujourd\'hui.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
            'nbreplaces.required' => 'Le nombre de places est obligatoire.',
            'nbreplaces.integer' => 'Le nombre de places doit être un entier.',
            'nbreplaces.min' => 'Le nombre de places doit être au moins 1.',
        ]);

        $session->formation_id = $request->formation_id;
        $session->date_debut = $request->date_debut;
        $session->date_fin = $request->date_fin;
        $session->nbre_place = $request->nbreplaces;
        $session->save();

        return redirect()->route('sessions.index')->with('success', 'Session à été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Session supprimé avec succès');
    }

    
    public function sessionsByFormation($formationId)
    {
        $formation = Formation::findOrFail($formationId);
        $sessions = Session::where('formation_id', $formationId)->get();
        return view('sessions.by_formation', compact('formation', 'sessions'));
    }

    public function createForFormation(Formation $formation)
    {
        return view('sessions.create_for_formation', compact('formation'));
    }
}
