<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationNational extends Model
{
    use HasFactory;
    protected $fillable = [
        'liste_id','etat','commentaire'
    ];
    protected  function liste()
    {
        return $this->hasOne(Liste::class);
    }
}
