<?php

namespace App\Http\Controllers;

use App\Repositories\ValidationNationalRepository;
use App\Repositories\ListeRepository;
use Illuminate\Http\Request;

class ValidationNationalController extends Controller
{
    protected $validationNationalRepository;
    protected $listeRepository;

    public function __construct(ValidationNationalRepository $validationNationalRepository, ListeRepository $listeRepository){
        $this->validationNationalRepository =$validationNationalRepository;
        $this->listeRepository = $listeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validationNationals = $this->validationNationalRepository->getAllWithliste();
        return view('validationNational.index',compact('validationNationals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listes = $this->listeRepository->getAll();
        return view('validationNational.add',compact('listes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationNationals = $this->validationNationalRepository->store($request->all());
        return redirect('validationNational');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validationNational = $this->validationNationalRepository->getById($id);
        return view('validationNational.show',compact('validationNational'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listes = $this->listeRepository->getAll();
        $validationNational = $this->validationNationalRepository->getById($id);
        return view('validationNational.edit',compact('validationNational','listes'));
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
        $this->validationNationalRepository->update($id, $request->all());
        return redirect('validationNational');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->validationNationalRepository->destroy($id);
        return redirect('validationNational');
    }
}
