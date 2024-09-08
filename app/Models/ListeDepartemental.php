<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeDepartemental extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom','prenom','numelecteur','sexe','profession','datenaiss','lieunaiss','liste_id','type','numcni','departement_id'
        ,'extrait_ou_cni','casier','etat','ordre',"erreur","erreurdge","domicile","se","doublon_externe","doublon_interne","parite"
    ];

}
