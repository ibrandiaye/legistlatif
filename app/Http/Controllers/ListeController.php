<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use App\Repositories\ListeDepartementalRepository;
use App\Repositories\ListeNationalRepository;
use App\Repositories\ListeRepository;
use DB;
use Illuminate\Http\Request;

class ListeController extends Controller
{
    protected $listeRepository;
    protected $listeNationalRepository;
    protected $listeDepartementalRepository;

    public function __construct(ListeRepository $listeRepository,ListeNationalRepository $listeNationalRepository,
    ListeDepartementalRepository $listeDepartementalRepository){
        $this->listeRepository              = $listeRepository;
        $this->listeDepartementalRepository = $listeDepartementalRepository;
        $this->listeNationalRepository      = $listeNationalRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listes = $this->listeRepository->getAll();
        return view('liste.index',compact('listes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('liste.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       /* $request->validate([
            'pabddprpas' => 'file|mimes:docx,pdf,doc,xls,xlsx ',
            'lms' => 'file|mimes:docx,pdf,doc,xls,xlsx',
            'cvs' => 'file|mimes:docx,pdf,doc,xls,xlsx',
            'lrs' => 'file|mimes:docx,pdf,doc,xls,xlsx',
            'prtdps' => 'file|mimes:docx,pdf,doc,xls,xlsx',
            'clceorccis' => 'file|mimes:docx,pdf,doc,xls,xlsx',
            'amordeas' => 'file|mimes:docx,pdf,doc,xls,xlsx',
            'cnis'=> 'file|mimes:docx,pdf,doc,xls,xlsx'

        ]);*/
        //
       
        $listes = $this->listeRepository->store($request->all());
        return redirect('liste');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $liste = $this->listeRepository->getById($id);
        return view('liste.show',compact('liste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $liste = $this->listeRepository->getById($id);
        return view('liste.edit',compact('liste'));
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
        $this->listeRepository->update($id, $request->all());
        return redirect('liste');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->listeDepartementalRepository->deleteByListe($id);
        $this->listeNationalRepository->deleteByListe($id);
      //  $this->listeRepository->destroy($id);
       

        return redirect('liste');
    }
    public function rejeter(Request $request)
    {
        $liste_nationals = DB::table('liste_nationals')->where([["liste_id",$request->id],["verif",0]])->first();
        $liste_departementals = DB::table('liste_departementals')->where([["liste_id",$request->id],["verif",0]])->first();
        if(!empty($liste_nationals) or !empty($liste_departementals))
        {
            return redirect()->back()->with('error', 'Il existe des candidats non verifier.');  
        }
        Liste::where("id",$request->id)->update(["etat"=>0,"commentaire"=>$request->commentaire,'verif'=>1]);
        return redirect()->back();
    }
    public function valider(Request $request)
    {
        $liste_nationals = DB::table('liste_nationals')->where([["liste_id",$request->id],["verif",0]])->first();
        $liste_departementals = DB::table('liste_departementals')->where([["liste_id",$request->id],["verif",0]])->first();
        if(!empty($liste_nationals) or !empty($liste_departementals))
        {
            return redirect()->back()->with('error', 'Il existe des candidats non verifier.');  
        }   
        Liste::where("id",$request->id)->update(["etat"=>1,'verif'=>1]);
        return redirect()->back();
    }

}
