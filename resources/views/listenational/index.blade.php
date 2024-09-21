@extends('welcome')
@section('title', '| $listenational')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('listenational.create') }}">ENREGISTRER listenational</a></li>
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

<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE D'ENREGISTREMENT DES Départements</div>
            <div class="card-body">
               
                    <form method="POST" action="{{ route('search.listenational') }}">
                        @csrf
                        <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Type Liste </label>
                                <select class="form-control" name="type" >
                                    <option value="">Selectionner</option>
                                    <option value="titulaire">titulaire</option>
                                    <option value="propotionel">propotionel</option>
                                </select>
                            </div>
                        </div>
                        @if(Auth::user()->role=='admin')
                        <div class="col">
                            <label> Liste</label>
                            <select class="form-control" name="liste_id" >
                                <option value="">Selectionner</option>
                                @foreach ($listes as $liste)
                                <option value="{{$liste->id}}" {{old('liste_id')==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                    @endforeach

                            </select>
                        </div>
                        @endif
                        <div class="col">
                            <label> </label><br>
                            <button type="submit" class="btn btn-success btn-sm " style="margin-top: 10px;"> Rehercher</button>
                        </div>
                    
                     </div>
                    </form>
               
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalform2">
                    importer
                </button>
                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center datatable-buttons">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listenationals as $listenational)
                        <tr>
                            <td>{{ $listenational->id }}</td>
                            <td>{{ $listenational->prenom }}</td>
                            <td>{{ $listenational->nom }}</td>
                            <td>{{ $listenational->numelecteur }}</td>
                            <td>{{ $listenational->sexe }}</td>
                            <td>{{ $listenational->profession }}</td>
                            <td>{{ date('d-m-Y', strtotime($listenational->datenaiss)) }}td>
                            <td>{{ $listenational->lieunaiss }}</td>
                            <td  class="text-danger">{{ $listenational->erreurdge }}</td>
                            <td>
                                <a href="{{ route('listenational.show', $listenational->id) }}" role="button" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('listenational.edit', $listenational->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['listenational.destroy', $listenational->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}



                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>



                <div class="modal fade" id="exampleModalform2" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('importer.listenational') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">New message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label> Liste</label>
                                        <select class="form-control" name="liste_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($listes as $liste)
                                            <option value="{{$liste->id}}">{{$liste->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Type Liste </label>
                                            <select class="form-control" name="type" required="">
                                                <option value="">Selectionner</option>
                                                <option value="titulaire">titulaire</option>
                                                <option value="propotionel">propotionel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="field-7" class="control-label">Document</label>
                                            <input type="file" name="file" class="form-control" required>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
