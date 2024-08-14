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
    <div class="col-12">
        <div class="card ">
            <div class="card-header">LISTE PROPORTIONNEL</div>
                <div class="card-body">
                    <h3>Titulaires</h3>
                    <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center ">
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
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($listenationalTitulaire as $listenational)
                            @if($listenational->type=='titulaire')
                                <tr>
                                    <td>{{ $listenational->ordre }}</td>
                                    <td>{{ $listenational->prenom }}</td>
                                    <td>{{ $listenational->nom }}</td>
                                    <td>{{ $listenational->numelecteur }}</td>
                                    <td>{{ $listenational->sexe }}</td>
                                    <td>{{ $listenational->profession }}</td>
                                    <td>{{ $listenational->datenaiss }}</td>
                                    <td>{{ $listenational->lieunaiss }}</td>
                                    <td class="text-danger">{{ $listenational->erreur }}</td>
                                    <td>
                                        <td> <a href="{{ route('declaration',["id"=>$listenational->id,'type'=>'majoritaire']) }}" role="button" class="btn btn-warning"><i class="fas fa-file"></i></a>
                                            <a href="{{ route('listenational.edit', $listenational->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </td>    
                                </tr>
                            @endif
                        @endforeach
    
                        </tbody>
                    </table>
                    <h3>Suppleant</h3>
                    <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center ">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($listenationalSuppleant as $listenational)
                            @if($listenational->type=='supleant')
                                <tr>
                                    <td>{{ $listenational->ordre }}</td>
                                    <td>{{ $listenational->prenom }}</td>
                                    <td>{{ $listenational->nom }}</td>
                                    <td>{{ $listenational->numelecteur }}</td>
                                    <td>{{ $listenational->sexe }}</td>
                                    <td>{{ $listenational->profession }}</td>
                                    <td>{{ $listenational->datenaiss }}</td>
                                    <td>{{ $listenational->lieunaiss }}</td>
                                    <td class="text-danger">{{ $listenational->erreur }}</td>
                                   <td> <a href="{{ route('declaration',["id"=>$listenational->id,'type'=>'propotionnel']) }}" role="button" class="btn btn-warning"><i class="fas fa-file"></i></a>
                                    <a href="{{ route('listenational.edit', $listenational->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                </td>

                                </tr>
                            @endif
                        @endforeach
    
                        </tbody>
                    </table>
                </div>
        </div>
    </div>           
    @foreach($listeParDepartementFinal as $departement => $categories)
    <div class="col-12">
        <div class="card ">
            <div class="card-header">{{ $departement }}</div>
            <div class="card-body">
                @if(!empty($categories['titulaire']))
                <h3>Titulaires</h3>
            <table  class="table table-bordered table-responsive-md table-striped text-center ">
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
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                
                
                    @foreach($categories['titulaire'] as $titulaire)
                    
                            <tr>
                                <td>{{ $titulaire['data']->id }}</td>
                                <td>{{ $titulaire['data']->prenom }}</td>
                                <td>{{ $titulaire['data']->nom }}</td>
                                <td>{{ $titulaire['data']->numelecteur }}</td>
                                <td>{{ $titulaire['data']->sexe }}</td>
                                <td>{{ $titulaire['data']->profession }}</td>
                                <td>{{ $titulaire['data']->datenaiss }}</td>
                                <td>{{ $titulaire['data']->lieunaiss }}</td>
                                <td class="text-danger">{{ $titulaire['data']->erreur }}</td>
                                <td> <a href="{{ route('declaration',["id"=>$titulaire['data']->id,'type'=>'majoritaire']) }}" role="button" class="btn btn-warning"><i class="fas fa-file"></i></a>
                                    <a href="{{ route('listedepartemental.edit', $titulaire['data']->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                </td>


                            </tr>
                    @endforeach        
                    
                        
                        </tbody>
                    
            </table>
            @else
            <p>Aucun titulaire trouvé pour ce département.</p>
            @endif
            @if(!empty($categories['supleant']))
            <h3>supleant</h3>
        <table  class="table table-bordered table-responsive-md table-striped text-center ">
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
            <th>Action</th>

        </tr>
        </thead>
        <tbody>


        @foreach($categories['supleant'] as $supleant)
        
                
                <tr>
                    <td>{{ $supleant['data']->ordre }}</td>
                    <td>{{ $supleant['data']->prenom }}</td>
                    <td>{{ $supleant['data']->nom }}</td>
                    <td>{{ $supleant['data']->numelecteur }}</td>
                    <td>{{ $titulaire['data']->sexe }}</td>
                    <td>{{ $supleant['data']->profession }}</td>
                    <td>{{ $supleant['data']->datenaiss }}</td>
                    <td>{{ $supleant['data']->lieunaiss }}</td>
                    <td class="text-danger">{{ $supleant['data']->erreur }}</td>
                    <td> <a href="{{ route('declaration',["id"=> $supleant['data']->id,'type'=>'propotionnel']) }}" role="button" class="btn btn-warning"><i class="fas fa-file"></i></a>
                        <a href="{{ route('listedepartemental.edit', $supleant['data']->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>


                </tr>
        @endforeach        
        
            
            </tbody>
        
        </table>
        @else
        <p>Aucun Supleant trouvé pour ce département.</p>
        @endif
        </div>
</div>  
</div>
    @endforeach
@endsection
