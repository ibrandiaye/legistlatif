<?php
namespace App\Repositories;

use App\Models\Liste;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class ListeRepository extends RessourceRepository{
    public function __construct(Liste $liste){
        $this->model = $liste;
    }

    public function getListeAsc(){
        return DB::table("listes")
        ->orderBy("nom","asc")
        ->get();

    }
    public function deleteAll(){
        return DB::table("listes")
        ->delete();
       }

   



}
