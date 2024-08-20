<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\ListeRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;
    protected $listeRepository;

    public function __construct(UserRepository $userRepository, ListeRepository $listeRepository){
        $this->userRepository =$userRepository;
        $this->listeRepository = $listeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listes = $this->listeRepository->getAll();
        return view('user.add',compact('listes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
        //'g-recaptcha-response' => 'required|captcha',
    ]);
        //$users = $this->userRepository->store($request->all());
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role'=>$request['role'],
            'liste_id'=>$request['liste_id']
        ]);
        return redirect('user');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return view('user.show',compact('user'));
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
        $user = $this->userRepository->getById($id);
        return view('user.edit',compact('user','listes'));
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
        $this->userRepository->update($id, $request->all());
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return redirect('user');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required|string|min:8|confirmed',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
        User::where("id",$request->id)->update(["password"=>Hash::make($request['password'])]);
        return redirect('user');

    }
}
