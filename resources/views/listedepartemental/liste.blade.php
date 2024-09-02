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
                   {{--  <div class="col-lg-3">
                        <label> Scrutin</label>
                        <select class="form-control" id="scrutin" name="scrutin" required="">
                            <option value="">Selectionner</option>
                            <option value="majoritaire" {{old('scrutin') == 'majoritaire' ? 'selected' : '' }}>Majoritaire</option>
                            <option value="propotionnel" {{old('scrutin') == 'propotionnel' ? 'selected' : '' }}>Propotionnel</option>
                        </select>
                    </div> --}}
                    <input type="hidden" value="majoritaire" id="scrutin" name="scrutin">

                    <div class="col-lg-3 departement">
                        <label>Departement</label>
                        <select class="form-control" name="departement_id"  id="departement_id">
                            <option value="">Selectionner</option>
                            @foreach ($departements as $departement)
                            <option value="{{$departement->id}}"  {{old('departement_id') == $departement->id ? 'selected' : '' }}>{{$departement->nom}}</option>
                                @endforeach
    
                        </select>
                    </div>
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
    {{-- <div id="defaut">
             
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
                                    <td>{{ $titulaire['data']->ordre }}</td>
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
                        <td>{{ $supleant['data']->sexe }}</td>
                        <td>{{ $supleant['data']->profession }}</td>
                        <td>{{ $supleant['data']->datenaiss }}</td>
                        <td>{{ $supleant['data']->lieunaiss }}</td>
                        <td class="text-danger">{{ $supleant['data']->erreur }}</td>
                        <td> <a href="{{ route('declaration',["id"=> $supleant['data']->id,'type'=>'majoritaire']) }}" role="button" class="btn btn-warning"><i class="fas fa-file"></i></a>
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
    </div> --}}
    @foreach ($tabCandidats as $item)
    @if($item["titulaire"] > 0 || $item["suppleant"] > 0 )
    <h4 class="page-title">{{$item["departement"]}}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10">
                                <h5 class="mt-0">{{ $item["titulaire"]}}</h5>
                                <p class="mb-0 text-muted">Liste Titulaire </p> {{--<span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>--}}
                            </div>
                        </div>                                                                                          
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="search-type-arrow"></div>
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round ">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$item["suppleant"] }}</h5>
                                <p class="mb-0 text-muted">Liste Suppleant</p>
                            </div>
                        </div>                                                                
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="search-type-arrow"></div>
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round ">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$item["suppleant"] + $item["titulaire"]}}</h5>
                                <p class="mb-0 text-muted">Total</p>
                            </div>
                        </div>                                                                
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div>

    @endif
@endforeach

@endsection
@section('script')
    <script>
      url = "http://5.189.166.92/legistlatif/public/";
      //url = "http://127.0.0.1:8000/";
      urlSearch = "http://5.189.166.92/legistlatif/public/search/ajax";
       // urlSearch = "http://127.0.0.1:8000/search/ajax";
      liste_id = {{Auth::user()->liste_id}}

          $(document).ready(function () {
           
           // setTimeout(, 2000); 
           /*  $(".departement").hide();
            $(".typeliste").hide();
            $("#search").hide(); */
            
            scrutin = '{{old('scrutin')}}'; 
        
           
    
        });
         
          $("#type").change(function () {
           
            var scrutin =  $("#scrutin").val();
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
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

          function convertirDate(dateStr) {
            // Séparer la date en jour, mois et année
            const [jour, mois, annee] = dateStr.split('/');

            // Formater la date en "yyyy-mm-jj"
            const dateFormatee = `${annee}-${mois}-${jour}`;
            return dateFormatee;
        }


        $("#departement_id").change(function () {
            var departement_id =  $("#departement_id").children("option:selected").val();
            var scrutin =  $("#scrutin").val();
            var type =  $("#type").children("option:selected").val();
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
                                // add more key-value pairs as needed
                            },
                            success: function(response) {
                                console.log(response);
                                // do something with the response data
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
            
            }
            
        });
    </script>
@endsection

