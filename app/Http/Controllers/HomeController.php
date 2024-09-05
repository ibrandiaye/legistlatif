<?php

namespace App\Http\Controllers;

use App\Repositories\DepartementRepository;
use App\Repositories\ListeDepartementalRepository;
use App\Repositories\ListeNationalRepository;
use App\Repositories\ListeRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class HomeController extends Controller
{
    protected $listeDepartementRepository;
    protected $listeNationalRepository;
    protected $departementRepository;
    protected $listeRepository;
    public function __construct(ListeDepartementalRepository $listeDepartementalRepository,
    ListeNationalRepository $listeNationalRepository,DepartementRepository $departementRepository,
    ListeRepository $listeRepository)
    {
        $this->listeDepartementRepository = $listeDepartementalRepository;
        $this->listeNationalRepository    = $listeNationalRepository;
        $this->departementRepository      = $departementRepository;
        $this->listeRepository            = $listeRepository;
    }

    public function home()
    {
        if(Auth::user()->role == 'candidats')
        {
            $nbTitulaireNational = $this->listeNationalRepository->countByTypeAndListe("titulaire", Auth::user()->liste_id);
            $nbSupleantNational = $this->listeNationalRepository->countByTypeAndListe("supleant", Auth::user()->liste_id);
            $nbTitulaireDepartemental = $this->listeDepartementRepository->countByTypeAndListe("titulaire", Auth::user()->liste_id);
            $nbSupleantDepartemental = $this->listeDepartementRepository->countByTypeAndListe("supleant", Auth::user()->liste_id);
         
        
         
            return view("home", compact("nbTitulaireNational", "nbSupleantNational", "nbTitulaireDepartemental", "nbSupleantDepartemental"));  
        }
        else if(Auth::user()->role == 'admin')
        {
            $listes = $this->listeRepository->getAll();
            return view("dashboard",compact("listes"));
        }
        
    }
    public function stateByScrutin($scrution)
    {
        if($scrution=="majoritaire")
        {
            $nbCandidatByListeGroupByDptAndTypes = $this->listeDepartementRepository->countByListeGroupByDepartementAndType(Auth::user()->liste_id);
            $departements = $this->departementRepository->getOrbyRegion();
            $tabCandidats = [];
        
            foreach ($departements as $departement) {
                $data = [
                    'titulaire' => 0,
                    'suppleant' => 0,
                    'departement' => $departement->nom,
                ];
        
                foreach ($nbCandidatByListeGroupByDptAndTypes as $value) {
                    if ($value->departement_id == $departement->id) {
                        if ($value->type == 'supleant') {
                            $data['suppleant'] = $value->nb;
                        } elseif ($value->type == 'titulaire') {
                            $data['titulaire'] = $value->nb;
                        }
                    }
                }
        
                $tabCandidats[] = $data;
            }
            $listeDepartementaleTitulaires      = $this->listeDepartementRepository->getByTypeAndListe("titulaire",Auth::user()->liste_id);
        $listeDepartementaleSupleants       = $this->listeDepartementRepository->getByTypeAndListe("supleant",Auth::user()->liste_id);
/* 
        $listeParDepartementFinal = [];
    
        foreach ($departements as $departement) {
            $titulaire = [];
            $supleant = [];
    
            foreach ($listeDepartementaleTitulaires as $listeDepartementale) {
                if (!empty($listeDepartementale->departement_id) && $departement->id == $listeDepartementale->departement_id) {
                    $titulaire[] = ["data" => $listeDepartementale];
                }
            }
            foreach ($listeDepartementaleSupleants as $listeDepartementale) {
                if (!empty($listeDepartementale->departement_id) && $departement->id == $listeDepartementale->departement_id) {
                    $supleant[] = ["data" => $listeDepartementale];
                }
            }
    
            if(!empty($titulaire) || !empty($supleant))
            {
                $listeParDepartementFinal[$departement->nom]["titulaire"] = $titulaire;
                $listeParDepartementFinal[$departement->nom]["supleant"] = $supleant;
                $listeParDepartementFinal[$departement->nom]["nombre"] = $departement->nb;
            }
         
        } */
   // "listeParDepartementFinal",
            return view("listedepartemental.liste", compact(   "tabCandidats","departements"));  

        }
        else if($scrution=="proportionnel")
        {
            $listenationalSuppleant             = $this->listeNationalRepository->getByListeAndType(Auth::user()->liste_id,'supleant');
            $listenationalTitulaire             = $this->listeNationalRepository->getByListeAndType(Auth::user()->liste_id,'titulaire');
            //dd($listenationalTitulaire);
            return view("listenational.liste", compact("listenationalSuppleant",  "listenationalTitulaire"));  

        }
        else
        {
            return redirect()->back();
        }
    }
    
    public function liste($type)
    {
        $departements                       = $this->departementRepository->getOrbyRegion();
        $listenationalSuppleant             = $this->listeNationalRepository->getByListeAndType(Auth::user()->liste_id,'supleant');
        $listenationalTitulaire             = $this->listeNationalRepository->getByListeAndType(Auth::user()->liste_id,'titulaire');
        $listeDepartementaleTitulaires      = $this->listeDepartementRepository->getByTypeAndListe("titulaire",Auth::user()->liste_id);
        $listeDepartementaleSupleants       = $this->listeDepartementRepository->getByTypeAndListe("supleant",Auth::user()->liste_id);

        $listeParDepartementFinal = [];
    
        foreach ($departements as $departement) {
            $titulaire = [];
            $supleant = [];
    
            foreach ($listeDepartementaleTitulaires as $listeDepartementale) {
                if (!empty($listeDepartementale->departement_id) && $departement->id == $listeDepartementale->departement_id) {
                    $titulaire[] = ["data" => $listeDepartementale];
                }
            }
            foreach ($listeDepartementaleSupleants as $listeDepartementale) {
                if (!empty($listeDepartementale->departement_id) && $departement->id == $listeDepartementale->departement_id) {
                    $supleant[] = ["data" => $listeDepartementale];
                }
            }
    
            if(!empty($titulaire) || !empty($supleant))
            {
                $listeParDepartementFinal[$departement->nom]["titulaire"] = $titulaire;
                $listeParDepartementFinal[$departement->nom]["supleant"] = $supleant;
                $listeParDepartementFinal[$departement->nom]["nombre"] = $departement->nb;
            }
         
        }
    
       //dd($listenationalSuppleant); // Pour déboguer et afficher le résultat final
        if($type==1)
        {
            return view("listecomplet",compact('listeParDepartementFinal','listenationalSuppleant','listenationalTitulaire','departements')); // Vous pouvez retourner le résultat final si besoin

        }
        else
        {
            return view("formulaire",compact('listeParDepartementFinal','listenationalSuppleant','listenationalTitulaire','departements')); // Vous pouvez retourner le résultat final si besoin

        }
    
    }

    public function listeAdmin($id)
    {
        
            $nbTitulaireNational = $this->listeNationalRepository->countByTypeAndListe("titulaire", $id);
            $nbSupleantNational = $this->listeNationalRepository->countByTypeAndListe("supleant", $id);
            $nbTitulaireDepartemental = $this->listeDepartementRepository->countByTypeAndListe("titulaire", $id);
            $nbSupleantDepartemental = $this->listeDepartementRepository->countByTypeAndListe("supleant", $id);
            $nbCandidatByListeGroupByDptAndTypes = $this->listeDepartementRepository->countByListeGroupByDepartementAndType($id);
            $departements = $this->departementRepository->getAll();
        
            $tabCandidats = [];
        
            foreach ($departements as $departement) {
                $data = [
                    'titulaire' => 0,
                    'suppleant' => 0,
                    'departement' => $departement->nom,
                ];
        
                foreach ($nbCandidatByListeGroupByDptAndTypes as $value) {
                    if ($value->departement_id == $departement->id) {
                        if ($value->type == 'supleant') {
                            $data['suppleant'] = $value->nb;
                        } elseif ($value->type == 'titulaire') {
                            $data['titulaire'] = $value->nb;
                        }
                    }
                }
        
                $tabCandidats[] = $data;
            }
            return view("home", compact("nbTitulaireNational", "nbSupleantNational", "nbTitulaireDepartemental", "nbSupleantDepartemental", "tabCandidats"));  
       
    }

   public function declarer($id,$type)
   {
        $departement =null;
    
       
        if($type == "majoritaire")
        {
            $candidat = $this->listeDepartementRepository->getById($id);
            $departement = $this->departementRepository->getById($candidat->departement_id);
        }
        else
        {
            $candidat = $this->listeNationalRepository->getById($id);
        }
        $liste = $this->listeRepository->getById(Auth::user()->liste_id);
        return view("declaration",compact("candidat","type","liste","departement"));
   }
    public function searchCandidat(Request $request)
    {
        $listeNationals = null;
        $listeDepartementals = null;
        $query1 = null;
        $query2 = null;
        ;
        if($request->cni || $request->numelec)
        {
            $query1 =  DB::table("liste_nationals")->join('listes','liste_nationals.liste_id','=','listes.id')
            ->select("liste_nationals.*","listes.nom as liste");
            $query2 =  DB::table("liste_departementals")
            ->join('listes','liste_departementals.liste_id','=','listes.id')
            ->join('departements','liste_departementals.departement_id','=','departements.id')
            ->select("liste_departementals.*","departements.nom as departement","listes.nom as liste");
        }
        if($request->cni)
        {
           $query1->where("liste_nationals.numcni",$request->cni);
           $query2->where("liste_departementals.numcni",$request->cni);
         
        }
        if($request->numelec)
        {
            $query1->where("liste_nationals.numelecteur",$request->numelec);
            $query2->where("liste_departementals.numelecteur",$request->numelec);
        }
        if($request->cni || $request->nin)
        {
            $listeNationals       = $query1->get();
            $listeDepartementals  = $query2->get();
        } 
        return view("search",compact("listeNationals","listeDepartementals")); 
    }

    public function formulaire(Request $request)
    {
        $scrutin = $request->scrutin;
        $type = $request->type;
        if($request->scrutin == "majoritaire" && isset($request->departement_id) && isset($request->type) )
        {
            
            $listes                = $this->listeDepartementRepository->getByListeAndType(Auth::user()->liste_id,$request->type,$request->departement_id);
            $departement           = $this->departementRepository->getById($request->departement_id);
          //  dd($listes);

        }
        else if($request->scrutin == "majoritaire" && isset($request->departement_id))
        {
            $listes                = $this->listeDepartementRepository->getByListe(Auth::user()->liste_id,$request->departement_id);
            $departement           = $this->departementRepository->getById($request->departement_id);
         //   dd($listes);
        }
        else if ($request->scrutin =="propotionnel" && isset($request->type) )
        {
            $listes                = $this->listeNationalRepository->getByListeAndType(Auth::user()->liste_id,$request->type);
           // dd($listes);
           $departement = null;
        }
        else
        {
            return redirect()->back()->with(['error'=>'Champs manquantes (scrutin,type et  departement si le scrutin est majoriatire )',]);
        }
      
       //dd($listenationalSuppleant); // Pour déboguer et afficher le résultat final
       
            return view("formulairetype",compact('listes','type','scrutin','departement')); // Vous pouvez retourner le résultat final si besoin

       
    
    }
    public function supprimerListe($scrutin,$type,$departement)
    {
       
        if($scrutin=="majoritaire")
        {
            $this->listeDepartementRepository->supprimerListe(Auth::user()->liste_id,$type,$departement);
            return redirect()->back()->with('error', 'Suppresion réussi.'); 
        }
        else if($scrutin=="proportionnel")
        {
           
            $this->listeNationalRepository->supprimerListe(Auth::user()->liste_id,$type);
            return redirect()->back()->with('error', 'Suppresion réussi.'); 
        }
        else
        {
            return redirect()->back();
        }
    }
    public function supprimerVoir()
    {
       $departements = $this->departementRepository->getOrbyRegion();
       return view("supprimer",compact("departements"));
    }
    public function recap()
    {
    
        $nbCandidatByListeGroupByDptAndTypes = $this->listeDepartementRepository->countByListeGroupByDepartementAndType(Auth::user()->liste_id);
        $departements = $this->departementRepository->getOrbyRegion();
        $tabCandidats = [];
        $suppleantd = 0;
        $titulaired = 0;
        foreach ($departements as $departement) {
            $data = [
                'titulaire' => 0,
                'suppleant' => 0,
                'departement' => $departement->nom,
            ];
    
            foreach ($nbCandidatByListeGroupByDptAndTypes as $value) {
                if ($value->departement_id == $departement->id) {
                    if ($value->type == 'supleant') {
                        $data['suppleant'] = $value->nb;
                        $suppleantd = $suppleantd + $value->nb;
                    } elseif ($value->type == 'titulaire') {
                        $data['titulaire'] = $value->nb;
                        $titulaired = $titulaired + $value->nb;
                    }
                }
            }
    
            $tabCandidats[] = $data;
        }
        $liste = Auth::user()->liste_id;
        $nbTitulaireNational = $this->listeNationalRepository->countByTypeAndListe("titulaire", $liste);
        $nbSupleantNational = $this->listeNationalRepository->countByTypeAndListe("supleant", $liste);
       
        return view("recap",compact("nbTitulaireNational","nbSupleantNational","suppleantd",
    "titulaired","tabCandidats"));
    }
    
}
