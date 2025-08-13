<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Versement;
use App\Models\Auditeur;
use App\Models\Formation;
use App\Models\Session;
use App\Models\Entree;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class VersementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $versements = Versement::with('auditeur', 'formation')->get();
        return view('versements.index', compact('versements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auditeurs = Auditeur::all();
        $formations = Formation::all();
        return view('versements.create', compact('auditeurs', 'formations'));
    }

    public function createForAuditeur(Auditeur $auditeur)
    {
        $formations = Formation::all();
        return view('versements.create_for_auditeur', compact('auditeur', 'formations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Étape 1 – Validation initiale
    $request->validate([
        'auditeur_id' => 'required|exists:auditeurs,id',
        'session_id' => 'required|exists:sessions,id',
        'description' => 'required|string|in:Inscription,1er Versement,2eme Versement,3eme Versement,4eme Versement',
        'montant' => 'required|numeric|min:0',
        'date_versement' => 'required|date',
        'mode_paiement' => 'required|string|in:especes,carte bancaire,paiement mobile,virement bancaire',
    ]);

    // ✅ Étape 2 – Récupération des entités
    $auditeur = Auditeur::findOrFail($request->auditeur_id);
    $session = Session::findOrFail($request->session_id);

    // ✅ Étape 3 – Vérification : paiement total déjà effectué
    $totalVerse = Versement::where('auditeur_id', $auditeur->id)
        ->where('session_id', $session->id)
        ->sum('montant');

    if ($totalVerse >= $session->formation->prix) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['montant' => "Le client a déjà payé la totalité du montant de la formation. Aucun autre versement n'est autorisé."]);
    }

    // ✅ Étape 4 – Vérification : inscription obligatoire en premier
    $inscriptionExiste = Versement::where('auditeur_id', $auditeur->id)
        ->where('session_id', $session->id)
        ->where('description', 'Inscription')
        ->exists();

    if (!$inscriptionExiste && $request->description !== 'Inscription') {
        return redirect()->back()
            ->withInput()
            ->withErrors(['description' => "Le client doit d'abord payer l'inscription avant d'effectuer d'autres versements."]);
    }

    // ✅ Étape 5 – Vérification : pas de double paiement de l'inscription
    if ($inscriptionExiste && $request->description === 'Inscription') {
        return redirect()->back()
            ->withInput()
            ->withErrors(['description' => "Le paiement d'inscription a déjà été effectué pour ce client."]);
    }

    // ✅ Étape 6 – Vérification : ordre logique des versements
    $ordreVersements = [
        '2eme Versement' => '1er Versement',
        '3eme Versement' => '2eme Versement',
        '4eme Versement' => '3eme Versement',
    ];

    if (array_key_exists($request->description, $ordreVersements)) {
        $prerequis = $ordreVersements[$request->description];

        $versementPrecedentExiste = Versement::where('auditeur_id', $auditeur->id)
            ->where('session_id', $session->id)
            ->where('description', $prerequis)
            ->exists();

        if (!$versementPrecedentExiste) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['description' => "Vous devez d'abord effectuer le $prerequis avant de faire un $request->description."]);
        }
    }

    // ✅ Étape 7 – Vérification : pas deux fois le même type de versement
    $versementDejaFait = Versement::where('auditeur_id', $auditeur->id)
        ->where('session_id', $session->id)
        ->where('description', $request->description)
        ->exists();

    if ($versementDejaFait) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['description' => "Le versement '{$request->description}' a déjà été effectué pour ce client."]);
    }

    // ✅ Étape 8 – Vérification : pas de dépassement du reste à payer
    $resteAPayer = $session->formation->prix - $totalVerse;
    if ($request->montant > $resteAPayer) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['montant' => "Le montant du versement dépasse le reste à payer ({$resteAPayer} FCFA)."]);
    }

    // ✅ Étape 9 – Enregistrement du versement
    $versement = new Versement;
    $versement->auditeur_id = $auditeur->id;
    $versement->session_id = $session->id;
    $versement->description = $request->description;
    $versement->montant = $request->montant;
    $versement->resteapayer = $resteAPayer - $request->montant;
    $versement->date_versement = $request->date_versement;
    $versement->mode_paiement = $request->mode_paiement;
    $versement->save();

    // ✅ Étape 10 – Enregistrement dans la caisse
    $entree = new Entree;
    $entree->description = 'versement - ' . $versement->description;
    $entree->montant = $versement->montant;
    $entree->date_entree = now();
    $entree->versement_id = $versement->id;
    $entree->caisse_id = 1;
    $entree->save();

    return redirect()->route('versements.par_auditeur_session', [
        'auditeur_id' => $auditeur->id,
        'session_id' => $session->id
    ])->with('success', 'Versement enregistré avec succès.');
       
    }

    /**
     * Display the specified resource.
     */
    public function show($auditeur_id, $session_id)
    {
        $auditeur = Auditeur::findOrFail($auditeur_id);
        $session = Session::findOrFail($session_id);
    
        // Calculer la somme totale des montants des versements pour l'auditeur et la session
        $somme_versements = Versement::where('auditeur_id', $auditeur->id)
                                     ->where('session_id', $session->id)
                                     ->sum('montant');
    
        // Calculer le montant restant à payer
        $reste_a_payer = $session->formation->prix - $somme_versements;
    
        // Récupérer tous les versements pour cette session et cet auditeur
        $versements = Versement::where('auditeur_id', $auditeur->id)
                               ->where('session_id', $session->id)
                               ->get();
    
        return view('versements.par_auditeur_session', compact('auditeur', 'session', 'versements', 'reste_a_payer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $versement = Versement::findOrFail($id);
        $session = $versement->session;
        $auditeur = $versement->auditeur;
        
        return view('versements.edit', compact('versement', 'session', 'auditeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'auditeur_id' => 'required|exists:auditeurs,id',
            'session_id' => 'required|exists:sessions,id',
            'description' => 'required|string',
            'montant' => 'required|numeric|min:0',
            'date_versement' => 'required|date',
            'mode_paiement' => 'required|string',
        ]);

        $versement = Versement::findOrFail($id);
        $session = $versement->session;
        $formation = $session->formation;

        

        // Calculer la somme des versements autres que celui en cours de modification
        $totalVersements = Versement::where('auditeur_id', $versement->auditeur_id)
                                    ->where('session_id', $versement->session_id)
                                    ->where('id', '!=', $id)
                                    ->sum('montant');

        // Calculer le reste à payer
        $resteAPayer = $formation->prix - ($totalVersements + $request->montant);

        $versement->update([
            'montant' => $request->montant,
            'date_versement' => $request->date_versement,
            'mode_paiement' => $request->mode_paiement,
            'description' => $request->description,
        ]);

        return redirect()->route('versements.par_auditeur_session', [
            'auditeur_id' => $versement->auditeur_id,
            'session_id' => $versement->session_id
        ])->with('success', 'Versement mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Versement $versement)
    // {
    //     $versement->delete();

    //     return redirect()->route('versements.par_auditeur_session')->with('success', 'Versement supprimé avec succès');
    // }

    public function destroy($id)
    {
        $versement = Versement::findOrFail($id);
        $versement->delete();

        return redirect()->back()->with('success', 'Versement et ses entrées associées ont été supprimés avec succès!');
    }

    public function versementsByAuditeur($auditeurId)
    {
        $auditeur = Auditeur::findOrFail($auditeurId);
        $versements = Versement::where('auditeur_id', $auditeurId)->with('formation')->get();
        return view('versements.by_auditeur', compact('auditeur', 'versements'));
    }




    public function versementsParAuditeurEtSession($auditeur_id, $session_id)
    {
        $auditeur = Auditeur::findOrFail($auditeur_id);
        $session = Session::findOrFail($session_id);

        // Vérifier si l'auditeur est inscrit à la session
        if (!$auditeur->sessions->contains($session->id)) {
            return redirect()->back()->with('error', 'L\'auditeur n\'est pas inscrit à cette session.');
        }

        // Récupérer les versements de l'auditeur pour cette session
        $versements = $auditeur->versements()->where('session_id', $session->id)->get();

        return view('versements.par_auditeur_session', compact('auditeur', 'session', 'versements'));
    }

    public function createVersementParAuditeurEtSession($auditeur_id, $session_id)
    {
        $auditeur = Auditeur::findOrFail($auditeur_id);
        $session = Session::findOrFail($session_id);

        return view('versements.creer_par_auditeur_session', compact('auditeur', 'session'));
    }

}
