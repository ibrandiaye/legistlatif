<?php
namespace App\Repositories;

use App\Models\ListeNational;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class ListeNationalRepository extends RessourceRepository{
    public function __construct(ListeNational $listenational){
        $this->model = $listenational;
    }

    public function deleteAll(){
        return DB::table("listenationals")
        ->delete();
       }
       public function getByListe($liste_id){
        return DB::table("liste_nationals")
        ->where("liste_id",$liste_id)
        ->orderBy("ordre","asc")
        ->get();
       }
       public function getByType($type){
        return DB::table("liste_nationals")
        ->where("type",$type)
        ->get();
       }
       public function getByListeAndType($liste_id,$type){
        return DB::table("liste_nationals")
        ->where([["type",$type],["liste_id",$liste_id]])
        ->orderBy("ordre","asc")
        ->get();
       }
       public function changerEtat($id,$etat){
        return ListeNational::where("id",$id)->update(["etat"=>$etat]);
       }
      
       public function getByCni($cni){
        return DB::table("liste_nationals")
        ->where('numcni',$cni)
        ->first();
       }
       public function getByCniBordre($cni,$ordre){
        return DB::table("liste_nationals")
        ->whereNot("ordre",$ordre)
        ->where('numcni',$cni)
        ->first();
       }
       public function getByCniAndListe($cni,$liste){
        return DB::table("liste_nationals")
        ->where([['numcni',$cni],["liste_id",$liste]])
        ->first();
       }
       public function getByCniOuterListe($cni,$liste){
        return DB::table("liste_nationals")
        ->whereNot("liste_id",$liste)
        ->where('numcni',$cni)
        ->first();
       }
       public function getByOrdreAndListe($ordre,$liste,$type){
        return DB::table("liste_nationals")
        ->where([['ordre',$ordre],["liste_id",$liste],["type",$type]])
        ->first();
       }
       public function getLastOrdreByListe($liste_id,$type){
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste_id],["type",$type]])
        ->orderBy("ordre",'desc')
        ->first();
       }
       public function getLastOrdreByListeAndOrdre($liste_id,$type,$ordre){
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste_id],["type",$type],["ordre",$ordre]])
        ->first();
       }
       public function countByTypeAndListe($type,$liste)
       {
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste],["type",$type]])
        ->count();
       }
     
}
