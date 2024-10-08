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
use PDF;
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
    function calculerAge($dateNaissance) {
        $dateNaissance = new \DateTime($dateNaissance);
        $aujourdhui = new \DateTime();
        $age = $aujourdhui->diff($dateNaissance);
        return $age->y; // Retourne l'âge en années
    }

    public function home()
    {
        if(Auth::user()->role == 'candidats')
        {
            $nbTitulaireNational = $this->listeNationalRepository->countByTypeAndListe("titulaire", Auth::user()->liste_id);
            $nbSupleantNational = $this->listeNationalRepository->countByTypeAndListe("supleant", Auth::user()->liste_id);
            $nbTitulaireDepartemental = $this->listeDepartementRepository->countByTypeAndListe("titulaire", Auth::user()->liste_id);
            $nbSupleantDepartemental = $this->listeDepartementRepository->countByTypeAndListe("supleant", Auth::user()->liste_id);
         $liste  = Auth::user()->liste_id;


            return view("home", compact("nbTitulaireNational", "nbSupleantNational", "nbTitulaireDepartemental", "nbSupleantDepartemental","liste"));
        }
        else if(Auth::user()->role == 'admin')
        {
            $entre18_35 = 0;
            $entre35_45 = 0;
            $entre45_plus = 0;
            $listes = $this->listeRepository->getAll();
            $nbHommeNational = $this->listeNationalRepository->countBySexe("M");
            $nbFemmeNational = $this->listeNationalRepository->countBySexe("F");
            $nbHommeDepartement = $this->listeDepartementRepository->countBySexe("M");
            $nbFemmeDepartement = $this->listeDepartementRepository->countBySexe("F");
            $listeNationals = $this->listeNationalRepository->getAll();
            $listeDeprtements = $this->listeDepartementRepository->getAll();
            foreach ($listeNationals as $key => $value) {
                $age = $this->calculerAge($value->datenaiss);
                if($age > 17 && $age <36)
                {
                    $entre18_35 =  $entre18_35 + 1;
                }
                elseif($age > 35 && $age <46)
                {
                    $entre35_45 =  $entre35_45 + 1;
                }
                else
                {
                    $entre45_plus =  $entre45_plus + 1;

                }
            }

            foreach ($listeDeprtements as $key => $value) {
                $age = $this->calculerAge($value->datenaiss);
                if($age > 17 && $age <36)
                {
                    $entre18_35 =  $entre18_35 + 1;
                }
                elseif($age > 35 && $age <46)
                {
                    $entre35_45 =  $entre35_45 + 1;
                }
                else
                {
                    $entre45_plus =  $entre45_plus + 1;

                }
            }
           // dd($entre18_35,$entre35_45,$entre45_plus);
            return view("dashboard",compact("listes","nbHommeNational","nbFemmeNational","nbHommeDepartement","nbFemmeDepartement",
           "entre18_35","entre35_45","entre45_plus"));
        }
        else if(Auth::user()->role == 'controlleur')
        {
            $listes = $this->listeRepository->getAll();
            return view("liste.index",compact("listes"));
        }

    }
    public function stateByScrutin($scrution,$liste)
    {

        if($scrution=="majoritaire")
        {
            $nbCandidatByListeGroupByDptAndTypes = $this->listeDepartementRepository->countByListeGroupByDepartementAndType($liste);
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
            $listeDepartementaleTitulaires      = $this->listeDepartementRepository->getByTypeAndListe("titulaire",$liste);
        $listeDepartementaleSupleants       = $this->listeDepartementRepository->getByTypeAndListe("supleant",$liste);
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
            return view("listedepartemental.liste", compact(   "tabCandidats","departements","liste"));

        }
        else if($scrution=="proportionnel")
        {
            $listenationalSuppleant             = $this->listeNationalRepository->getByListeAndType($liste,'supleant');
            $listenationalTitulaire             = $this->listeNationalRepository->getByListeAndType($liste,'titulaire');
           // dd($listenationalTitulaire);
            return view("listenational.liste", compact("listenationalSuppleant",  "listenationalTitulaire","liste"));

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
            $liste = $id;
            $nbTitulaireNational = $this->listeNationalRepository->countByTypeAndListe("titulaire", $id);
            $nbSupleantNational = $this->listeNationalRepository->countByTypeAndListe("supleant", $id);
            $nbTitulaireDepartemental = $this->listeDepartementRepository->countByTypeAndListe("titulaire", $id);
            $nbSupleantDepartemental = $this->listeDepartementRepository->countByTypeAndListe("supleant", $id);
            $nbCandidatByListeGroupByDptAndTypes = $this->listeDepartementRepository->countByListeGroupByDepartementAndType($id);
            $departements = $this->departementRepository->getOrbyRegion();

            $tabCandidats = [];

            foreach ($departements as $departement) {
                $data = [
                    'titulaire' => 0,
                    'suppleant' => 0,
                    'departement' => $departement->nom,
                    'liste' => $id,
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
            return view("home", compact("nbTitulaireNational", "nbSupleantNational", "nbTitulaireDepartemental", "nbSupleantDepartemental", "tabCandidats","liste"));

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
        $listeNationals = [];
        $listeDepartementals = [];
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
        if($request->cni || $request->numelec)
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

            $liste = Auth::user()->liste_id;

        if($request->scrutin == "majoritaire" && isset($request->departement_id) && isset($request->type) )
        {

            $listes                = $this->listeDepartementRepository->getByListeAndType($liste,$request->type,$request->departement_id);
            $departement           = $this->departementRepository->getById($request->departement_id);
          //  dd($listes);

        }
        else if($request->scrutin == "majoritaire" && isset($request->departement_id))
        {
            $listes                = $this->listeDepartementRepository->getByListe($liste,$request->departement_id);
            $departement           = $this->departementRepository->getById($request->departement_id);
         //   dd($listes);
        }
        else if ($request->scrutin =="propotionnel" && isset($request->type) )
        {
            $listes                = $this->listeNationalRepository->getByListeAndType($liste,$request->type);
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
                'lieu'  =>$departement->is_diaspora
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
      // dd($tabCandidats);
        return view("recap",compact("nbTitulaireNational","nbSupleantNational","suppleantd",
    "titulaired","tabCandidats"));
    }
    public function genererFormulaire($liste)
    {
        $departements                       = $this->departementRepository->getOrbyRegion();
        $listenationalSuppleant             = $this->listeNationalRepository->getByListeAndType($liste,'supleant');
        $listenationalTitulaire             = $this->listeNationalRepository->getByListeAndType($liste,'titulaire');
        $listeDepartementaleTitulaires      = $this->listeDepartementRepository->getByTypeAndListe("titulaire",$liste);
        $listeDepartementaleSupleants       = $this->listeDepartementRepository->getByTypeAndListe("supleant",$liste);
        $liste                              = DB::table("listes")->where("id",$liste)->first();
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
       $pdf = PDF::loadView("formulaire-admin", compact('listeParDepartementFinal','listenationalSuppleant','listenationalTitulaire','departements','liste'));
       // return view("formulaire-admin",compact('listeParDepartementFinal','listenationalSuppleant','listenationalTitulaire','departements','liste')); // Vous pouvez retourner le résultat final si besoin
       return $pdf->download(\Str::slug($liste->nom).".pdf");

    }
    public function listeControle($id,$type)
    {
        $departements                       = $this->departementRepository->getOrbyRegion();
        $listenationalSuppleant             = $this->listeNationalRepository->getByListeAndType($id,'supleant');
        $listenationalTitulaire             = $this->listeNationalRepository->getByListeAndType($id,'titulaire');
        $listeDepartementaleTitulaires      = $this->listeDepartementRepository->getByTypeAndListe("titulaire",$id);
        $listeDepartementaleSupleants       = $this->listeDepartementRepository->getByTypeAndListe("supleant",$id);

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
       $liste = $this->listeRepository->getById($id);
        if($type==1)
            return view("controle",compact('listeParDepartementFinal','id','listenationalSuppleant','listenationalTitulaire','departements','liste')); // Vous pouvez retourner le résultat final si besoin
        elseif($type==2)
            return view("controle-all",compact('listeParDepartementFinal','id','listenationalSuppleant','listenationalTitulaire','departements','liste')); // Vous pouvez retourner le résultat final si besoin
        elseif($type==3)
            return view("controle-rejeter",compact('listeParDepartementFinal','id','listenationalSuppleant','listenationalTitulaire','departements','liste')); // Vous pouvez retourner le résultat final si besoin

    }

    public function controleFichier($id,$type)
    {
        $departements                       = $this->departementRepository->getOrbyRegion();
        $listenationalSuppleant             = $this->listeNationalRepository->getByListeAndType($id,'supleant');
        $listenationalTitulaire             = $this->listeNationalRepository->getByListeAndType($id,'titulaire');
        $listeDepartementaleTitulaires      = $this->listeDepartementRepository->getByTypeAndListe("titulaire",$id);
        $listeDepartementaleSupleants       = $this->listeDepartementRepository->getByTypeAndListe("supleant",$id);

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
            $liste = $this->listeRepository->getById($id);

        }
        if($type==1)
            return view("controle-fichier", compact('listeParDepartementFinal','id','listenationalSuppleant','listenationalTitulaire','departements','liste')); // Vous pouvez retourner le résultat final si besoin
        if($type==2)
            return view("controle-rejet",  compact('listeParDepartementFinal','id','listenationalSuppleant','listenationalTitulaire','departements','liste')); // Vous pouvez retourner le résultat final si besoin



    }
    public function getDoublonExterne($id,$erreur)
    {
        if($erreur=="doublon_externe")
        {
            $listeDepartements = $this->listeDepartementRepository->getDoublonExterne();
            $listeNationals = $this->listeNationalRepository->getDoublonExterne();
        }
        elseif($erreur=="doublon_interne")
        {
            $listeDepartements = $this->listeDepartementRepository->getDoublonInterne();
            $listeNationals = $this->listeNationalRepository->getDoublonInterne();
        }
        elseif($erreur=="parite")
        {
            $listeDepartements = $this->listeDepartementRepository->getParite();
            $listeNationals = $this->listeNationalRepository->getParite();
        }
        elseif($erreur=="sur_le_fichier")
        {
            $listeDepartements = $this->listeDepartementRepository->getSurLeFichier();
            $listeNationals = $this->listeNationalRepository->getSurLeFichier();
        }
       // dd($listeNationals);
       if($id==1)
            return view("doublon-externe",compact("listeDepartements","listeNationals","erreur"));
        else
        {
            $pdf = PDF::loadView("doublon-externe-fichier", compact("listeDepartements","listeNationals"));
            return $pdf->download("doubon-externe.pdf");
        }
    }
    public function verifNbDepute($id)
    {
        $listeNationals = $this->listeNationalRepository->countByListeGroupByType($id);
        $listeDepartementals = $this->listeDepartementRepository->countGroupByTypeAndListeByDepartement($id);
        $liste = $this->listeRepository->getById($id);
        return view("verif",compact("listeNationals","listeDepartementals","liste"));
       // dd($listeDepartementals,$listeNationals);
    }
}
