<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeNational extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom','prenom','numelecteur','sexe','profession','datenaiss','lieunaiss','liste_id','type','numcni'
        ,'extrait_ou_cni','casier','etat','ordre',"erreur","erreurdge","domicile","se","doublon_externe"
        ,"doublon_interne","parite","sur_le_fichier","commune","verif",'commentaire'
    ];

}
