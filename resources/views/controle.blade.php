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
            <h4 class="page-title"> {{$liste->nom }} :   @if ($liste->verif==0)
                <span class="badge badge-boxed  badge-info"> Non verifier</span>
                @elseif($liste->etat==0)
                <span class="badge badge-boxed  badge-danger"> Rejeter </span> Commentaire : {{$liste->commentaire}}
                @else
                <span class="badge badge-boxed  badge-success"> Valider</span>
                @endif </h4>
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
       {{--  <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <label> Scrutin</label>
                        <select class="form-control" id="scrutin" name="scrutin" required="">
                            <option value="">Selectionner</option>
                            <option value="majoritaire" {{old('scrutin') == 'majoritaire' ? 'selected' : '' }}>Majoritaire</option>
                            <option value="propotionnel" {{old('scrutin') == 'propotionnel' ? 'selected' : '' }}>Propotionnel</option>
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
                    <div class="col-lg-3 departement">
                        <label>Departement</label>
                        <select class="form-control" name="departement_id"  id="departement_id">
                            <option value="">Selectionner</option>
                            @foreach ($departements as $departement)
                            <option value="{{$departement->id}}"  {{old('departement_id') == $departement->id ? 'selected' : '' }}>{{$departement->nom}}</option>
                                @endforeach

                        </select>
                    </div>
                </div>

                <div id="search">
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
        </div> --}}
    </div>
    <div id="defaut">
        <a href="{{ route('controle.liste', ["id"=>$liste->id,"type"=>2]) }}" role="button" class="btn btn-warning"><i class="fas fa-eye"></i> Voir Tous </a>
        <a href="{{ route('controle.fichier', $id) }}" role="button" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Imprimer </a>
        <a href="{{ route('valider.liste',["id"=>$id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i> Valider la liste</a>
        <a href="" data-toggle="modal" data-target="#liste{{$id}}" role="button" class="btn btn-danger"><i class="fas fa-ban"></i> Rejeter la liste</a>

        <div id="liste{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">about:blank#blocked
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Rejet Liste : {{$liste->nom}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route('rejeter.liste') }}" method="POST" >
                    @csrf
                <div class="modal-body">

                        <input type="hidden" value="{{$id}}" name="id">
                    <div class="form-group">
                        <label>Commentaire </label>
                        <textarea type="text" name="commentaire"  class="form-control"  required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fermer</button>
                    <button type="Submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                </div>
            </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
                                    <th>Etat</th>
                                    <th>Commentaire</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listenationalTitulaire as $listenational)
                                @if($listenational->type=='titulaire' && $listenational->verif==0)
                                    <tr>
                                        <td>{{ $listenational->ordre }}</td>
                                        <td>{{ $listenational->prenom }}</td>
                                        <td>{{ $listenational->nom }}</td>
                                        <td>{{ $listenational->numelecteur }}</td>
                                        <td>{{ $listenational->sexe }}</td>
                                        <td>{{ $listenational->profession }}</td>
                                        <td>{{ date('d-m-Y', strtotime($listenational->datenaiss)) }}</td>
                                        <td>{{ $listenational->lieunaiss }}</td>
                                        <td class="text-danger">{{ $listenational->erreur }} <br>{{ $listenational->parite }}<br>{{ $listenational->doublon_interne }}</td>
                                            <td> <a href="{{ route('valider.national',["id"=>$listenational->id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i></a>
                                                <a href="{{ route('listenational.edit', $listenational->id) }}" data-toggle="modal" data-target="#listenational{{$listenational->id}}" role="button" class="btn btn-danger"><i class="fas fa-ban"></i></a>

                                                  <!-- sample modal content -->
                                     <div id="listenational{{$listenational->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="myModalLabel">Controle : {{ $listenational->prenom }} {{ $listenational->nom }} {{ $listenational->numelecteur }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form action="{{ route('rejeter.national') }}" method="POST" >
                                                    @csrf
                                                <div class="modal-body">

                                                        <input type="hidden" value="{{$listenational->id}}" name="id">
                                                    <div class="form-group">
                                                        <label>Commentaire </label>
                                                        <textarea type="text" name="commentaire"  class="form-control"  required></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fermer</button>
                                                    <button type="Submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                                                </div>
                                            </form>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                            </td>
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

                                    <th>Etat</th>
                                    <th>Commentaire</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($listenationalSuppleant as $listenational)
                                @if($listenational->type=='supleant' && $listenational->verif==0)
                                    <tr>
                                        <td>{{ $listenational->ordre }}</td>
                                        <td>{{ $listenational->prenom }}</td>
                                        <td>{{ $listenational->nom }}</td>
                                        <td>{{ $listenational->numelecteur }}</td>
                                        <td>{{ $listenational->sexe }}</td>

                                        <td>{{ date('d-m-Y', strtotime($listenational->datenaiss)) }}<td>
                                        <td>{{ $listenational->lieunaiss }}</td>
                                        <td class="text-danger">{{ $listenational->erreur }}<br>{{ $listenational->parite }}<br>{{ $listenational->doublon_interne }}</td>
                                    <td> <a href="{{ route('valider.national',["id"=>$listenational->id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i></a>
                                        <button href="" role="button" class="btn btn-danger" data-toggle="modal" data-target="#listenationals{{$listenational->id}}"><i class="fas fa-ban"></i></button>
                                        </a>
                                                     <!-- sample modal content -->
                                     <div id="listenationals{{$listenational->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="myModalLabel">Controle : Controle : {{ $listenational->prenom }} {{ $listenational->nom }} {{ $listenational->numelecteur }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form action="{{ route('rejeter.national') }}" method="POST" >
                                                    @csrf
                                                <div class="modal-body">

                                                        <input type="hidden" value="{{$listenational->id}}" name="id">
                                                    <div class="form-group">
                                                        <label>Commentaire </label>
                                                        <textarea type="text" name="commentaire"  class="form-control"  required></textarea>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fermer</button>
                                                    <button type="Submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                                                </div>
                                            </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    </td>
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
                            <th>Etat</th>
                            <th>Commentaire</th>


                        </tr>
                    </thead>
                    <tbody>


                        @foreach($categories['titulaire'] as $titulaire)
                            @if( $titulaire['data']->verif==0)
                                <tr>
                                    <td>{{ $titulaire['data']->ordre }}</td>
                                    <td>{{ $titulaire['data']->prenom }}</td>
                                    <td>{{ $titulaire['data']->nom }}</td>
                                    <td>{{ $titulaire['data']->numelecteur }}</td>
                                    <td>{{ $titulaire['data']->sexe }}</td>
                                    <td>{{ $titulaire['data']->profession }}</td>
                                    <td>{{ date('d-m-Y', strtotime($titulaire['data']->datenaiss)) }}</td>
                                    <td>{{ $titulaire['data']->lieunaiss }}</td>
                                    <td class="text-danger">{{ $titulaire['data']->erreur }} <br>{{ $titulaire['data']->parite }}<br> {{ $titulaire['data']->doublon_interne }}</td>
                                    <td> <a href="{{ route('valider.departemental',["id"=>$titulaire['data']->id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i></a>
                                        <button href="{{ route('listedepartemental.edit', $titulaire['data']->id) }}" role="button" class="btn btn-danger" data-toggle="modal" data-target="#listedepartemental{{ $titulaire['data']->id}}"><i class="fas fa-ban"></i></button>
                                        <div id="listedepartemental{{ $titulaire['data']->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Controle : {{ $titulaire['data']->prenom }} {{ $titulaire['data']->nom }} {{ $titulaire['data']->numelecteur }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <form action="{{ route('rejeter.departemental') }}" method="POST" >
                                                        @csrf
                                                    <div class="modal-body">

                                                            <input type="hidden" value="{{$titulaire['data']->id}}" name="id">
                                                        <div class="form-group">
                                                            <label>Commentaire </label>
                                                            <textarea type="text" name="commentaire"  class="form-control"  required></textarea>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fermer</button>
                                                        <button type="Submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                                                    </div>
                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                    <td>
                                        @if ($titulaire['data']->verif==0)
                                            <span class="badge badge-boxed  badge-info"> Non verifier</span>
                                        @elseif($titulaire['data']->etat==0)
                                        <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                        @else
                                        <span class="badge badge-boxed  badge-success"> Valider</span>
                                        @endif
                                     </td>
                                     <td>{{$titulaire['data']->commentaire}}</td>
                                </tr>
                            @endif
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
                <th>Etat</th>
                <th>Commentaire</th>

            </tr>
            </thead>
            <tbody>


            @foreach($categories['supleant'] as $supleant)

            @if( $supleant['data']->verif==0)
                    <tr>
                        <td>{{ $supleant['data']->ordre }}</td>
                        <td>{{ $supleant['data']->prenom }}</td>
                        <td>{{ $supleant['data']->nom }}</td>
                        <td>{{ $supleant['data']->numelecteur }}</td>
                        <td>{{ $supleant['data']->sexe }}</td>
                        <td>{{ $supleant['data']->profession }}</td>
                        <td>{{ date('d-m-Y', strtotime($supleant['data']->datenaiss)) }}</td>
                        <td>{{ $supleant['data']->lieunaiss }}</td>
                        <td class="text-danger">{{ $supleant['data']->erreur }} <br>{{ $supleant['data']->parite }}<br> {{ $supleant['data']->doublon_interne }}</td>
                        <td><a href="{{ route('valider.departemental',["id"=>$supleant['data']->id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i></a>
                            <button role="button" class="btn btn-danger" data-toggle="modal" data-target="#listedepartemental{{ $supleant['data']->id}}"><i class="fas fa-ban"></i></button>
                            <div id="listedepartemental{{ $supleant['data']->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel">Controle : {{ $supleant['data']->prenom }} {{ $supleant['data']->nom }} {{ $supleant['data']->numelecteur }}
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <form action="{{ route('rejeter.departemental') }}" method="POST" >
                                            @csrf
                                        <div class="modal-body">

                                                <input type="hidden" value="{{$supleant['data']->id}}" name="id">
                                            <div class="form-group">
                                                <label>Commentaire  </label>
                                                <textarea type="text" name="commentaire"  class="form-control"  required></textarea>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fermer</button>
                                            <button type="Submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                                        </div>
                                    </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                     <td>   @if ($supleant['data']->verif==0)
                        <span class="badge badge-boxed  badge-info"> Non verifier</span>
                        @elseif($supleant['data']->etat==0)
                        <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                        @else
                        <span class="badge badge-boxed  badge-success"> Valider</span>
                        @endif </td>
                        <td>{{$supleant['data']->commentaire}}</td>
                    </tr>
                @endif
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
    </div>


