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
use Illuminate\Support\Facades\DB;
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
            $departements = $this->departementRepository->getOrbyRegion();
            $listenationals = $this->listeNationalRepository->getAll();
            $listes       = $this->listeRepository->getAll();

        }
        else
        {
            $listedepartementals   = $this->listedepartementalRepository->getByOneListe(Auth::user()->liste_id);
            $listes                = [];
            $departements          = $this->departementRepository->getAll();
            $listenationals        = $this->listeNationalRepository->getByListe(Auth::user()->liste_id);
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
        $candidats = array();
        $departements = $this->departementRepository->getOrbyRegion();
        $listes       = $this->listeRepository->getAll();
        return view('listedepartemental.add',compact("departements","listes","candidats"));
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
        $parite = "";
        $doublon_externe = "";
        $doublon_interne = "";
        $user = Auth::user();
        if($user->role=="candidats")
        {
            $request->merge(["liste_id"=>$user->liste_id]);
        }
        if($request->extrait_ou_cnis){
            $extrait_ou_cni = 'extrait_ou_cnis'.$request->prenom.'_'.$request->nom.'_'.$request->datenaiss.'_'.uniqid() .time().'.'.$request->extrait_ou_cnis->extension();
            $request->extrait_ou_cnis->move('extrait_ou_cnis/', $extrait_ou_cni);
            $request->merge(['extrait_ou_cni'=>$extrait_ou_cni]);
        }
        if($request->casiers){
            $casier =  'casier_judiciare'.$request->prenom.'_'.$request->nom.'_'.$request->datenaiss.'_'.uniqid() .time().'.'.$request->casiers->extension();
            $request->casiers->move('casier_judiciare/', $casier);
            $request->merge(['casier'=>$casier]);
        }
      
        $age = $this->listedepartementalRepository->calculerAge($request->datenaiss);
            //dd($age);
            if($age < 25)
            {
                $erreurdge = $erreurdge. 'age minimun non ateint. age : '.$age.' ans';
                $erreur = $erreur. 'age minimun non ateint. age : '.$age.' ans';

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
                'nb'                => 'integer|required',
            ]);
            $lastSave  = $this->listedepartementalRepository->getLastOrdreByListe($request->liste_id,$request->type,$request->departement_id);
            if(empty($lastSave))
            {
                $request->merge(["ordre"=>1]);
            }
            else
            {
                $request->merge(["ordre"=>$lastSave->ordre+1]);

            }
            if( !empty($lastSave) && $request->nb<$lastSave->ordre +1)
            {
                return redirect()->back()->with('error', 'Nombre de candidat autorisé dépassé.');  
            }
            if($request->nb == 1)
            {
                if($request->type == "titulaire")
                {
                    $lastSaveForOne  = $this->listedepartementalRepository->getLastOrdreByListe($request->liste_id,"supleant",$request->departement_id);
                    if(!empty($lastSaveForOne) && $request->sexe==$lastSaveForOne->sexe)
                    {
                      //  $erreur = $erreur. ' Parite non respecter ';
                       // $erreurdge = $erreurdge. 'Partite non respecter ';
                        $parite  =  ' Parite non respecter ';
                    }
                }
                else
                {
                    $lastSaveForOne  = $this->listedepartementalRepository->getLastOrdreByListe($request->liste_id,"titulaire",$request->departement_id);
                    if(!empty($lastSaveForOne) && $request->sexe==$lastSaveForOne->sexe)
                    {
                       // $erreur = $erreur. ' Parite non respecter' ;
                       // $erreurdge = $erreurdge. 'Partite non respecter ';
                        $parite  =  ' Parite non respecter ';
                    }
                }
            }
           else if ($request->nb%2==0 || ($request->nb%2!=0 && $request->ordre+1 < $request->nb))
           {
                $firstSave  = $this->listedepartementalRepository->getfirstordreByListe($request->liste_id,$request->type,$request->departement_id);
                if(!empty($firstSave))
                {
                    if($request->nb%2==0)
                    {
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
           }
           
           
            $listeDepartemental = $this->listedepartementalRepository->getByCniOuterListe($request->numcni,$user->liste_id);
            $listeNational = $this->listeNationalRepository->getByCniOuterListe($request->numcni,$user->liste_id);
            if(!empty($listeDepartemental) ||  $listeNational)
            {
                $doublon_externe =  ' Doublon externe ';
                if($listeDepartemental)
                {
                    $liste = DB::table("listes")->where("id",$listeDepartemental->liste_id)->first();
                    $departement = DB::table("departements")->where("id",$listeDepartemental->departement_id)->first();
                    $doublon_externe = $doublon_externe. ' : Liste '.$listeDepartemental->type.' '.$liste->nom.' Departement :'.$departement->nom ;
                    ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_externe"=>" Doublon externe Liste".$listeDepartemental->type.' '.$request->liste.' '.' Departement :'.$departement->nom ]);

                }
                if($listeNational)
                {
                    $liste = DB::table("listes")->where("id",$listeNational->liste_id)->first();
                    $doublon_externe = $doublon_externe. ' Liste '.$listeNational->type.' '.$liste->nom.' ';
                    ListeNational::where("id",$listeNational->id)->update(["doublon_externe"=>" Doublon externe Liste".$listeNational->type.' '.$request->liste.' ']);

                }
            }
           // $listeDepartemental = $this->listedepartementalRepository->getByCniAndListeAndDepartement($request->numcni,$request->liste_id,$request->departement_id);
            $mylisteNational = $this->listeNationalRepository->getByCniAndListe($request->numcni,$request->liste_id);
            $listeDepartemental = $this->listedepartementalRepository->getByCniAndListe($request->numcni,$request->liste_id);

            if(!empty($listeDepartemental) || !empty($mylisteNational))
            {
               // $erreur = $erreur. ' Doublon interne';
               // $erreurdge = $erreurdge. ' Doublon interne ';
               $doublon_interne = 'Doublon interne';
               if($listeDepartemental)
               {
                ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_interne"=> $doublon_interne]);
               }
               if($mylisteNational)
               {
                ListeNational::where("id",$mylisteNational->id)->update(["doublon_interne"=> $doublon_interne]);
               }
            }
            $request->merge(["erreur"=>$erreur,"doublon_interne"=>$doublon_interne,"doublon_externe"=>$doublon_externe,"parite"=>$parite]);
           /*  $ordre = $this->listedepartementalRepository->getByOrdreAndListe($request->ordre,$request->liste_id,$request->departement_id,$request->type);
            if(!empty($ordre))
            {
                return redirect()->back()->with('error', 'Numéro ordre déja utilisé.');  
            } */
               // $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
                $listedepartementals = $this->listedepartementalRepository->store($request->all());
                $candidats  = $this->listedepartementalRepository->getByListeAndType($user->liste_id,$request->type,$request->departement_id);
                return redirect()->back()->with(['success'=>'Candidat enregistré avec succ-s.','candidats'=>$candidats])->withInput();  
            
           

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
            ]);
            if($request->type=="titulaire")
            {
                $request->merge(["nb"=>53]);
            }
            else
            {
                $request->merge(["nb"=>50]);
            }
            $lastSave  = $this->listeNationalRepository->getLastOrdreByListe($request->liste_id,$request->type);
            if(empty($lastSave))
            {
                $request->merge(["ordre"=>1]);
            }
            else
            {
                $request->merge(["ordre"=>$lastSave->ordre+1]);

            }
            if(!empty($lastSave) && 54<$lastSave->ordre+1  && $request->type=="titulaire")
            {
                return redirect()->back()->with('error', 'Nombre de candidat autorisé dépassé.');  
            }
            if(!empty($lastSave) && 50<$lastSave->ordre+1 && $request->type=="supleant")
            {
                return redirect()->back()->with('error', 'Nombre de candidat autorisé dépassé.');  
            }
            $firstSave  = $this->listeNationalRepository->getFirstOrdreByListe($request->liste_id,$request->type);
            if(!empty($firstSave))
            {
                if ( $request->nb%2==0 || ($request->nb%2!=0 && $request->ordre+1 < $request->nb))
                {
                  
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
            
           
            
            $listeNational = $this->listeNationalRepository->getByCniOuterListe($request->numcni,$user->liste_id);
            $listeDepartemental = $this->listedepartementalRepository->getByCniOuterListe($request->numcni,$user->liste_id);

           
            if(!empty($listeNational) || !empty($listeDepartemental))
            {
                //$erreur = $erreur. 'Doublon externe';
               // $erreurdge = $erreurdge. 'Doublon externe ';
                //return redirect()->back()->with('error', 'Le candidat est déja inscrit dans une autre liste.'); 
                $doublon_externe =  'Doublon externe '; 
                if($listeDepartemental)
                {
                    $liste = DB::table("listes")->where("id",$listeDepartemental->liste_id)->first();
                    $departement = DB::table("departements")->where("id",$listeDepartemental->departement_id)->first();
                    $doublon_externe = $doublon_externe. ' : Liste '.$listeDepartemental->type.' '.$liste->nom.' Departement :'.$departement->nom ;
                    ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_externe"=>" Doublon externe Liste".$listeDepartemental->type.' '.$request->liste.' '.' Departement :'.$departement->nom ]);

                }
                if($listeNational)
                {
                    $liste = DB::table("listes")->where("id",$listeNational->liste_id)->first();
                    $doublon_externe = $doublon_externe. ' Liste '.$listeNational->type.' '.$liste->nom.' ';
                    ListeNational::where("id",$listeNational->id)->update(["doublon_externe"=>" Doublon externe Liste".$listeNational->type.' '.$request->liste.' ']);

                }
            }
            $mylisteNational = $this->listeNationalRepository->getByCniAndListe($request->numcni,$request->liste_id);
            $listeDepartemental = $this->listedepartementalRepository->getByCniAndListe($request->numcni,$request->liste_id);

            
            if(!empty($mylisteNational) || !empty($listeDepartemental))
            {
              //  $erreur = $erreur. 'Doublon interne';
               // $erreurdge = $erreurdge. 'Doublon interne ';
                //return redirect()->back()->with('error', 'Le candidat est déja inscrit dans une autre liste.');  
                $doublon_interne = 'Doublon interne';
                if($listeDepartemental)
                {
                 ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_interne"=> $doublon_interne]);
                }
                if($mylisteNational)
               {
                ListeNational::where("id",$mylisteNational->id)->update(["doublon_interne"=> $doublon_interne]);
               }
            }
           /*  $ordre = $this->listeNationalRepository->getByOrdreAndListe($request->ordre,$request->liste_id,$request->type);

            if(!empty($ordre))
            {
                return redirect()->back()->with('error', 'Numéro ordre déja utilisé.');  
            } */
          // dd("ok");
               // $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
               $request->merge(["erreur"=>$erreur,"doublon_interne"=>$doublon_interne,"doublon_externe"=>$doublon_externe,"parite"=>$parite]);
                $listenationals = $this->listeNationalRepository->store($request->all());
                //return redirect('listenational');
                $candidats  = $this->listeNationalRepository->getByListeAndType($user->liste_id,$request->type);
                return redirect()->back()->with(['success'=>'Candidat enregistré avec succès.','candidats'=>$candidats])->withInput();  
           


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
        $erreur = "";
        $erreurdge = "";
        $parite = "";
        $doublon_externe = "";
        $doublon_interne = "";
        if($request->extrait_ou_cnis){
            $extrait_ou_cni = uniqid() .'.'.$request->extrait_ou_cnis->extension();
            $request->extrait_ou_cnis->move('extrait_ou_cnis/', $extrait_ou_cni);
            $request->merge(['extrait_ou_cni'=>$extrait_ou_cni]);
        }
        if($request->casiers){
            $casier = uniqid() .'.'.$request->casiers->extension();
            $request->casiers->move('casier_judiciare/', $casier);
            $request->merge(['casier'=>$extrait_ou_cni]);
        }

        $age = $this->listedepartementalRepository->calculerAge($request->datenaiss);
            //dd($age);
            if($age < 25)
            {
                $erreurdge = $erreurdge. 'age minimun non ateint. age : '.$age.' ans';
                $erreur = $erreur. 'age minimun non ateint. age : '.$age.' ans';
            }
    
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
            ]);
            $candidat = $this->listedepartementalRepository->getById($id);

            $departement = $this->departementRepository->getById($request->departement_id);
            $firstSave  = $this->listedepartementalRepository->getfirstordreByListe($request->liste_id,$request->type,$request->departement_id);
            
            //si on mondifier le candidat ou le sexe saisi
            if($candidat->numcni!=$request->numcni || $candidat->sexe!=$request->sexe)
            {
                if($departement->nb == 1)
                {
                    if($request->type == "titulaire")
                    {
                        $lastSaveForOne  = $this->listedepartementalRepository->getLastOrdreByListe($request->liste_id,"supleant",$request->departement_id);
                        if(!empty($lastSaveForOne) && $request->sexe==$lastSaveForOne->sexe)
                        {
                           // $erreur = $erreur. ' Parite non respecter ';
                            //$erreurdge = $erreurdge. 'Partite non respecter ';
                            $parite = $parite. ' Parite non respecter ';
                        }
                    }
                    else
                    {
                        $lastSaveForOne  = $this->listedepartementalRepository->getLastOrdreByListe($request->liste_id,"titulaire",$request->departement_id);
                        if(!empty($lastSaveForOne) && $request->sexe==$lastSaveForOne->sexe)
                        {
                           // $erreur = $erreur. ' Parite non respecter' ;
                            //$erreurdge = $erreurdge. 'Partite non respecter ';
                            $parite = $parite. ' Parite non respecter ';
                        }
                    }
                    
                }
               else
               {

                    if($candidat->ordre > 1)
                    {
                        if($request->nb%2==0 || ($request->nb%2!=0 && $candidat->ordre+1 < $request->nb) )
                        {
                            if($firstSave->sexe==$request->sexe && $candidat->ordre%2==0  )
                            {
                            // $erreur = $erreur. ' Parite non respecter';
                            //  $erreurdge = $erreurdge. 'Partite non respecter';
                                $parite  =  ' Parite non respecter ';
        
                                
                            }
                            else if($firstSave->sexe!=$request->sexe && $candidat->ordre%2!=0 )
                            {
                                $parite  =  ' Parite non respecter ';
                            }
                        }
                    
                    }
                    else
                    {
                        $candidats = $this->listedepartementalRepository->getAllByListeAndTypeAndDepartement($candidat->liste_id,$candidat->type,$candidat->departement_id);
                            
                        foreach ($candidats as $key => $value) {
                            $pariteAutre = "";
                            if($value->ordre > 1)
                            {
                                if($request->nb%2==0 || ($request->nb%2!=0 && $value->ordre+1 < $request->nb))
                                {
                                    if($firstSave->sexe==$value->sexe && $value->ordre%2==0  )
                                    {
                                        $pariteAutre  =  ' Parite non respecter ';
                                    }
                                    else if($firstSave->sexe!=$value->sexe && $value->ordre%2!=0  )
                                    {
                                        $pariteAutre  =  ' Parite non respecter ';
                                    }
                                }
                                ListeDepartemental::where("id",$value->id)->update(["parite"=>$pariteAutre]);
                            }

                        }
                    }
                   
                }
              
               
                $listeDepartemental = $this->listedepartementalRepository->getByCniOuterListe($request->numcni,$candidat->liste_id);
                $listeNational = $this->listeNationalRepository->getByCniOuterListe($request->numcni,$candidat->liste_id);
                if(!empty($listeDepartemental) ||  $listeNational)
                {

                   // $erreurdge = $erreurdge. ' Doublon externe ';
                    $doublon_externe = ' Doublon externe ';
                    if($listeDepartemental)
                    {
                        $liste = DB::table("listes")->where("id",$listeDepartemental->liste_id)->first();
                        $departement = DB::table("departements")->where("id",$listeDepartemental->departement_id)->first();
                        $doublon_externe = $doublon_externe. ' : Liste '.$listeDepartemental->type.' '.$liste->nom.' Departement :'.$departement->nom ;
                        ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_externe"=>" Doublon externe Liste".$listeDepartemental->type.' '.$request->liste.' '.' Departement :'.$departement->nom ]);

                    }
                    if($listeNational)
                    {
                        $liste = DB::table("listes")->where("id",$listeNational->liste_id)->first();
                        $doublon_externe = $doublon_externe. ' Liste '.$listeNational->type.' '.$liste->nom.' ';
                        ListeNational::where("id",$listeNational->id)->update(["doublon_externe"=>" Doublon externe Liste".$listeNational->type.' '.$request->liste.' ']);

                    }
                }
                else
                {
                    $listeDepartemental = $this->listedepartementalRepository->getAllByCniiOuterListe($candidat->numcni,$candidat->liste_id);
                    $listeNational = $this->listeNationalRepository->getAllByCniOuterListe($candidat->numcni,$candidat->liste_id);
                    if(count($listeDepartemental)==1)
                    {
                        DB::table("liste_departementals")->where("id",$listeDepartemental[0]->id)->update(["doublon_externe"=>""]); 
                    }
                    if(count($listeNational)==1)
                    {
                        DB::table("liste_nationals")->where("id",$listeNational[0]->id)->update(["doublon_externe"=>""]); 
                    }
                }
                $listeDepartemental = $this->listedepartementalRepository->getByCniAndListeAndDepartementOuterOrdre($request->numcni,$request->liste_id,$request->departement_id,$candidat->ordre);
                $mylisteNational = $this->listeNationalRepository->getByCniAndListe($request->numcni,$request->liste_id);
    
                if(!empty($listeDepartemental) || !empty($mylisteNational))
                {
                   // $erreur = $erreur. ' Doublon interne';
                   $doublon_interne = ' Doublon interne';
                    //$erreurdge = $erreurdge. ' Doublon interne ';
                    if($listeDepartemental)
                    {
                     ListeDepartemental::where("id",$listeDepartemental->id)->update(["doublon_interne"=> $doublon_interne]);
                    }
                    if($mylisteNational)
                    {
                        ListeNational::where("id",$mylisteNational->id)->update(["doublon_interne"=> $doublon_interne]);
                    }
                }
                else
                {
                    $listeDepartemental = $this->listedepartementalRepository->getAllByCniAndListeAndDepartementOuterOrdre($candidat->numcni,$request->liste_id,$request->departement_id,$candidat->ordre);
                    $mylisteNational = $this->listeNationalRepository->getAllByCniAndListe($candidat->numcni,$request->liste_id);
                  //  dd($listeDepartemental,$mylisteNational);
                    if(count($listeDepartemental)==1)
                    {
                        //dd($listeDepartemental);
                        DB::table("liste_departementals")->where("id",$listeDepartemental[0]->id)->update(["doublon_interne"=>""]); 
                    }
                    if(count($mylisteNational)==1)
                    {
                        //dd($mylisteNational);
                        DB::table("liste_nationals")->where("id",$mylisteNational[0]->id)->update(["doublon_interne"=>""]); 
                    }

                }
             
               // $request->merge(["erreur"=>$erreur,"erreurdge"=>$erreurdge]);
               $request->merge(["erreur"=>$erreur,"doublon_interne"=>$doublon_interne,"doublon_externe"=>$doublon_externe,"parite"=>$parite]);
                $this->listedepartementalRepository->update($id, $request->all());
                return redirect('tab/1')->with('success', 'Candidat modifier avec succès.');      
            }
            
            $this->listedepartementalRepository->update($id, $request->all());
            return redirect('tab/1')->with('success', 'Candidat modifier avec succès.');  
            
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
        $user = Auth::user();
        if($user->role=='admin')
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
                $listedepartementals = $this->listedepartementalRepository->getByListeAndType($user->liste_id ,$request->type,$request->departement_id);
                }
                else if( $request->departement_id){
                    $listedepartementals = $this->listedepartementalRepository->getByListe($user->liste_id,$request->departement_id);
    
                }
                else if($request->type && $request->departement_id){
                    $listedepartementals = $this->listedepartementalRepository->getByTypeAndListe($request->type,$user->liste_id);
    
                }
                foreach ($listes as $key => $value) {
                    if($value->id == $user->liste_id)
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

    public function getLasTCandidatByListe($scrutin,$type,$departement_id)
    {
        $lastSave =null;
        
        if($scrutin == "majoritaire")
        {
            $candidat  = $this->listedepartementalRepository->getLastordreByListe(Auth::user()->liste_id,$type,$departement_id);
            $firstSave  = $this->listedepartementalRepository->getfirstordreByListe(Auth::user()->liste_id,$type,$departement_id);
            if($candidat)
            {
                $departement = $this->departementRepository->getById($candidat->departement_id);
                $lastSave = new \stdClass();
                $lastSave->ordre = isset($candidat->ordre) ? $candidat->ordre : 0;
                $lastSave->nb = $departement->nb;
                $lastSave->sexe = isset($firstSave->sexe) ? $firstSave->sexe : null;
            }
          

        }
        else if($scrutin == "propotionnel")
        {
            $candidat  = $this->listeNationalRepository->getLastOrdreByListe(Auth::user()->liste_id,$type);
            $firstSave  = $this->listeNationalRepository->getFirstOrdreByListe(Auth::user()->liste_id,$type);
            $lastSave = new \stdClass();
            $lastSave->ordre =isset($candidat->ordre) ? $candidat->ordre : 0;
            $lastSave->sexe =  isset($firstSave->sexe) ? $firstSave->sexe : null;

        }
        return response()->json($lastSave);
    }
      public function searchAjax(Request $request)
    {
      // return response()->json($request);


       $query = ListeDepartemental::query();
        if($request->scrutin == 'majoritaire')
        {
            $query = ListeDepartemental::query();
            if($request->liste_id ){
                $query->where("liste_id",$request->liste_id);
            }
            if( $request->departement_id){
                $query->where("departement_id",$request->departement_id);
            }
             if($request->type){
                $query->where("type",$request->type);
            }
        }
        else if($request->scrutin == 'propotionnel')
        {
           // return response()->json("fff");
            $query = ListeNational::query();
            if($request->liste_id){
               
                $query->where("liste_id",$request->liste_id);
               
            }
    
                 if($request->type){
                $query->where("type",$request->type);
            }
        }
    // return response()->json("fff");

        $data = $query->get();    
        return response()->json($data);


    } 

    public function listeCandidat()
    {
        //dd("ddd");
          
      
        $listedepartementals   = $this->listedepartementalRepository->getByOneListe(Auth::user()->liste_id);
        $listes                = [];
        $departements          = $this->departementRepository->getAll();
        $listenationals        = $this->listeNationalRepository->getByListe(Auth::user()->liste_id);

        return view('liste_candidat',compact('listedepartementals',"listes","departements","listenationals"));
    }


}
