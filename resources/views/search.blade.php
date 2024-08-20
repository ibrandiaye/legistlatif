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
        <div class="card-header">LISTE National</div>
            <div class="card-body">
               
                    
                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center datatable-buttons">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Liste</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Numero Electeur</th>
                            <th>Sexe</th>
                            <th>Profession</th>
                            <th>Date de Naissance</th>
                            <th>Lieux de Naissance</th>
                            <th>Erreur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listeNationals as $listenational)
                        <tr>
                            <td>{{ $listenational->id }}</td>
                            <td>{{ $listenational->liste }}</td>
                            <td>{{ $listenational->prenom }}</td>
                            <td>{{ $listenational->nom }}</td>
                            <td>{{ $listenational->numelecteur }}</td>
                            <td>{{ $listenational->sexe }}</td>
                            <td>{{ $listenational->profession }}</td>
                            <td>{{ $listenational->datenaiss }}</td>
                            <td>{{ $listenational->lieunaiss }}</td>
                            <td  class="text-danger">{{ $listenational->erreurdge }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
    </div>
</div>

<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE Departemental</div>
            <div class="card-body">
               
                    
                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center datatable-buttons">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Liste</th>
                            <th>departement</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Numero Electeur</th>
                            <th>Sexe</th>
                            <th>Profession</th>
                            <th>Date de Naissance</th>
                            <th>Lieux de Naissance</th>
                            <th>Erreur</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listeDepartementals as $listedepartemental)
                        <tr>
                            <td>{{ $listedepartemental->id }}</td>
                            <td>{{ $listedepartemental->liste }}</td>
                            <td>{{ $listedepartemental->departement }}</td>
                            <td>{{ $listedepartemental->prenom }}</td>
                            <td>{{ $listedepartemental->nom }}</td>
                            <td>{{ $listedepartemental->numelecteur }}</td>
                            <td>{{ $listedepartemental->sexe }}</td>
                            <td>{{ $listedepartemental->profession }}</td>
                            <td>{{ $listedepartemental->datenaiss }}</td>
                            <td>{{ $listedepartemental->lieunaiss }}</td>
                            <td  class="text-danger">{{ $listedepartemental->erreurdge }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
    </div>
</div>
@endsection
