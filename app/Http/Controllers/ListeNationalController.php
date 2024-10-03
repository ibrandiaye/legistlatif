<?php

namespace App\Http\Controllers;

use App\Models\ListeDepartemental;
use App\Models\ListeNational;
use App\Repositories\ListeDepartementalRepository;
use App\Repositories\ListeNationalRepository;
use App\Repositories\ListeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class ListeNationalController extends Controller
{
    protected $listenationalRepository;
    protected $listeRepository;
    protected $listedepartementalRepository;

    public function __construct(ListeNationalRepository $listenationalRepository,
    ListeRepository $listeRepository,ListeDepartementalRepository $listedepartementalRepository){
        $this->listenationalRepository          = $listenationalRepository;
        $this->listeRepository                  = $listeRepository;
        $this->listedepartementalRepository     = $listedepartementalRepository;
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
        $parite = "";
        $doublon_externe = "";
        $doublon_interne = "";
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
        ]);
        $inListe = "";
        $url = env("API_URL","http://158.220.124.25:7777/api/");
        $url  = $url."cartes/get/by/nin?nin=".$request->numcni;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        if(count($data)<1)
        {
            $inListe  = "Personne non identifier";
        }
    $request->merge(["sur_le_fichier"=>$inListe]);
        $candidat = $this->listenationalRepository->getById($id);
        $firstSave  = $this->listenationalRepository->getFirstOrdreByListe($request->liste_id,$request->type);

        if($request->type=="titulaire")
        {
            $request->merge(["nb"=>53]);
        }
        else
        {
            $request->merge(["nb"=>50]);
        }
            //dd($candidat->numcni,$request->numcni);
           /*  if($candidat->numcni!=$request->numcni || $candidat->sexe!=$request->sexe)
            { */
                //dd("eee");
                $erreur     = "";
                $erreurdge  = "";
                $age = $this->listenationalRepository->calculerAge($request->datenaiss);
                if($age < 25)
                {
                    $erreurdge = $erreurdge. 'age minimun non ateint. age : '.$age.' ans';
                    $erreur     = $erreur. 'age minimun non ateint. age : '.$age.' ans';;
                }
                $firstSave  = $this->listenationalRepository->getFirstOrdreByListe($request->liste_id,$request->type);
                if($candidat->ordre > 1)
                {
                    if ( $request->nb%2==0 || ($request->nb%2!=0 && $request->ordre+1 <= $request->nb))
                    {
                        $firstSave  = $this->listenationalRepository->getfirstordreByListe($request->liste_id,$request->type);

                        if($request->ordre%2==0 && $firstSave->sexe==$request->sexe )
                        {
                        // $erreur = $erreur. ' Parite non respecter';
                        //  $erreurdge = $erreurdge. 'Partite non respecter';
                            $parite  =  ' Parite non respecter ';


                        }
                        else if(($request->ordre%2!=0 && $firstSave->sexe!=$request->sexe ))
                        {
                            $parite  =  ' Parite non respecter ';
                        }

                    }
                }



                if($candidat->ordre == 1)
                {
                    $candidats = $this->listenationalRepository->getAllByListeAndType($candidat->liste_id,$candidat->type);

                    foreach ($candidats as $key => $value) {
                       $pariteAutre = "";

                        if($value->ordre > 1 )
                        {

                            if($request->nb%2==0 || ($request->nb%2!=0 && $value->ordre+1 <= $request->nb))
                            {
                               // dd($value);
                                if($request->sexe==$value->sexe && $value->ordre%2==0  )
                                {
                                  //  dd('pp');
                                    $pariteAutre  =  ' Parite non respecter ';
                                }
                                else if($request->sexe!=$value->sexe && $value->ordre%2!=0  )
                                {
                                    //dd('ll');
                                    $pariteAutre  =  ' Parite non respecter ';
                                }
                            }
                            ListeNational::where("id",$value->id)->update(["parite"=>$pariteAutre]);
                        }

                    }
                }


            $listeNational = $this->listenationalRepository->getByCniOuterListe($request->numcni,$candidat->liste_id);
            $listeDepartemental = $this->listedepartementalRepository->getByCniOuterListe($request->numcni,$candidat->liste_id);

            if(!empty($listeNational) || !empty($listeDepartemental))
            {
                //$erreur = $erreur. 'Doublon externe';
               // $erreurdge = $erreurdge. 'Doublon externe ';
               $doublon_externe =  ' Doublon externe ';
                //return redirect()->back()->with('error', 'Le candidat est déja inscrit dans une autre liste.');
                if($listeDepartemental)
                {
                    $liste = DB::table("listes")->where("id",$listeDepartemental->liste_id)->first();
                    $departement = DB::table("departements")->where("id",$listeDepartemental->departement_id)->first();
                    $doublon_externe = $doublon_externe. ' : Liste '.$listeDepartemental->type.' '.$liste->nom.' Departement :'.$departement->nom ;
                    ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_externe"=>" Doublon externe Liste ".$listeDepartemental->type.' '.$request->liste.' '.' Departement :'.$departement->nom ]);

                }
                if($listeNational)
                {
                    $liste = DB::table("listes")->where("id",$listeNational->liste_id)->first();
                    $doublon_externe = $doublon_externe. ' Liste '.$listeNational->type.' '.$liste->nom.' ';
                    ListeNational::where("id",$listeNational->id)->update(["doublon_externe"=>" Doublon externe Liste ".$listeNational->type.' '.$request->liste.' ']);

                }
            }
            else
                {
                    $listeDepartemental = $this->listedepartementalRepository->getAllByCniiOuterListe($candidat->numcni,$candidat->liste_id);
                    $listeNational = $this->listenationalRepository->getAllByCniOuterListe($candidat->numcni,$candidat->liste_id);
                    if(count($listeDepartemental)==1)
                    {
                        DB::table("liste_departementals")->where("id",$listeDepartemental[0]->id)->update(["doublon_externe"=>""]);
                    }
                    if(count($listeNational)==1)
                    {
                        DB::table("liste_departementals")->where("id",$listeNational[0]->id)->update(["doublon_externe"=>""]);
                    }
                }
           // if($candidat->ordre > 1)
                $mylisteNational = $this->listenationalRepository->getByCniAndListeOuterOrdre($request->numcni,$candidat->liste_id,$candidat->ordre,$request->type);
            $listeDepartemental = $this->listedepartementalRepository->getByCniAndListe($request->numcni,$candidat->liste_id);
            $getByCniAndListeOuterType = $this->listenationalRepository->getByCniAndListeOuterType($request->numcni,$candidat->liste_id,$request->type);


            if(!empty($mylisteNational) || !empty($listeDepartemental) || !empty($getByCniAndListeOuterType))
            {
               //$erreur = $erreur. ' Doublon interne';
               $erreurdge = $erreurdge. ' Doublon interne ';
               //return redirect()->back()->with('error', 'Candidat déja saisi.')->withInput();
               $doublon_interne = 'Doublon interne';
                //return redirect()->back()->with('error', 'Le candidat est déja inscrit dans une autre liste.');
                if(!empty($listeDepartemental))
                {
                 ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_interne"=> $doublon_interne]);
                }
                if(!empty($mylisteNational))
                {
                 ListeNational::where("id",$mylisteNational->id)->update(["doublon_interne"=> $doublon_interne]);
                }
                if(!empty($getByCniAndListeOuterType))
                {
                 ListeNational::where("id",$getByCniAndListeOuterType->id)->update(["doublon_interne"=> $doublon_interne]);
                }
            }
          //  else
          //  {
            if($candidat->numcni!=$request->numcni)
            {
               // dd("ok");
                $listeDepartemental = $this->listedepartementalRepository->getALLByCniAndListe($candidat->numcni,$request->liste_id);
                $mylisteNational = $this->listenationalRepository->getAllByCniAndListeOuterOrdre($candidat->numcni,$request->liste_id,$candidat->ordre,$request->type);
                $getByCniAndListeOuterType = $this->listenationalRepository->getAllByCniAndListeOuterType($candidat->numcni,$request->liste_id,$request->type);
              //  dd($listeDepartemental,$mylisteNational,$getByCniAndListeOuterType);
                if(count( $listeDepartemental)+count( $mylisteNational)+count( $getByCniAndListeOuterType)==1)
                {
                    if(count($listeDepartemental)==1)
                    {
                        DB::table("liste_departementals")->where("id",$listeDepartemental[0]->id)->update(["doublon_interne"=>""]);
                    }
                    if(count($mylisteNational)==1)
                    {
                        DB::table("liste_nationals")->where("id",$mylisteNational[0]->id)->update(["doublon_interne"=>""]);
                    }
                    if(count($getByCniAndListeOuterType)==1)
                    {
                        DB::table("liste_nationals")->where("id",$getByCniAndListeOuterType[0]->id)->update(["doublon_interne"=>""]);
                    }
                }

            }


          //  }
          // dd("ok");
           // $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
           // dd($erreur);
           $request->merge(["erreur"=>$erreur,"doublon_interne"=>$doublon_interne,"doublon_externe"=>$doublon_externe,"parite"=>$parite]);
           //dd("ddd");
            $this->listenationalRepository->update($id, $request->all());
            //return redirect('listenational');
            //return redirect('tab/1')->with('success', 'Candidat modifier avec succès.');
            if(Auth::user()->role=='candidats')
            {
                return redirect('tab/1')->with('success', 'Candidat modifier avec succès.');
            }
            else if(Auth::user()->role=='admin')
            {
                return redirect('listedepartemental')->with('success', 'Candidat modifier avec succès.');

            }
            else if(Auth::user()->role=='controlleur')
            {
                return redirect("/controle/".$request->liste_id."/2")->with('success', 'Candidat modifier avec succès.');

            }
      /*   }
        else
        {
            $this->listenationalRepository->update($id, $request->all());
            return redirect('tab/1')->with('success', 'Candidat modifier avec succees.');  ;
        }
 */
       /*  */
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
    public function rejeter(Request $request)
    {
        ListeNational::where("id",$request->id)->update(["etat"=>0,"commentaire"=>$request->commentaire,'verif'=>1]);
        return redirect()->back();
    }
    public function valider(Request $request)
    {
        ListeNational::where("id",$request->id)->update(["etat"=>1,'verif'=>1,"commentaire"=>""]);
        return redirect()->back();
    }

}
