<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AuditeurController;
use App\Http\Controllers\VersementController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepriseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/liste_auditeur', function () { return view('auditeur.liste'); });
Route::get('/add_auditeur', function () { return view('auditeur.ajouter'); });

Route::resource('entreprises', EntrepriseController::class);

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //FORMATION
    Route::resource('formations', FormationController::class);
    Route::get('/searchFormation', [FormationController::class, 'search'])->name('formations.search');


    //SESSION
    Route::resource('sessions', SessionController::class);
    Route::get('sessions/formation/{formation}', [SessionController::class, 'sessionsByFormation'])->name('sessions.by_formation');
    Route::get('sessions/create/{formation}/', [SessionController::class, 'createForFormation'])->name('sessions.createForFormation');

    // Route pour inscrire un auditeur à une session
    Route::post('/inscriptions', [InscriptionController::class, 'inscrire'])->name('inscriptions.inscrire');

    // Route pour désinscrire un auditeur d'une session
    Route::delete('/inscriptions', [InscriptionController::class, 'desinscrire'])->name('inscriptions.desinscrire');

    //AUDITEUR
    Route::resource('auditeurs', AuditeurController::class);
    
    //VERSEMENT
    Route::get('versements/auditeur/create/{auditeur_id}/session/{session_id}', [VersementController::class, 'createVersementParAuditeurEtSession'])->name('versements.createParAuditeurEtSession');
    Route::post('versements', [VersementController::class, 'store'])->name('versements.store');
    Route::delete('versements/{id}', [VersementController::class, 'destroy'])->name('versements.destroy');
    // Route::get('versements/{versement}/delete', [VersementController::class,'versements.destroy'])->name('versement.destroy');
    // Route pour afficher les versements par auditeur et session
    Route::get('/versements/auditeur/{auditeur_id}/session/{session_id}', [VersementController::class, 'show'])->name('versements.par_auditeur_session');
   
   
    // Route::resource('versements', VersementController::class);
    // Route::get('/versements/auditeur/{auditeurId}', [VersementController::class, 'versementsByAuditeur'])->name('versements.by_auditeur');
    // Route::get('versements/create/{auditeur}', [VersementController::class, 'createForAuditeur'])->name('versements.createForAuditeur');
    
    // Route::get('/versements/auditeur/{auditeur_id}/session/{session_id}', [VersementController::class, 'versementsParAuditeurEtSession'])
    //  ->name('versements.par_auditeur_session');
    

    //ENTREES
    Route::resource('entrees', EntreeController::class);





    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:Admin'])->group(function()
{
    Route::get('/admin/dashboard', [AdminController::class, 'Admindashboard'])->name('admin.dashboard');

    //DEPENSES
    Route::resource('depenses', DepenseController::class);

    //CAISSE
    Route::get('/caisses', [CaisseController::class, 'index'])->name('caisses.index');
});