@endsection
{{-- @section('script')
    <script>
     //url = "http://5.189.166.92/legistlatif/public/";
    //  url = "http://127.0.0.1:8000/";
      //urlSearch = "http://5.189.166.92/legistlatif/public/search/ajax";
       // urlSearch = "http://127.0.0.1:8000/search/ajax";
      liste_id = {{$id}}
      url_app = '{{ config('app.url_app') }}';
      url_api = '{{ config('app.url_api') }}';
          $(document).ready(function () {

           // setTimeout(, 2000);
            $(".departement").hide();
            $(".typeliste").hide();
            $("#search").hide();

            scrutin = '{{old('scrutin')}}';

            if(scrutin == "majoritaire")
            {
                $(".departement").show();
                $(".typeliste").show();
            }
            if(scrutin == "propotionnel")
            {
                $(".typeliste").show();
            }

        });
          $("#scrutin").change(function () {
            var scrutin =  $("#scrutin").children("option:selected").val();
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
                    url: url_app+'search/ajax',
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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

            if(scrutin=='majoritaire')
            {
                $(".typeliste").show();
                $(".departement").show();
                $('#departement_id').attr('required', true);
            }
            else if(scrutin=='propotionnel')
            {
                $(".departement").hide();
                $(".typeliste").show();
                $('#departement_id').removeAttr('required');
            }
            else
            {
                $(".departement").hide();
                $(".typeliste").hide();
                $('#departement_id').attr('required', true);

            }
          });
          $("#type").change(function () {

            var scrutin =  $("#scrutin").children("option:selected").val();
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
            var scrutin =  $("#scrutin").children("option:selected").val();
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
                                "<td>"+formatDate(element.datenaiss)+"</td>"+
                                "<td>"+element.lieunaiss+"</td>"+
                                "<td>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-success'><i class='fas fa-check'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>"+
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
 --}}
