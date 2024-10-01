<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationDepartementalController extends Controller
{
    protected $validationDepartementalRepository;
    protected $listeRepository;

    public function __construct(ValidationDepartementalRepository $validationDepartementalRepository, ListeRepository $listeRepository){
        $this->validationDepartementalRepository =$validationDepartementalRepository;
        $this->listeRepository = $listeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validationDepartementals = $this->validationDepartementalRepository->getAllWithliste();
        return view('validationDepartemental.index',compact('validationDepartementals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listes = $this->listeRepository->getAll();
        return view('validationDepartemental.add',compact('listes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationDepartementals = $this->validationDepartementalRepository->store($request->all());
        return redirect('validationDepartemental');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validationDepartemental = $this->validationDepartementalRepository->getById($id);
        return view('validationDepartemental.show',compact('validationDepartemental'));
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
        $validationDepartemental = $this->validationDepartementalRepository->getById($id);
        return view('validationDepartemental.edit',compact('validationDepartemental','listes'));
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
        $this->validationDepartementalRepository->update($id, $request->all());
        return redirect('validationDepartemental');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->validationDepartementalRepository->destroy($id);
        return redirect('validationDepartemental');
    }
}
