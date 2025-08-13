<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Formation;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $formationsQuery = Formation::query();

        // // Filtrer par année et mois si une date est fournie
        // if ($request->has('date_filtre')) {
        //     $dateFiltre = $request->input('date_filtre');
        //     $formationsQuery->whereYear('created_at', date('Y', strtotime($dateFiltre)))
        //                     ->whereMonth('created_at', date('m', strtotime($dateFiltre)));
        // }

        // $formations = $formationsQuery->Orderby('created_at', 'desc')->get();
        $formations = Formation::orderBy('created_at', 'desc')->get();

        return view('formations.index', compact('formations'));

        // $formations = Formation::all();
        // return view('formations.index', compact('formations'));
    }

    public function search(Request $request){

        // $search = $request->search;

        // $formations = Formation::where(function ($query) use ($search)
        // {
        //     $query->where('nom','like',"%$search%")
        // })->get();


        $search = $request->search;

        $formations = Formation::where(function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%");
        })->get();

        return view('formations.index', compact('formations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomform' => 'required|string|max:255|regex:/^[\pL\s\'-]+$/u',
            'prixform' => 'required|numeric|min:0',
            'dureeform' => 'required|integer|min:1',
            'montant_inscrip'=> 'required|numeric|min:0',
            'descform' => 'required|string|max:1000|regex:/^[\pL\s\'-]+$/u',
        ], [
            'nomform.required' => 'Le nom de la formation est obligatoire.',
            'nomform.string' => 'Le nom de la formation doit être une chaîne de caractères.',
            'nomform.max' => 'Le nom de la formation ne peut pas dépasser 255 caractères.',
            'nomform.regex' => 'Le nom de la formation ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',
            
            'descform.string' => 'La description doit être une chaîne de caractères.',
            'descform.required' => 'La description est obligatoire.',
            'descform.max' => 'Le nom de la formation ne peut pas dépasser 1000 caractères.',
            'descform.regex' => 'Le champ Description de la formation ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',
        
            'dureeform.required' => 'La durée de la formation est obligatoire.',
            'dureeform.integer' => 'La durée de la formation doit être un entier.',
            'dureeform.min' => 'La durée de la formation doit être au moins de 1.',
        
            'prixform.required' => 'Le prix de la formation est obligatoire.',
            'prixform.numeric' => 'Le prix de la formation doit être un nombre.',
            'prixform.min' => 'Le prix de la formation doit être au moins de 0.',

            'montant_inscrip.required' => 'Le montant de l\'inscription est obligatoire.',
            'montant_inscrip.numeric' => 'Le montant de l\'inscription doit être un nombre.',
            'montant_inscrip.min' => 'Le montant de l\'inscription  doit être au moins de 0.',
        ]);


        $formation = new Formation;
        $formation->nom = $request->nomform;
        $formation->prix = $request->prixform;
        $formation->duree = $request->dureeform;
        $formation->montant_inscription = $request->montant_inscrip;
        $formation->description = $request->descform;
        $formation->save();

        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès');
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
    public function edit(Formation $formation)
    {
        return view('formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'nomform' => 'required|string|max:255|regex:/^[\pL\s\'-]+$/u',
            'dureeform' => 'required|integer|min:1',
            'prixform' => 'required|numeric|min:0',
            'descform' => 'required|string|max:1000|regex:/^[\pL\s\'-]+$/u',
        ], [
            'nomform.required' => 'Le nom de la formation est obligatoire.',
            'nomform.string' => 'Le nom de la formation doit être une chaîne de caractères.',
            'nomform.max' => 'Le nom de la formation ne peut pas dépasser 255 caractères.',
            'nomform.regex' => 'Le nom de la formation ne peut contenir que des lettres, des espaces et des tirets.',
            
            'descform.string' => 'La description doit être une chaîne de caractères.',
            'descform.required' => 'La description est obligatoire.',
            'descform.max' => 'Le nom de la formation ne peut pas dépasser 1000 caractères.',
            'descform.regex' => 'Le champ Description de la formation ne peut contenir que des lettres, des espaces et des tirets.',
        
            'dureeform.required' => 'La durée de la formation est obligatoire.',
            'dureeform.integer' => 'La durée de la formation doit être un entier.',
            'dureeform.min' => 'La durée de la formation doit être au moins de 1.',
        
            'prixform.required' => 'Le prix de la formation est obligatoire.',
            'prixform.numeric' => 'Le prix de la formation doit être un nombre.',
            'prixform.min' => 'Le prix de la formation doit être au moins de 0.',
        ]);

        $formation->nom = $request->nomform;
        $formation->description = $request->descform;
        $formation->duree = $request->dureeform;
        $formation->prix = $request->prixform;
    
        // Sauvegarder les changements
        $formation->save();

        return redirect()->route('formations.index')->with('success', 'Formation à été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()->route('formations.index')->with('success', 'Formation supprimé avec succès');
    }
}
