@extends('welcome')
@section('title', '| departement')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
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
        <div class="card-header">LISTES </div>
            <div class="card-body">
               
                <table  id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center datatable-buttons">
                    <thead>
                        <tr>
                            <th>Liste</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Propotionnel</td>
                        <td>
                            <a href="{{ route('supprimer.liste',['scrutin'=>'proportionnel','type'=>'titulaire','departement'=>0] ) }}" role="button" class="btn btn-danger"  onclick="if(!confirm('Êtes-vous sûr de vouloir supprimer la liste proportionnel titulaire ?')) { return false; }"><i class="fas fa-trash"></i> Supprimer titulaire</a>
                            <a href="{{ route('supprimer.liste',['scrutin'=>'proportionnel','type'=>'supleant','departement'=>0]) }}" role="button" class="btn btn-danger"  onclick="if(!confirm('Êtes-vous sûr de vouloir supprimer la liste proportionnel suppleant ?')) { return false; }"><i class="fas fa-trash"></i> Supprimer Suppleant</a>

                        </td>
                      </tr>  
                    @foreach ($departements as $departement)
                        <tr>
                            <td>{{ $departement->nom }}</td>
                            
                            <td>
                                <a href="{{ route('supprimer.liste', ['scrutin'=>'majoritaire','type'=>'titulaire','departement'=>$departement->id]) }}" role="button" class="btn btn-danger"  onclick="if(!confirm('Êtes-vous sûr de vouloir supprimer la liste majoritaire({{$departement->nom}}) titulaire ?')) { return false; }"><i class="fas fa-trash"></i> Supprimer titulaire</a>
                                <a href="{{ route('supprimer.liste',['scrutin'=>'majoritaire','type'=>'supleant','departement'=>$departement->id] ) }}" role="button" class="btn btn-danger"  onclick="if(!confirm('Êtes-vous sûr de vouloir supprimer la liste majoritaire({{$departement->nom}}) suppleant ?')) { return false; }"><i class="fas fa-trash"></i> Supprimer Suppleant</a>
    
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>
    </div>
</div>

@endsection
