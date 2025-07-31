<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use App\Models\Entree;
use App\Models\Auditeur;
use App\Models\Formation;
use App\Models\Session;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function Admindashboard()
    {
        // Obtenez l'année en cours
        $anneeEnCours = Carbon::now()->year;

        // Calculer les entrées totales et les dépenses totales pour l'année en cours
        $totalEntrees = Entree::whereYear('date_entree', $anneeEnCours)->sum('montant');
        $totalDepenses = Depense::whereYear('date_depense', $anneeEnCours)->sum('montant');

        // Calculer le budget total
        $budgetTotal = $totalEntrees - $totalDepenses;

        // Date de début et de fin des semestres
        $debutPremierSemestre = Carbon::createFromDate($anneeEnCours, 1, 1);
        $finPremierSemestre = Carbon::createFromDate($anneeEnCours, 6, 30);
        $debutDeuxiemeSemestre = Carbon::createFromDate($anneeEnCours, 7, 1);
        $finDeuxiemeSemestre = Carbon::createFromDate($anneeEnCours, 12, 31);

        // Calculer les entrées et les dépenses pour le premier semestre
        $entreesPremierSemestre = Entree::whereBetween('date_entree', [$debutPremierSemestre, $finPremierSemestre])->sum('montant');
        $depensesPremierSemestre = Depense::whereBetween('date_depense', [$debutPremierSemestre, $finPremierSemestre])->sum('montant');
        $budgetPremierSemestre = $entreesPremierSemestre - $depensesPremierSemestre;

        // Calculer les entrées et les dépenses pour le deuxième semestre
        $entreesDeuxiemeSemestre = Entree::whereBetween('date_entree', [$debutDeuxiemeSemestre, $finDeuxiemeSemestre])->sum('montant');
        $depensesDeuxiemeSemestre = Depense::whereBetween('date_depense', [$debutDeuxiemeSemestre, $finDeuxiemeSemestre])->sum('montant');
        $budgetDeuxiemeSemestre = $entreesDeuxiemeSemestre - $depensesDeuxiemeSemestre;
        
        // $resultatsDepenses = $this->calculerDepensesSemestrielles();
        $depensesTotal = Depense::sum('montant');

        $auditeurTotal = Auditeur::count();
        $sessionTotal = Session::count();
        $formationTotal = Formation::count();

        return view('admin.admin_dashboard', [
            'budgetTotal' => $budgetTotal,
            'auditeurTotal' => $auditeurTotal ,
            'sessionTotal' => $sessionTotal,
            'formationTotal' => $formationTotal,
            'budgetPremierSemestre' => $budgetPremierSemestre,
            'budgetDeuxiemeSemestre' => $budgetDeuxiemeSemestre,
            
            'depensesTotal' => $depensesTotal,
            'depensesPremierSemestre' => $depensesPremierSemestre,
            'depensesDeuxiemeSemestre' => $depensesDeuxiemeSemestre,
            
        ]);
    }

    // public function calculerDepensesSemestrielles()
    // {
    //     // Obtenez l'année en cours
    //     $anneeEnCours = Carbon::now()->year;

    //     // Date de début et de fin du premier semestre (janvier à juin)
    //     $debutPremierSemestre = Carbon::createFromDate($anneeEnCours, 1, 1);
    //     $finPremierSemestre = Carbon::createFromDate($anneeEnCours, 6, 30);

    //     // Date de début et de fin du deuxième semestre (juillet à décembre)
    //     $debutDeuxiemeSemestre = Carbon::createFromDate($anneeEnCours, 7, 1);
    //     $finDeuxiemeSemestre = Carbon::createFromDate($anneeEnCours, 12, 31);

    //     // Récupérez les dépenses pour chaque semestre
    //     $depensesPremierSemestre = Depense::whereBetween('date_depense', [$debutPremierSemestre, $finPremierSemestre])
    //                                     ->sum('montant');

    //     $depensesDeuxiemeSemestre = Depense::whereBetween('date_depense', [$debutDeuxiemeSemestre, $finDeuxiemeSemestre])
    //                                     ->sum('montant');

    //     return [
    //         'depenses_premier_semestre' => $depensesPremierSemestre,
    //         'depenses_deuxieme_semestre' => $depensesDeuxiemeSemestre,
    //     ];
    // }

    public function index()
    {   // Obtenez l'année en cours
        $anneeEnCours = Carbon::now()->year;

        // Calculer les entrées totales et les dépenses totales pour l'année en cours
        $totalEntrees = Entree::whereYear('date_entree', $anneeEnCours)->sum('montant');
        $totalDepenses = Depense::whereYear('date_depense', $anneeEnCours)->sum('montant');

        // Calculer le budget total
        $budgetTotal = $totalEntrees - $totalDepenses;

        // Date de début et de fin des semestres
        $debutPremierSemestre = Carbon::createFromDate($anneeEnCours, 1, 1);
        $finPremierSemestre = Carbon::createFromDate($anneeEnCours, 6, 30);
        $debutDeuxiemeSemestre = Carbon::createFromDate($anneeEnCours, 7, 1);
        $finDeuxiemeSemestre = Carbon::createFromDate($anneeEnCours, 12, 31);

        // Calculer les entrées et les dépenses pour le premier semestre
        $entreesPremierSemestre = Entree::whereBetween('date_entree', [$debutPremierSemestre, $finPremierSemestre])->sum('montant');
        $depensesPremierSemestre = Depense::whereBetween('date_depense', [$debutPremierSemestre, $finPremierSemestre])->sum('montant');
        $budgetPremierSemestre = $entreesPremierSemestre - $depensesPremierSemestre;

        // Calculer les entrées et les dépenses pour le deuxième semestre
        $entreesDeuxiemeSemestre = Entree::whereBetween('date_entree', [$debutDeuxiemeSemestre, $finDeuxiemeSemestre])->sum('montant');
        $depensesDeuxiemeSemestre = Depense::whereBetween('date_depense', [$debutDeuxiemeSemestre, $finDeuxiemeSemestre])->sum('montant');
        $budgetDeuxiemeSemestre = $entreesDeuxiemeSemestre - $depensesDeuxiemeSemestre;
        
        // $resultatsDepenses = $this->calculerDepensesSemestrielles();
        $depensesTotal = Depense::sum('montant');
        
        $auditeurTotal = Auditeur::count();
        $sessionTotal = Session::count();
        $formationTotal = Formation::count();

        return view('admin.admin_dashboard', [
            'budgetTotal' => $budgetTotal,
            'auditeurTotal' => $auditeurTotal ,
            'sessionTotal' => $sessionTotal,
            'formationTotal' => $formationTotal,
            'budgetPremierSemestre' => $budgetPremierSemestre,
            'budgetDeuxiemeSemestre' => $budgetDeuxiemeSemestre,
            
            'depensesTotal' => $depensesTotal,
            'depensesPremierSemestre' => $depensesPremierSemestre,
            'depensesDeuxiemeSemestre' => $depensesDeuxiemeSemestre,
            
        ]);
    }
}
    