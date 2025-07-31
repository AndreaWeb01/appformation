<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['formation_id', 'code', 'date_debut', 'date_fin', 'nbre_place'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($session) {
            $session->code = strtoupper(Str::random(10));
        });
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function auditeurs()
    {
        return $this->belongsToMany(Auditeur::class, 'session_auditeur');
    }

    public function versements()
    {
        return $this->hasMany(Versement::class);
    }

}
