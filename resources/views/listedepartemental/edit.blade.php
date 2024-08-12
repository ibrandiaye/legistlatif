{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('listedepartemental.index') }}" >RETOUR</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        {!! Form::model($listedepartemental, ['method'=>'PATCH','route'=>['listedepartemental.update', $listedepartemental->id],"enctype"=>"multipart/form-data"]) !!}
            @csrf
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION Département</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Ordre </label>
                                            <input type="number" name="ordre"  value="{{ $listedepartemental->ordre }}" class="form-control"  required>
                                        </div>
                                    </div>
                               
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Prenom </label>
                                        <input type="text" name="prenom"  value="{{$listedepartemental->prenom }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Nom </label>
                                        <input type="text" name="nom"  value="{{$listedepartemental->nom }}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Sexe </label>
                                        <select class="form-control" name="sexe" required="">
                                            <option value="Selectionner"></option>
                                            <option value="M" {{$listedepartemental->sexe=="M" ? 'selected' : ''}}>Homme</option>
                                            <option value="F" {{$listedepartemental->sexe=="F" ? 'selected' : ''}}>Femme</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Profession </label>
                                        <input type="text" name="profession"  value="{{$listedepartemental->profession }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Date de naissance </label>
                                        <input type="date" name="datenaiss"  value="{{$listedepartemental->datenaiss }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Lieu de naissance  </label>
                                        <input type="text" name="lieunaiss"  value="{{$listedepartemental->lieunaiss }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Numéro Elecetur </label>
                                        <input type="number" name="numelecteur"  value="{{$listedepartemental->numelecteur }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Numéro CNI </label>
                                        <input type="number" name="numcni"  value="{{$listedepartemental->numcni }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Type Liste </label>
                                        <select class="form-control" name="type" required="">
                                            <option value="">Selectionner</option>
                                            <option value="titulaire" {{$listedepartemental->type=="titulaire" ? 'selected' : ''}}>titulaire</option>
                                            <option value="propotionel" {{$listedepartemental->type=="titulaire" ? 'selected' : ''}}>propotionel</option>
                                        </select>
                                    </div>
                                </div>
                               
                                    <div class="col-lg-3">
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id" required="">
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}" {{$listedepartemental->departement_id==$departement->id ? 'selected' : ''}}>{{$departement->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Liste</label>
                                        <select class="form-control" name="liste_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($listes as $liste)
                                            <option value="{{$liste->id}}" {{$listedepartemental->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Domicile </label>
                                            <input type="text" name="domicile"   value="{{ $listedepartemental->domicile }}" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Service, Emploi et lieu d’affectation pour les agents de l’Etat </label>
                                            <input type="text" name="se"   value="{{ $listedepartemental->se }}" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Une extrait d’acte de naissance datant de moins de six (06) mois ou la photocopie légalisée de la carte d’identité biométrique CEDEAO </label>
                                            <input type="file" name="extrait_ou_cnis"  value="{{ old('extrait_ou_cni') }}" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>bulletin n°3 du casier judiciaire datant de moins de trois mois</label>
                                            <input type="file" name="casiers"  value="{{ old('casier') }}" class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                               
                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> MODIFIER</button>
                                    </center>
                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection
