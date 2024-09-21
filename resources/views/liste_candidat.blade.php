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
                            <h4 class="page-title"> @if(Auth::user()->role=="admin") DGE
                                @else
                                {{Auth::user()->liste->nom}}
                                 @endif</h4>
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
    
   {{--     <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Nationnal</div>
            <div class="card-body">
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
            </div>
        </div>
       </div> --}}
<div class="col-12">
    <div class="card ">
       
        <div class="card-header">@if(!empty($liste)) {{$liste->nom}} : @endif @if(!empty($type))  {{$type }} @endif  @if(!empty($departement)) Departement de :  {{$departement->nom}}  @endif</div>
            <div class="card-body">
                <form method="POST" action="{{ route('search.listedepartemental') }}">
                    @csrf
                    
                    <div class="row">
                      
                        <input type="hidden" id="liste_id" name="liste_id" value="{{Auth::user()->liste_id}}">
                        <div class="col-lg-3 scrutin">
                            <label> Scrutin</label>
                            <select class="form-control" id="scrutin" name="scrutin" required="">
                                <option value="">Selectionner</option>
                                <option value="majoritaire">Majoritaire</option>
                                <option value="propotionnel">Propotionnel</option>
                            </select>
                        </div>
                        <div class="col-lg-3 departement">
                            <label>Departement</label>
                            <select class="form-control" name="departement_id" id="departement_id" required="">
                                <option value="">Selectionner</option>
                                @foreach ($departements as $departement)
                                <option value="{{$departement->id}}">{{$departement->nom}}</option>
                                    @endforeach
            
                            </select>
                        </div>
                        <div class="col-lg-3 typeliste">
                            <div class="form-group ">
                                <label>Type Liste </label>
                                <select class="form-control" name="type"id="type" >
                                    <option value="">Selectionner</option>
                                    <option value="titulaire">titulaire</option>
                                    <option value="supleant">supleant</option>
                                </select>
                            </div>
                        </div>
                  
                  
                  
                   {{--  <div class="col">
                        <br>
                        <button type="submit" class="btn btn-success btn btn-lg " style="margin-top: 10px;"> ENREGISTRER</button>                        
                    </div>
                 --}}
            </div>
        </form>
               {{--  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalform2">
                    importer
                </button> --}}
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
                    <tbody id="tbody">
                  {{--   @foreach ($listedepartementals as $listedepartemental)
                        <tr>
                            <td>{{ $listedepartemental->id }}</td>
                            <td>{{ $listedepartemental->prenom }}</td>
                            <td>{{ $listedepartemental->nom }}</td>
                            <td>{{ $listedepartemental->numelecteur }}</td>
                            <td>{{ $listedepartemental->sexe }}</td>
                            <td>{{ $listedepartemental->profession }}</td>
                            <td>{{ $listedepartemental->datenaiss }}</td>
                            <td>{{ $listedepartemental->lieunaiss }}</td>
                            <td  class="text-danger">{{ $listedepartemental->erreur }}</td>
                            <td>
                                <a href="{{ route('listedepartemental.show', $listedepartemental->id) }}" role="button" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('listedepartemental.edit', $listedepartemental->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['listedepartemental.destroy', $listedepartemental->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}



                            </td>

                        </tr>
                        @endforeach --}}

                    </tbody>
                </table>



                <div class="modal fade" id="exampleModalform2" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('importer.listedepartemental') }}" method="POST" enctype="multipart/form-data">
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
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id" required="">
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}">{{$departement->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
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

@section('script')
    <script>
          $(document).ready(function () {
         //   url = "http://5.189.166.92/legistlatif/public/search/ajax";
         //  url = "http://127.0.0.1:8000/search/ajax"
           // setTimeout(, 2000); 
           url_app = '{{ config('app.url_app') }}';
           url_api = '{{ config('app.url_api') }}';
            $(".departement").hide();
            $(".typeliste").hide();
            $(".scrutin").show();

             
          $("#scrutin").change(function () {
            var scrutin =  $("#scrutin").children("option:selected").val();
            var liste_id =  $("#liste_id").val();
            $("#departement_id").val("");
            $("#type").val("");
            $("#tbody").empty();
            if(scrutin=='majoritaire')
            {
                $(".departement").show();
                $('#departement_id').attr('required', true);
              
            }
            else if(scrutin=='propotionnel' )
            {
                $(".departement").hide();
                $(".typeliste").show();
                $('#departement_id').removeAttr('required');
                if(liste_id)
                {
                    $.ajax({
                        url: url_app+'search/ajax',
                        method: 'POST',
                        data: {
                           _token: '{!! csrf_token() !!}',
                            liste_id: liste_id,
                            scrutin: scrutin,
                            // add more key-value pairs as needed
                        },
                        success: function(response) {
                            console.log(response);
                            var contenu ='';
                            response.forEach(element => {
                                contenu = contenu +"<tr><td>"+element.id+"</td>"+
                                    "<td>"+element.prenom+"</td>"+
                                    "<td>"+element.nom+"</td>"+
                                    "<td>"+element.numelecteur+"</td>"+
                                    "<td>"+element.sexe+"</td>"+
                                    "<td>"+element.profession+"</td>"+
                                     "<td>"+element.datenaiss+"</td>"+
                                     "<td>"+element.lieunaiss+"</td>"+
                                     "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                    "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                               
                                    "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                    "</tr>";
                                    
                            });
                            $("#tbody").empty();
                            $("#tbody").append(contenu);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // handle the error case
                        }
                    });
                }
            
            }
            else
            {
                $(".departement").hide();
                $(".typeliste").hide();
                $('#departement_id').attr('required', true);

            }
          });
       
        $("#type").change(function () {
            $("#tbody").empty();
            var scrutin =  $("#scrutin").children("option:selected").val();
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
            var liste_id =  $("#liste_id").val();
            if(scrutin=='majoritaire' && type && liste_id)
            {
                $.ajax({
                        url: url_app+'search/ajax',
                        method: 'POST',
                        data: {
                           " _token": "{{csrf_token()}}",
                            liste_id: liste_id,
                            scrutin: scrutin,
                            departement_id: departement_id,
                            type: type,
                            // add more key-value pairs as needed
                        },
                        success: function(response) {
                            console.log(response);
                            // do something with the response data
                            var contenu ='';
                            response.forEach(element => {
                                contenu = contenu +"<tr><td>"+element.id+"</td>"+
                                    "<td>"+element.prenom+"</td>"+
                                    "<td>"+element.nom+"</td>"+
                                    "<td>"+element.numelecteur+"</td>"+
                                    "<td>"+element.sexe+"</td>"+
                                    "<td>"+element.profession+"</td>"+
                                     "<td>"+element.datenaiss+"</td>"+
                                     "<td>"+element.lieunaiss+"</td>"+
                                     "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                               
                               "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                    "</tr>";
                                    
                            });
                            $("#tbody").empty();
                            $("#tbody").append(contenu);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // handle the error case
                        }
                    }); 
            }
            else if(scrutin=='propotionnel' && type && liste_id)
            {
                $.ajax({
                        url: url_app+'search/ajax',
                        method: 'POST',
                        data: {
                           " _token": "{{csrf_token()}}",
                            liste_id: liste_id,
                            scrutin: scrutin,
                            type:type,
                            // add more key-value pairs as needed
                        },
                        success: function(response) {
                            console.log(response);
                            // do something with the response data
                            var contenu ='';
                            response.forEach(element => {
                                contenu = contenu +"<tr><td>"+element.id+"</td>"+
                                    "<td>"+element.prenom+"</td>"+
                                    "<td>"+element.nom+"</td>"+
                                    "<td>"+element.numelecteur+"</td>"+
                                    "<td>"+element.sexe+"</td>"+
                                    "<td>"+element.profession+"</td>"+
                                     "<td>"+element.datenaiss+"</td>"+
                                     "<td>"+element.lieunaiss+"</td>"+
                                     "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                    "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                               
                                    "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                    "</tr>";
                                    
                            });
                            $("#tbody").empty();
                            $("#tbody").append(contenu);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // handle the error case
                        }
                    });
            }
            
        });
        $("#departement_id").change(function () {

            var scrutin =  $("#scrutin").children("option:selected").val();
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
            var liste_id =  $("#liste_id").val();
            $("#tbody").empty();
            if(departement_id && liste_id && scrutin)
            {
                $(".typeliste").show();
                $.ajax({
                        url: url_app+'search/ajax',
                        method: 'POST',
                        data: {
                           " _token": "{{csrf_token()}}",
                            liste_id: liste_id,
                            scrutin: scrutin,
                            departement_id: departement_id,
                            // add more key-value pairs as needed
                        },
                        success: function(response) {
                            console.log(response);
                            // do something with the response data
                            var contenu ='';
                            response.forEach(element => {
                                contenu = contenu +"<tr><td>"+element.id+"</td>"+
                                    "<td>"+element.prenom+"</td>"+
                                    "<td>"+element.nom+"</td>"+
                                    "<td>"+element.numelecteur+"</td>"+
                                    "<td>"+element.sexe+"</td>"+
                                    "<td>"+element.profession+"</td>"+
                                     "<td>"+element.datenaiss+"</td>"+
                                     "<td>"+element.lieunaiss+"</td>"+
                                     "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                     "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                               
                                    "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                    "</tr>";
                                    
                            });
                            $("#tbody").empty();
                            $("#tbody").append(contenu);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // handle the error case
                        }
                    });
            }
            else
            {
                $(".typeliste").hide();
            }
        });
    });

          function convertirDate(dateStr) {
    // Séparer la date en jour, mois et année
    const [jour, mois, annee] = dateStr.split('/');

    // Formater la date en "yyyy-mm-jj"
    const dateFormatee = `${annee}-${mois}-${jour}`;
    return dateFormatee;
}


       
    </script>
@endsection

