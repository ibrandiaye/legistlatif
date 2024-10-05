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
       public function getAllByCniAndListe($cni,$liste){
        return DB::table("liste_nationals")
        ->where([['numcni',$cni],["liste_id",$liste]])
        ->get();
       }
       public function getByCniAndListeOuterOrdre($cni,$liste,$ordre,$type){
        return DB::table("liste_nationals")
        ->where([['numcni',$cni],["liste_id",$liste],["type",$type]])
        ->whereNot("ordre",$ordre)
        ->first();
       }
       public function getAllByCniAndListeOuterOrdre($cni,$liste,$ordre,$type){
        return DB::table("liste_nationals")
        ->where([['numcni',$cni],["liste_id",$liste],["type",$type]])
        ->whereNot("ordre",$ordre)
        ->get();
       }

       public function getByCniAndListeOuterType($cni,$liste,$type){
        return DB::table("liste_nationals")
        ->where([['numcni',$cni],["liste_id",$liste]])
        ->whereNot("type",$type)
        ->first();
       }
       public function getAllByCniAndListeOuterType($cni,$liste,$type){
        return DB::table("liste_nationals")
        ->where([['numcni',$cni],["liste_id",$liste]])
        ->whereNot("type",$type)
        ->get();
       }
       public function getByCniOuterListe($cni,$liste){
        return DB::table("liste_nationals")
        ->whereNot("liste_id",$liste)
        ->where('numcni',$cni)
        ->first();
       }
       public function getAllByCniOuterListe($cni,$liste){
        return DB::table("liste_nationals")
        ->whereNot("liste_id",$liste)
        ->where('numcni',$cni)
        ->get();
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
       public function getFirstOrdreByListe($liste_id,$type){
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste_id],["type",$type]])
        ->first();
       }
       public function getAllByListeAndType($liste_id,$type){
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste_id],["type",$type]])
        ->get();
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

       public function deleteByListe($id)
       {
            return ListeNational::where("liste_id",$id)->delete();
       }
       public function supprimerListe($liste,$type)
       {
        return DB::table("liste_nationals")
        ->where([["liste_id",$liste],["type",$type]])
        ->delete();
       }
       public function getDoublonExterne()
       {
        return DB::table("liste_nationals")
        ->join("listes","liste_nationals.liste_id","=","listes.id")
        ->select("liste_nationals.*","listes.nom as liste")
        ->where("liste_nationals.doublon_externe","!=","")
        ->get();
       }
     
}
