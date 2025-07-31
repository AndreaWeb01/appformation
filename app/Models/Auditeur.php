<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Auditeur extends Model
{
    use HasFactory;

    protected $fillable = ['matricule','nom', 'prenom', 'email', 'contact', 'entreprise'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($auditeur) {
            $auditeur->matricule = strtoupper(Str::random(10));
        });
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'session_auditeur');
    }

    public function versements()
    {
        return $this->hasMany(Versement::class);
    }


    // public function soldeRestantPourFormation(Session $session)
    // {
    // // Récupérer tous les paiements de l'auditeur pour cette formation
    // $paiements = $this->paiements()->whereHas('formation', function ($query) use ($session) 
    // {
    //     $query->where('session_id', $session->id);
    // })->get();
    
    // // Calculer le montant total dû pour la formation
    // $montantTotalDu = $session->formation->prix ;
    
    // // Calculer le montant total des paiements reçus
    // $montantTotalRecu = $paiements->sum('montant');

    // // Calculer le solde restant à payer
    // $soldeRestant = $montantTotalDu - $montantTotalRecu;

    // return $soldeRestant;

    // }
}
