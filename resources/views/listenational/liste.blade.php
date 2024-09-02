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
            <h4 class="page-title">{{Auth::user()->liste->nom}}</h4>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                  {{--   <div class="col-lg-3">
                        <label> Scrutin</label>
                        <select class="form-control" id="scrutin" name="scrutin" required="">
                            <option value="">Selectionner</option>
                             <option value="majoritaire" {{old('scrutin') == 'majoritaire' ? 'selected' : '' }}>Majoritaire</option> 
                            <option value="propotionnel" {{old('scrutin') == 'propotionnel' ? 'selected' : '' }}>Propotionnel</option>
                        </select>
                    </div> --}}
                    <input type="hidden" value="propotionnel" id="scrutin" name="scrutin">
                    <div class="col-lg-3 typeliste" >
                        <div class="form-group">
                            <label>Type Liste </label>
                            <select class="form-control" id="type" name="type" required="">
                                <option value="">Selectionner</option>
                                <option value="titulaire" {{old('type') == 'titulaire' ? 'selected' : '' }}>titulaire</option>
                                <option value="supleant"  {{old('type') == 'supleant' ? 'selected' : ''}}>supleant</option>
                            </select>
                        </div>
                    </div>
                  
                </div>
               
                <div id="search">
                    <h3>Liste Titulaire</h3>
                    <table  class="table table-bordered table-responsive-md table-striped text-center">
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
                        
            
                        </tbody>
                    </table>
                    <h3>Liste Suppleant</h3>
                    <table  class="table table-bordered table-responsive-md table-striped text-center">
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
                        <tbody id="tbodys">
                        
            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="defaut">
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
                                            <td> <a href="{{ route('declaration',["id"=>$listenational->id,'type'=>'propotionnel']) }}" role="button" class="btn btn-warning"><i class="fas fa-file"></i></a>
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
      
    </div>
    

@endsection
@section('script')
    <script>
    url = "http://5.189.166.92/legistlatif/public/";
      //url = "http://127.0.0.1:8000/";
      urlSearch = "http://5.189.166.92/legistlatif/public/search/ajax";
        //urlSearch = "http://127.0.0.1:8000/search/ajax";
      liste_id = {{Auth::user()->liste_id}}

          $(document).ready(function () {
           
           // setTimeout(, 2000); 
          /*   $(".departement").hide();
            $(".typeliste").hide();
            $("#search").hide(); */
            $("#search").hide();
            scrutin = '{{old('scrutin')}}'; 
        
    
        });
          $("#scrutin").change(function () {
            var scrutin =  $("#scrutin").val();
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
            $("#scrutinf").val(scrutin);
            $("#typef").val(type);
            $("#departement_idf").val(departement_id);
            $("#tbody").empty();
            $("#search").show();
            $("#defaut").hide();
         if(scrutin=='propotionnel')
            {
                    
                $.ajax({
                    url: urlSearch,
                    method: 'POST',
                    data: {
                    _token: '{!! csrf_token() !!}',
                        liste_id: liste_id,
                        scrutin: scrutin,
                       type : type
                        // add more key-value pairs as needed
                    },
                    success: function(response) {
                        console.log(response);
                        var contenut ='';
                        var contenus ='';
                        response.forEach(element => {
                            if(element.type=="titulaire")
                            {
                                contenut = contenut +"<tr><td>"+element.ordre+"</td>"+
                                "<td>"+element.prenom+"</td>"+
                                "<td>"+element.nom+"</td>"+
                                "<td>"+element.numelecteur+"</td>"+
                                "<td>"+element.sexe+"</td>"+
                                "<td>"+element.profession+"</td>"+
                                "<td>"+element.datenaiss+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"</td>"+
                                "<td> <a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                "</tr>";
                            }
                            else
                            {
                                contenus = contenus +"<tr><td>"+element.ordre+"</td>"+
                                "<td>"+element.prenom+"</td>"+
                                "<td>"+element.nom+"</td>"+
                                "<td>"+element.numelecteur+"</td>"+
                                "<td>"+element.sexe+"</td>"+
                                "<td>"+element.profession+"</td>"+
                                "<td>"+element.datenaiss+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"</td>"+
                                "<td> <a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                "</tr>";
                            }       
                        });
                        $("#tbody").append(contenut);
                        $("#tbodys").append(contenus);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        // handle the error case
                    }
                });
            }
               
          
          });
          $("#type").change(function () {
           
            var scrutin =  $("#scrutin").val();
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
            $("#search").show();
            $("#defaut").hide();
            $("#tbody").empty();
            $("#tbodys").empty();
            if(scrutin )
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        
                   
                $.ajax({
                        url: urlSearch,
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
                            var contenut ='';
                        var contenus ='';
                        response.forEach(element => {
                            if(element.type=="titulaire")
                            {
                                contenut = contenut +"<tr><td>"+element.ordre+"</td>"+
                                "<td>"+element.prenom+"</td>"+
                                "<td>"+element.nom+"</td>"+
                                "<td>"+element.numelecteur+"</td>"+
                                "<td>"+element.sexe+"</td>"+
                                "<td>"+element.profession+"</td>"+
                                "<td>"+element.datenaiss+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"</td>"+
                                "<td> <a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                "</tr>";
                            }
                            else
                            {
                                contenus = contenus +"<tr><td>"+element.ordre+"</td>"+
                                "<td>"+element.prenom+"</td>"+
                                "<td>"+element.nom+"</td>"+
                                "<td>"+element.numelecteur+"</td>"+
                                "<td>"+element.sexe+"</td>"+
                                "<td>"+element.profession+"</td>"+
                                "<td>"+element.datenaiss+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"</td>"+
                                "<td> <a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                "</tr>";
                            }       
                        });
                        $("#tbody").append(contenut);
                        $("#tbodys").append(contenus);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // handle the error case
                        }
                    }); 
                    }
                }
                else if(scrutin=='propotionnel')
                {
                   
                $.ajax({
                        url: urlSearch,
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
                            var contenut ='';
                        var contenus ='';
                        response.forEach(element => {
                            if(element.type=="titulaire")
                            {
                                contenut = contenut +"<tr><td>"+element.ordre+"</td>"+
                                "<td>"+element.prenom+"</td>"+
                                "<td>"+element.nom+"</td>"+
                                "<td>"+element.numelecteur+"</td>"+
                                "<td>"+element.sexe+"</td>"+
                                "<td>"+element.profession+"</td>"+
                                "<td>"+element.datenaiss+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"</td>"+
                                "<td> <a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                "</tr>";
                            }
                            else
                            {
                                contenus = contenus +"<tr><td>"+element.ordre+"</td>"+
                                "<td>"+element.prenom+"</td>"+
                                "<td>"+element.nom+"</td>"+
                                "<td>"+element.numelecteur+"</td>"+
                                "<td>"+element.sexe+"</td>"+
                                "<td>"+element.profession+"</td>"+
                                "<td>"+element.datenaiss+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"</td>"+
                                "<td> <a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='http://5.189.166.92/legistlatif/public/listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
                                "</tr>";
                            }       
                        });
                        $("#tbody").append(contenut);
                        $("#tbodys").append(contenus);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // handle the error case
                        }
                    });
                }
            }
          });

    </script>
@endsection

