@extends('welcome')
@section('title', '| listenational')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="#">Verif NB Candidat</a></li>
                                </ol>
                            </div>
                         
                        {{$liste->nom}}
                       
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
        <div class="card-header">LISTE Proportionnel</div>
            <div class="card-body">
                
                <table  id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center ">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Nb candidant dans la liste </th>
                            <th>Nom candidat </th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listeNationals as $listenational)
                        <tr>
                            <td>{{ $listenational->type }}</td>
                            <td>{{ $listenational->nbre }}</td>
                            <td>@if($listenational->type=="titulaire") 53 @else 50 @endif</td>
                            <td>@if($listenational->type=="titulaire")
                                  @if($listenational->nbre==53)
                                    <span class="badge badge-success">OK</span>
                                  @else
                                  <span class="badge badge-danger">KO</span>
                                  @endif
                                 
                                 @else 
                                 @if($listenational->nbre==50)
                                 <span class="badge badge-success">OK</span>
                               @else
                               <span class="badge badge-danger">KO</span>
                               @endif
                                 @endif</td>
                          

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
    </div>
</div>

<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE Majoritaire</div>
            <div class="card-body">
              
                <table  id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center ">
                    <thead>
                        <tr>
                            <th>Departement</th>
                            <th>Type</th>
                            <th>Nb candidant dans la liste </th>
                            <th>Nom candidat </th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listeDepartementals as $listeDepartemental)
                        <tr>
                            <td>{{ $listeDepartemental->departement }}</td>
                            <td>{{ $listeDepartemental->type }}</td>
                            <td>{{ $listeDepartemental->nbre }}</td>
                            <td>{{$listeDepartemental->nb}}</td>
                            <td>
                                  @if($listeDepartemental->nbre==$listeDepartemental->nb)
                                    <span class="badge badge-success">OK</span>
                                  @else
                                  <span class="badge badge-danger">KO</span>
                                  @endif
                                 
                            </td>
                         

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection
