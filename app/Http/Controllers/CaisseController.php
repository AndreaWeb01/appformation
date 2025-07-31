<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caisse;

class CaisseController extends Controller
{

    public function index()
    {
        $caisse = Caisse::first(); // On suppose qu'il y a une seule caisse pour l'instant

        if (!$caisse) {
            // Créez une nouvelle caisse si aucune n'existe
            $caisse = new Caisse();
            $caisse->montant_initial = 0; // Définissez un montant initial par défaut
            $caisse->solde_actuel = 0; // Définissez un solde actuel par défaut
            $caisse->save();
        }
        
        return view('caisses.index', compact('caisse'));
    }
}
