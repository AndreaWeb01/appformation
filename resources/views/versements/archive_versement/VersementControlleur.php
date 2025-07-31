<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Versement;
use App\Models\Auditeur;
use App\Models\Formation;
use App\Models\Session;

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
    public function store(Request $request,)
    {
        // $request->validate([
        //     'auditeur_id' => 'required|exists:auditeurs,id',
        //     'session_id' => 'required|exists:sessions,id',
        //     'description' => 'required|string|in:Inscription,1er Versement,2eme Versement,3eme Versement,4eme Versement',
        //     'montant' => 'required|numeric|min:0',
        //     'date_versement' => 'required|date',
        //     'mode_paiement' => 'required|string|in:especes,carte bancaire,paiement mobile,virement bancaire',
        // ], [
        //     'description.required' => "L'intitulé du versement est obligatoire.",
        //     'description.in' => "L'intitulé du versement sélectionné n'est pas valide.",
        //     'montant.required' => 'Le montant est obligatoire.',
        //     'montant.numeric' => 'Le montant doit être un nombre.',
        //     'montant.min' => 'Le montant doit être supérieur ou égal à 0.',
        //     'date_versement.required' => 'La date de versement est obligatoire.',
        //     'date_versement.date' => 'La date de versement doit être une date valide.',
        //     'mode_paiement.required' => 'Le mode de paiement est obligatoire.',
        //     'mode_paiement.in' => 'Le mode de paiement sélectionné n\'est pas valide.',
        // ]);

        // Récupérer l'auditeur et la session à partir des IDs fournis dans la requête
        $auditeur = Auditeur::findOrFail($request->auditeur_id);
        $session = Session::findOrFail($request->session_id);

        // Calculer la somme totale des montants des versements après ajout du nouveau versement
        // $versements = Versement::where('auditeur_id', $auditeur->id)
        //                          ->where('session_id', $session->id)
        //                          ->get();
        // Calculer la somme totale des montants des versements
        // $somme_versements = $versements->sum($request->montant);
        $somme_versements = DB::table('versements')->sum('montant');
        // $somme_versements = DB::table('versements')->sum('montant') + $request->montant;

        $cout = $session->formation->prix;

         //Calculer le nouveau montant restant à payer
        $nouveau_reste_a_payer = $session->formation->prix - ($somme_versements + $request->montant);

        //  Log::info("Somme des versements: {$somme_versements}");
        //  Log::info("Nouveau montant restant à payer: {$nouveau_reste_a_payer}");

        // Créer le nouveau versement
        // Versement::create([
        //     'auditeur_id' => $request->auditeur_id,
        //     'session_id' => $request->session_id,
        //     'description' => $request->description,
        //     'montant' => $request->montant,
        //     'resteapayer' => $nouveau_reste_a_payer,
        //     'date_versement' => $request->date_versement,
        //     'mode_paiement' => $request->mode_paiement,
        // ]);

        // $versement = new Versement;
        // $versement->auditeur_id = $request->auditeur_id;
        // $versement->session_id = $request->session_id;
        // $versement->description = $request->description;
        // $versement->montant = $request->montant;
        // $versement->resteapayer = $nouveau_reste_a_payer;
        // $versement->date_versement = $request->date_versement;
        // $versement->mode_paiement = $request->mode_paiement;
        // $versement->save();

        dd($somme_versements, $nouveau_reste_a_payer,$cout);

        // // Calculer la somme totale des montants des versements après ajout du nouveau versement
        // // $versements = Versement::where('auditeur_id', $auditeur->id)
        // //                          ->where('session_id', $session->id)
        // //                          ->get();
        
        // // // Calculer la somme totale des montants des versements
        // // $somme_versements = $versements->sum('montant');

        // // // Calculer le nouveau montant restant à payer
        // // $nouveau_reste_a_payer = $session->formation->prix - $somme_versements;

        return redirect()->route('versements.par_auditeur_session', [
            'auditeur_id' => $request->auditeur_id,
            'session_id' => $request->session_id
            ])->with([
                'success', 'Versement ajouté avec succès',
            ]);

       
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
    public function destroy(string $id)
    {
        //
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
