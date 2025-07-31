<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    use HasFactory;

    protected $fillable = ['auditeur_id', 'session_id', 'description', 'montant', 'reste_a_payer', 'date_versement', 'mode_paiement'];

    public function auditeur()
    {
        return $this->belongsTo(Auditeur::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function versement()
    {
        return $this->belongsTo(Versement::class, 'id_versement');
    }

    public function entrees()
    {
        return $this->hasMany(Entree::class, 'id_versement');
    }
}
