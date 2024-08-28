@extends('welcome')
@section('title', '| $listedepartemental')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('listedepartemental.create') }}">ENREGISTRER $listedepartemental</a></li>
                                </ol>
                            </div>
                             @if(Auth::user()->role=="admin") DGE
                        @else
                        {{Auth::user()->liste->nom}}
                         @endif
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
                    <h6 class="card-title">Ordre : {{ $listedepartemental->ordre }}</h6>
                    <h6 class="card-title">Prenom :{{ $listedepartemental->prenom }} </h6>
                    <h6 class="card-title">Nom : {{ $listedepartemental->nom }}</h6>
                    <h6 class="card-title">Date Naissance : {{ $listedepartemental->datenaiss }}</h6>
                    <h6 class="card-title">Lieu de Naissance :{{ $listedepartemental->lieunaiss }} </h6>
                    <h6 class="card-title">Sexe : {{ $listedepartemental->sexe }}</h6>
                    <h6 class="card-title">Profession : {{ $listedepartemental->profession }}</h6>
                    <h6 class="card-title">Numero Carte d'identité : {{ $listedepartemental->numcni }}</h6>
                    <h6 class="card-title">Numéro Carte Electeur :{{ $listedepartemental->numelecteur }} </h6>
                    <h6 class="card-title">Liste : {{ $listedepartemental->type }}</h6>
                    <h6 class="card-title">Departement : {{ $departement->nom }}</h6>
                    <h6 class="card-title">Position : {{ $listedepartemental->type }}</h6>
                    @if($listedepartemental->etat==0 )
                    @if(Auth::user()->role=='admin')
                    <a href="{{ route('changer.etat.listedepartemental', $listedepartemental->id) }}" role="button" class="btn btn-danger" onclick="if(!confirm('Êtes-vous sûr de vouloir valider le candidat ?')) { return false; }">Valider le Candidat</a>
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
            <iframe src ="{{ asset('/laraview/#../extrait_ou_cnis/'.$listedepartemental->extrait_ou_cni) }}" width="800px" height="600px"></iframe>
            <iframe src ="{{ asset('/laraview/#../casier_judiciare/'.$listedepartemental->casier) }}" width="800px" height="600px"></iframe>

        </div>    
    </div>    
        
                
              
@endsection
