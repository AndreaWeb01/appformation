<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'montant', 'date_depense', 'session_id', 'caisse_id'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function scopeTotalDepenses($query)
    {
        return $query->sum('montant');
    }
}
