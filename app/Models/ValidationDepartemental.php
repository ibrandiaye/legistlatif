<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationDepartemental extends Model
{
    use HasFactory;
    protected $fillable = [
        'liste_id','etat','departement_id','commentaire'
    ];
    protected  function liste()
    {
        return $this->hasOne(Liste::class);
    }
    protected  function departement()
    {
        return $this->hasOne(Departement::class);
    }
}
