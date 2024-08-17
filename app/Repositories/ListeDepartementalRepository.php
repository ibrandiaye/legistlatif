<?php
namespace App\Repositories;

use App\Models\ListeDepartemental;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class ListeDepartementalRepository extends RessourceRepository{
    public function __construct(ListeDepartemental $listedepartemental){
        $this->model = $listedepartemental;
    }

  
    public function deleteAll(){
        return DB::table("listedepartementals")
        ->delete();
       }

       public function getByListe($liste_id,$departement_id){
        return DB::table("liste_departementals")
        ->where([["liste_id",$liste_id],["departement_id",$departement_id]])
        ->get();
       }
       public function getByOneListe($liste_id){
        return DB::table("liste_departementals")
        ->where("liste_id",$liste_id)
        ->orderBy("ordre","asc")
        ->get();
       }
       public function getByType($type,$departement_id){
        return DB::table("liste_departementals")
        ->where([["type",$type],["departement_id",$departement_id]])
        ->get();
       }
       public function getByListeAndType($liste_id,$type,$departement_id){
        return DB::table("liste_departementals")
        ->where([["type",$type],["liste_id",$liste_id],["departement_id",$departement_id]])
        ->get();
       }
       public function getByTypeAndListe($type,$liste_id){
        return DB::table("liste_departementals")
        ->where([["type",$type],["liste_id",$liste_id]])
        ->get();
       }

       public function changerEtat($id,$etat){
        return ListeDepartemental::where("id",$id)->update(["etat"=>$etat]);
       }
       public function getByCni($cni){
        return DB::table("liste_departementals")
        ->where('numcni',$cni)
        ->first();
       }

        public function getByCniOuterListe($cni,$liste){
        return DB::table("liste_departementals")
        ->whereNot('liste_id',$liste)
        ->where('numcni',$cni)
        ->first();
       }
       public function getByCniAndListe($cni,$liste){
        return DB::table("liste_departementals")
        ->where([['numcni',$cni],["liste_id",$liste]])
        ->first();
       }
       public function getByCniAndListeAndDepartement($cni,$liste,$departement_id){
        return DB::table("liste_departementals")
        ->where([['numcni',$cni],["liste_id",$liste],["departement_id",$departement_id  ]])
        ->first();
       }
       public function getByCniAndListeAndDepartementOuterOrdre($cni,$liste,$departement_id,$ordre){
        return DB::table("liste_departementals")
        ->where([['numcni',$cni],["liste_id",$liste],["departement_id",$departement_id  ]])
        ->whereNot('ordre',$ordre)
        ->first();
       }
       public function getByOrdreAndListe($ordre,$liste,$departement,$type){
        return DB::table("liste_departementals")
        ->where([['ordre',$ordre],["liste_id",$liste],["departement_id",$departement],["type",$type]])
        ->first();
       }
       public function getLastOrdreByListe($liste_id,$type,$departement){
        return DB::table("liste_departementals")
        ->where([["liste_id",$liste_id],['type',$type],
        ['departement_id',$departement]])
        ->orderBy("ordre",'desc')
        ->first();
       }
       
       public function getLastOrdreByListeAndOrdre($liste_id,$type,$departement,$ordre){
        return DB::table("liste_departementals")
        ->where([["liste_id",$liste_id],['type',$type],
        ['departement_id',$departement],['ordre',$ordre]])
        ->first();
       }
       public function countByTypeAndListe($type,$liste)
       {
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste],["type",$type]])
        ->count();
       }

       public function countByListeGroupByDepartementAndType($liste){
        return DB::table("liste_departementals")
       // ->where([["liste_id",$liste],["type",$type]])
        ->where("liste_id",$liste)
        ->select('departement_id','type', DB::raw('count(id) as nb'))
        ->groupBy("departement_id",'type')
        ->get();
       }

       public function deleteByListe($id)
       {
            return ListeDepartemental::where("liste_is",$id)->delete();
       }
       
}
