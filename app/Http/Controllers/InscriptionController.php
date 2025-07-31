<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Auditeur;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function inscrire(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|regex:/^[\pL\s\'-]+$/u',
            'prenom' => 'required|string|max:255|regex:/^[\pL\s\'-]+$/u',
            'email' => 'required|string|email|max:255|unique:auditeurs,email',
            'contact' => 'required|string|max:255|regex:/^\+?[0-9]+$/',
            'entreprise' => 'required|string|max:255|regex:/^[\pL\s\'-]+$/u',
            'session_id' => 'required|exists:sessions,id',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'nom.regex' => 'Le nom ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',

            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
            'prenom.regex' => 'Le prénom ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',

            'email.required' => 'L\'email est obligatoire.',
            'email.string' => 'L\'email doit être une chaîne de caractères.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.max' => 'L\'email ne peut pas dépasser 255 caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'contact.required' => 'Le contact est obligatoire.',
            'contact.string' => 'Le contact doit être une chaîne de caractères.',
            'contact.max' => 'Le contact ne peut pas dépasser 255 caractères.',
            'contact.regex' => 'Le contact ne peut contenir que des chiffres.',

            'entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
            'entreprise.string' => 'Le nom de l\'entreprise doit être une chaîne de caractères.',
            'entreprise.max' => 'Le nom de l\'entreprise ne peut pas dépasser 255 caractères.',
            'entreprise.regex' => 'Le nom de l\'entreprise ne peut contenir que des lettres, des espaces, des apostrophes et des tirets.',


        ]);

    
        $auditeur = Auditeur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'contact' => $request->contact,
            'entreprise' => $request->entreprise,
        ]);
    
        $session = Session::findOrFail($request->session_id);
        $session->auditeurs()->attach($auditeur->id);
    
        return redirect()->back()->with('success', 'Auditeur inscrit à la session avec succès');
    }

    public function desinscrire(Request $request)
    {
        $request->validate([
            'auditeur_id' => 'required|exists:auditeurs,id',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $session = Session::findOrFail($request->session_id);
        $session->auditeurs()->detach($request->auditeur_id);

        return redirect()->back()->with('success', 'Auditeur désinscrit de la session avec succès');
    }
}
