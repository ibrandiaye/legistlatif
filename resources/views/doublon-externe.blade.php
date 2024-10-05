@extends('welcome')
@section('title', '| $listenational')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                </ol>
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
   
    <div id="defaut">


        <div class="col-12">
            <div class="card ">
                <div class="card-header">LISTE PROPORTIONNEL</div>
                    <div class="card-body">

                        <a class="btn btn-primary" href="{{ route('doublon.externe', ['id'=>2]) }}">Imprimer</a>
                        <br><br>
                        <table id="datatable-buttons" class="table datatable-buttons1 table-bordered table-responsive table-striped text-center ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Numero Electeur</th>
                                    <th>Sexe</th>
                                    <th>Profession</th>
                                    <th>Date de Naissance</th>
                                    <th>Lieux de Naissance</th>
                                    <th>Erreur</th>

                                    {{-- <th>Action</th> --}}
                                    <th>Etat</th>
                                    <th>Commentaire</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listeNationals as $listenational)
                              
                                    <tr>
                                        <td>{{ $listenational->ordre }}</td>
                                        <td>{{ $listenational->prenom }}</td>
                                        <td>{{ $listenational->nom }}</td>
                                        <td>{{ $listenational->numelecteur }}</td>
                                        <td>{{ $listenational->sexe }}</td>
                                        <td>{{ $listenational->profession }}</td>
                                        <td>{{ date('d-m-Y', strtotime($listenational->datenaiss)) }}</td>
                                        <td>{{ $listenational->lieunaiss }}</td>
                                       <td class="text-danger">{{ $listenational->erreur }} <br>{{ $listenational->parite }}<br>{{ $listenational->doublon_interne }}<br>{{ $listenational->doublon_externe }} <br>	{{ $listenational->sur_le_fichier }}</td>
                                            {{--  <td> <a href="{{ route('valider.national',["id"=>$listenational->id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i></a>
                                                <a href="{{ route('listenational.edit', $listenational->id) }}" data-toggle="modal" data-target="#listenational{{$listenational->id}}" role="button" class="btn btn-danger"><i class="fas fa-ban"></i></a>

                                             
                                            </td> --}}
                                     <td>
                                       @if ($listenational->verif==0)
                                           <span class="badge badge-boxed  badge-info"> Non verifier</span>
                                       @elseif($listenational->etat==0)
                                       <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                       @else
                                       <span class="badge badge-boxed  badge-success"> Valider</span>
                                       @endif
                                    </td>
                                    <td>{{$listenational->commentaire}}</td>
                                    </tr>
                              
                            @endforeach

                            </tbody>
                        </table>
                
                    </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="card ">
                <div class="card-header">LISTE DEPARTEMENTAL</div>
                    <div class="card-body">
                        
                        <table id="datatable-buttons" class="table  datatable-buttons1 table-bordered table-responsive table-striped text-center ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Numero Electeur</th>
                                    <th>Sexe</th>
                                    <th>Liste</th>
                                    <th>Date de Naissance</th>
                                    <th>Lieux de Naissance</th>
                                    <th>Erreur</th>

                                    {{-- <th>Action</th> --}}

                                    <th>Etat</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listeDepartements as $listeDepartement)
                               
                                    <tr>
                                        <td>{{ $listeDepartement->ordre }}</td>
                                        <td>{{ $listeDepartement->prenom }}</td>
                                        <td>{{ $listeDepartement->nom }}</td>
                                        <td>{{ $listeDepartement->numelecteur }}</td>
                                        <td>{{ $listeDepartement->sexe }}</td>
                                        <td>{{ $listeDepartement->liste }}</td>
                                        <td>{{ date('d-m-Y', strtotime($listeDepartement->datenaiss)) }}</td>
                                        <td>{{ $listeDepartement->lieunaiss }}</td>
                                        <td class="text-danger">{{ $listeDepartement->erreur }}<br>{{ $listeDepartement->parite }}<br>{{ $listeDepartement->doublon_interne }}<br>{{ $listeDepartement->doublon_externe }} <br>	{{ $listeDepartement->sur_le_fichier }}</td>
                                        {{-- <td> </td> --}}
                                        <td>
                                            @if ($listeDepartement->verif==0)
                                                <span class="badge badge-boxed  badge-info"> Non verifier</span>
                                            @elseif($listeDepartement->etat==0)
                                            <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                            @else
                                            <span class="badge badge-boxed  badge-success"> Valider</span>
                                            @endif
                                        </td>
                                      
                                    </tr>
                               
                            @endforeach

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
            
    </div>


@endsection
