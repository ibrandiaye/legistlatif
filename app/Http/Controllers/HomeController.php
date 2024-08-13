<?php

namespace App\Http\Controllers;

use App\Repositories\DepartementRepository;
use App\Repositories\ListeDepartementalRepository;
use App\Repositories\ListeNationalRepository;
use App\Repositories\ListeRepository;
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
            return view("home", compact("nbTitulaireNational", "nbSupleantNational", "nbTitulaireDepartemental", "nbSupleantDepartemental", "tabCandidats"));  
        }
        else if(Auth::user()->role == 'admin')
        {
            $listes = $this->listeRepository->getAll();
            return view("dashboard",compact("listes"));
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
    
       // dd($listenationalSuppleant); // Pour déboguer et afficher le résultat final
        if($type==1)
        {
            return view("listecomplet",compact('listeParDepartementFinal','listenationalSuppleant','listenationalTitulaire')); // Vous pouvez retourner le résultat final si besoin

        }
        else
        {
            return view("formulaire",compact('listeParDepartementFinal','listenationalSuppleant','listenationalTitulaire')); // Vous pouvez retourner le résultat final si besoin

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

    
}
