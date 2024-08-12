<?php

namespace App\Http\Controllers;

use App\Models\ListeDepartemental;
use App\Models\ListeNational;
use App\Repositories\DepartementRepository;
use App\Repositories\ListeDepartementalRepository;
use App\Repositories\ListeNationalRepository;
use App\Repositories\ListeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\SimpleExcel\SimpleExcelReader;

class ListeDepartementalController extends Controller
{
    protected $listedepartementalRepository;
    protected $departementRepository;
    protected $listeNationalRepository;

    protected $listeRepository;

    public function __construct(ListeDepartementalRepository $listedepartementalRepository,
    DepartementRepository $departementRepository,ListeRepository $listeRepository,
    ListeNationalRepository $listeNationalRepository){
        $this->listedepartementalRepository   = $listedepartementalRepository;
        $this->departementRepository          = $departementRepository;
        $this->listeRepository                = $listeRepository;
        $this->listeNationalRepository       = $listeNationalRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
        if(Auth::user()->role=='admin')
        {
            $listedepartementals = $this->listedepartementalRepository->getAll();
            $departements = $this->departementRepository->getAll();
            $listenationals = $this->listeNationalRepository->getAll();
            $listes       = $this->listeRepository->getAll();

        }
        else
        {
            $listedepartementals   = $this->listedepartementalRepository->getByOneListe(Auth::user()->liste_id);
            $listes                = [];
            $departements          = $this->departementRepository->getAll();
            $listenationals = $this->listeNationalRepository->getByListe(Auth::user()->liste_id);
        }
        return view('listedepartemental.index',compact('listedepartementals',"listes","departements","listenationals"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = $this->departementRepository->getAll();
        $listes       = $this->listeRepository->getAll();
        return view('listedepartemental.add',compact("departements","listes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $erreur = "";
        $erreurdge = "";
        if($request->extrait_ou_cnis){
            $extrait_ou_cni = 'extrait_ou_cnis'.$request->prenom.'_'.$request->nom.'_'.$request->datenaiss.'_'.uniqid() .time().'.'.$request->extrait_ou_cnis->extension();
            $request->extrait_ou_cnis->move('extrait_ou_cnis/', $extrait_ou_cni);
            $request->merge(['extrait_ou_cni'=>$extrait_ou_cni]);
        }
        if($request->casiers){
            $casier =  'casier_judiciare'.$request->prenom.'_'.$request->nom.'_'.$request->datenaiss.'_'.uniqid() .time().'.'.$request->casiers->extension();
            $request->casiers->move('casier_judiciare/', $casier);
            $request->merge(['casier'=>$extrait_ou_cni]);
        }
      
        $age = $this->listedepartementalRepository->calculerAge($request->datenaiss);
            //dd($age);
            if($age < 25)
            {
                $erreurdge = $erreurdge. 'age minimun non ateint. age : '.$age.' ans';
            }
    
        if($request->scrutin=="majoritaire")
        {
            $this->validate($request, [
                'nom'               => 'string|required',
                'prenom'            =>'string|required',
                'numelecteur'       => 'integer|required',
                'sexe'              => 'string|required',
                'profession'        => 'string|required',
                'datenaiss'         => 'date|required',
                'lieunaiss'         => 'string|required',
                'type'              => 'string|required',
                'numcni'            => 'string|required',
                'departement_id'    => 'string|required',
                'ordre'             => 'integer|required',
            ]);
            $lastSave  = $this->listedepartementalRepository->getLastOrdreByListe(Auth::user()->liste_id,$request->type,$request->departement_id);
            if(!empty($lastSave) && $lastSave->sexe==$request->sexe)
            {
                $erreur = $erreur. ' Partite non respecter';
                $erreurdge = $erreurdge. 'Partite non respecter';
            }
            $listeDepartemental = $this->listedepartementalRepository->getByCni($request->numcni);
            if(!empty($listeDepartemental))
            {
                $erreurdge = $erreurdge. ' Doublon externe ou interne';
            }
            $listeDepartemental = $this->listedepartementalRepository->getByCniAndListe($request->numcni,Auth::user()->liste_id);
            {
                $erreur = $erreur. ' Doublon interne';
                $erreurdge = $erreurdge. ' Doublon interne ';
            }
            $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
            $ordre = $this->listedepartementalRepository->getByOrdreAndListe($request->ordre,Auth::user()->liste_id,$request->departement_id,$request->type);
            if(!empty($ordre))
            {
                return redirect()->back()->with('error', 'Numéro ordre déja utilisé.');  
            }
                $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
                $listedepartementals = $this->listedepartementalRepository->store($request->all());
                return redirect()->back()->with('success', 'Candidat enregistré avec.');  
            
           

        }
        else if($request->scrutin=="propotionnel")
        {
            $this->validate($request, [
                'nom'               => 'string|required',
                'prenom'            =>'string|required',
                'numelecteur'       => 'string|required',
                'sexe'              => 'string|required',
                'profession'        => 'string|required',
                'datenaiss'         => 'date|required',
                'lieunaiss'         => 'string|required',
                'type'              => 'string|required',
                'numcni'            => 'string|required',
                'ordre'             => 'integer|required',
            ]);
            $listeNational = $this->listeNationalRepository->getByCni($request->numcni);
           
            if(!empty($listeNational))
            {
                //$erreur = $erreur. 'Doublon externe';
                $erreurdge = $erreurdge. 'Doublon externe ou interne';
                //return redirect()->back()->with('error', 'Le candidat est déja inscrit dans une autre liste.');  
            }
            $mylisteNational = $this->listeNationalRepository->getByCniAndListe($request->numcni,Auth::user()->liste_id);
            if(!empty($mylisteNational))
            {
                $erreur = $erreur. 'Doublon interne';
                $erreurdge = $erreurdge. 'Doublon interne ';
                //return redirect()->back()->with('error', 'Le candidat est déja inscrit dans une autre liste.');  
            }
            $ordre = $this->listeNationalRepository->getByOrdreAndListe($request->ordre,Auth::user()->liste_id,$request->type);
            if(!empty($ordre))
            {
                return redirect()->back()->with('error', 'Numéro ordre déja utilisé.');  
            }
            $lastSave  = $this->listeNationalRepository->getLastOrdreByListe(Auth::user()->liste_id,$request->type);
            if(!empty($lastSave) && $lastSave->sexe==$request->sexe)
            {
                $erreur = $erreur. 'Partite non respecter';
                $erreurdge = $erreurdge. 'Partite non respecter';
               // return redirect()->back()->with('error', 'Vous n\'avez pas respecte la parité.');  
            }
            
                $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
                $listenationals = $this->listeNationalRepository->store($request->all());
                //return redirect('listenational');
                return redirect()->back()->with('success', 'Candidat enregistré avec.');  
           


        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listedepartemental = $this->listedepartementalRepository->getById($id);
        $liste  = $this->listeRepository->getById($listedepartemental->liste_id);
        $departement = $this->departementRepository->getById($listedepartemental->departement_id);
        return view('listedepartemental.show',compact('listedepartemental','liste','departement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listedepartemental   = $this->listedepartementalRepository->getById($id);
        $departements         = $this->departementRepository->getAll();
        $listes               = $this->listeRepository->getAll();
        return view('listedepartemental.edit',compact('listedepartemental','departements',"listes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->extrait_ou_cnis){
            $extrait_ou_cni = uniqid() .'.'.$request->extrait_ou_cnis->extension();
            $request->extrait_ou_cnis->move('document/', $extrait_ou_cni);
            $request->merge(['extrait_ou_cni'=>$extrait_ou_cni]);
        }
        if($request->casiers){
            $casier = uniqid() .'.'.$request->casiers->extension();
            $request->casiers->move('document/', $casier);
            $request->merge(['casier'=>$extrait_ou_cni]);
        }
        $this->listedepartementalRepository->update($id, $request->all());
        return redirect('listedepartemental');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->listedepartementalRepository->destroy($id);
        return redirect('listedepartemental');
    }

    public function search(Request $request)
    {
        $listes       = $this->listeRepository->getAll();
        $liste        = null;
        $departements = $this->departementRepository->getAll();
        $departement        = null;

        $type = null;
        if(Auth::user()->role=='admin')
        {
            if($request->liste_id && $request->type && $request->departement_id ){
            $listedepartementals = $this->listedepartementalRepository->getByListeAndType($request->liste_id ,$request->type,$request->departement_id);
            }
            else if($request->liste_id && $request->departement_id){
                $listedepartementals = $this->listedepartementalRepository->getByListe($request->liste_id,$request->departement_id);

            }
            else if($request->type && $request->departement_id){
                $listedepartementals = $this->listedepartementalRepository->getByType($request->type,$request->departement_id);

            }
            foreach ($listes as $key => $value) {
                if($value->id == $request->liste_id)
                {
                    $liste = $value;
                }
            }
            foreach ($departements as $key => $value) {
                if($value->id == $request->departement_id)
                {
                    $departement = $value;
                }
            }
            $type =  $request->type;
        }
        else
        {
            if( $request->type && $request->departement_id ){
                $listedepartementals = $this->listedepartementalRepository->getByListeAndType(Auth::user()->liste_id ,$request->type,$request->departement_id);
                }
                else if( $request->departement_id){
                    $listedepartementals = $this->listedepartementalRepository->getByListe(Auth::user()->liste_id,$request->departement_id);
    
                }
                else if($request->type && $request->departement_id){
                    $listedepartementals = $this->listedepartementalRepository->getByTypeAndListe($request->type,Auth::user()->liste_id);
    
                }
                foreach ($listes as $key => $value) {
                    if($value->id == Auth::user()->liste_id)
                    {
                        $liste = $value;
                    }
                }
                foreach ($departements as $key => $value) {
                    if($value->id == $request->departement_id)
                    {
                        $departement = $value;
                    }
                }
                $type =  $request->type;
        }    
        return view('listedepartemental.index',compact('listedepartementals','listes','departements','liste','type',
    'departement'));

    }
    public function importExcel(Request $request)
    {
         
        $this->validate($request, [
            'file' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $fichier = $request->file->move(public_path(), $request->file->hashName());

        // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
        $reader = SimpleExcelReader::create($fichier);

        // On récupère le contenu (les lignes) du fichier
        $rows = $reader->getRows();

        // $rows est une Illuminate\Support\LazyCollection

        // 4. On insère toutes les lignes dans la base de données
      //  $rows->toArray());
     // 'nom','prenom','numelecteur','sexe','profession','datenaiss','lieunaiss','liste_id','type','numcni','departement_id'

      foreach ($rows as $key => $listenational) {
                ListeDepartemental::create([
                    "ordre"=>$listenational['ORDRE'],
                    "nom"=>$listenational['NOM'],
                    "prenom"=>$listenational["PRENOM"],
                    "numelecteur"=>$listenational["NUMERO_ELECTEUR"],
                    "sexe"=>$listenational["SEXE"],
                    "Profession"=>$listenational["PROFESSION"],    
                    "datenaiss"=>$listenational["DATE_NAISSANCE"],
                    "lieunaiss"=>$listenational["LIEU_NAISSANCE"],
                    "type"=>$request->type,
                    "liste_id"=>$request->liste_id,
                    "departement_id"=>$request->departement_id,
                ]);

        }

            // 5. On supprime le fichier uploadé
            $reader->close(); // On ferme le $reader
           // unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return redirect()->back()->with('success', 'Données importées avec succès.');

    }

    public function changerEtat($id)
    {
        $this->listedepartementalRepository->changerEtat($id,1);
        return redirect()->back();
    }

}
