<?php

namespace App\Http\Controllers;

use App\Models\ListeNational;
use App\Repositories\ListeNationalRepository;
use App\Repositories\ListeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\SimpleExcel\SimpleExcelReader;

class ListeNationalController extends Controller
{
    protected $listenationalRepository;
    protected $listeRepository;

    public function __construct(ListeNationalRepository $listenationalRepository,
    ListeRepository $listeRepository){
        $this->listenationalRepository = $listenationalRepository;
        $this->listeRepository         = $listeRepository;
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
            $listenationals = $this->listenationalRepository->getAll();
            $listes       = $this->listeRepository->getAll();
        }
        else
        {
            $listenationals = $this->listenationalRepository->getByListe(Auth::user()->liste_id);
            $listes       = [];
        }       

        return view('listenational.index',compact('listenationals','listes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listes       = $this->listeRepository->getAll();
        return view('listenational.add',compact("listes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $listenationals = $this->listenationalRepository->store($request->all());
        return redirect('listenational');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listenational = $this->listenationalRepository->getById($id);
        $liste = $this->listeRepository->getById($listenational->liste_id);
        return view('listenational.show',compact('listenational','liste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listenational      = $this->listenationalRepository->getById($id);
        $listes             = $this->listeRepository->getAll();
        return view('listenational.edit',compact('listenational',"listes"));
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
            $extrait_ou_cni = 'extrait_ou_cnis'.$request->prenom.'_'.$request->nom.'_'.$request->datenaiss.'_'.uniqid() .time().'.'.$request->extrait_ou_cnis->extension();
            $request->extrait_ou_cnis->move('extrait_ou_cnis/', $extrait_ou_cni);
            $request->merge(['extrait_ou_cni'=>$extrait_ou_cni]);
    
        }
        if($request->casiers){
            $casier =  'casier_judiciare'.$request->prenom.'_'.$request->nom.'_'.$request->datenaiss.'_'.uniqid() .time().'.'.$request->casiers->extension();
            $request->casiers->move('casier_judiciare/', $casier);
            $request->merge(['casier'=>$extrait_ou_cni]);
        }
        $this->listenationalRepository->update($id, $request->all());
        return redirect('listenational');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->listenationalRepository->destroy($id);
        return redirect('listenational');
    }
    public function changerEtat($id)
    {
        $this->listenationalRepository->changerEtat($id,1);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $listes       = $this->listeRepository->getAll();
        if(Auth::user()->role=='admin')
        {
            if($request->liste_id && $request->type){
                $listenationals = $this->listenationalRepository->getByListeAndType($request->liste_id ,$request->type);
              }
              else if($request->liste_id){
                  $listenationals = $this->listenationalRepository->getByListe($request->liste_id);
      
              }
              else if($request->type){
                  $listenationals = $this->listenationalRepository->getByType($request->type);
      
              }
        }
        else
        {
            if($request->type){
                $listenationals = $this->listenationalRepository->getByListeAndType(Auth::user()->liste_id ,$request->type);
              }
        }
       
        return view('listenational.index',compact('listenationals','listes'));

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
                ListeNational::create([
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
                ]);

        }

            // 5. On supprime le fichier uploadé
            $reader->close(); // On ferme le $reader
           // unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return redirect()->back()->with('success', 'Données importées avec succès.');

    }

}
