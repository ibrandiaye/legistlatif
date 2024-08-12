@extends('welcome')
@section('title', '| $listenational')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('listenational.create') }}">ENREGISTRER $listenational</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Starter</h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    
   <div class="row">
        <div class="col-sm-4">
            <div class="card ">
            
                <div class="card-header">Coalition Ou Partie : {{$liste->nom}}</div>
                <div class="card-body">
                    <h6 class="card-title">Ordre : {{ $listenational->ordre }}</h6>
                    <h6 class="card-title">Prenom :{{ $listenational->prenom }} </h6>
                    <h6 class="card-title">Nom : {{ $listenational->nom }}</h6>
                    <h6 class="card-title">Date Naissance : {{ $listenational->datenaiss }}</h6>
                    <h6 class="card-title">Lieu de Naissance :{{ $listenational->lieunaiss }} </h6>
                    <h6 class="card-title">Sexe : {{ $listenational->sexe }}</h6>
                    <h6 class="card-title">Profession : {{ $listenational->profession }}</h6>
                    <h6 class="card-title">Numero Carte d'identité : {{ $listenational->numcni }}</h6>
                    <h6 class="card-title">Numéro Carte Electeur :{{ $listenational->numelecteur }} </h6>
                    <h6 class="card-title">Liste : {{ $listenational->type }}</h6>
                    <h6 class="card-title">Position : {{ $listenational->type }}</h6>
                    @if($listenational->etat==0 )
                    @if(Auth::user()->role=='admin')
                    <a href="{{ route('changer.etat.listenational', $listenational->id) }}" role="button" class="btn btn-danger" onclick="if(!confirm('Êtes-vous sûr de vouloir valider le candidat ?')) { return false; }">Valider le Candidat</a>
                    @else
                    <span class="badge badge-pill badge-danger">Non Valider</span>
                    @endif
                    @else
                    <span class="badge badge-pill badge-success">Valider</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <iframe src ="{{ asset('/laraview/#../document/'.$listenational->extrait_ou_cni) }}" width="800px" height="600px"></iframe>
            <iframe src ="{{ asset('/laraview/#../document/'.$listenational->casier) }}" width="800px" height="600px"></iframe>

        </div>    
    </div>    
        
                
              
@endsection
