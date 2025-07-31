<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'montant_initial',
        'solde_actuel'
    ];

    public function entrees()
    {
        return $this->hasMany(Entree::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function versements()
    {
        return $this->hasMany(Versement::class);
    }

    public function totalEntrees()
    {
        return $this->entrees()->sum('montant');
    }

    public function totalDepenses()
    {
        return $this->depenses()->sum('montant');
    }

    // public function totalVersements()
    // {
    //     return $this->versements()->sum('montant');
    // }

    public function soldeCaisse()
    {
        return $this->montant_initial + $this->totalEntrees() - $this->totalDepenses();
    }
}
