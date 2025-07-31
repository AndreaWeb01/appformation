<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'montant', 'date_entree', 'versement_id', 'caisse_id'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function versement()
    {
        return $this->belongsTo(Versement::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
}
