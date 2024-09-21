{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('listedepartemental.index') }}" >RETOUR</a></li>

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

        {!! Form::model($listedepartemental, ['method'=>'PATCH','route'=>['listedepartemental.update', $listedepartemental->id],"enctype"=>"multipart/form-data"]) !!}
            @csrf
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION Département</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                <div class="col-lg-3">
                                    <input type="hidden" id="commune" name="commune" value="{{$listedepartemental->commune }}">
                                    <div class="form-group">
                                        <label>Numéro CNI </label>
                                        <input type="text" name="numcni" id="cni"  value="{{$listedepartemental->numcni }}" class="form-control"  required>
                                        <span class="input-group-append">
                                            <button type="button" id="btncni" class="btn  btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Numéro Electeur </label>
                                        <input type="number" name="numelecteur" id="numelecteur"  value="{{$listedepartemental->numelecteur }}" class="form-control" min="1" required>
                                        <span class="input-group-append">
                                            <button type="button" id="btnnumelec" class="btn  btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                            </span>
                                    </div>
                                </div>
                               
                              {{--   <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Ordre </label> --}}
                                            <input type="hidden" name="ordre"  value="{{ $listedepartemental->ordre }}" class="form-control"  required>
                                        {{-- </div>
                                    </div> --}}
                               
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Prenom </label>
                                        <input type="text" name="prenom" id="prenom" value="{{$listedepartemental->prenom }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Nom </label>
                                        <input type="text" name="nom" id="nom" value="{{$listedepartemental->nom }}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Sexe </label>
                                        <select class="form-control" name="sexe" id="sexe" required="">
                                            <option value="Selectionner"></option>
                                            <option value="M" {{$listedepartemental->sexe=="M" ? 'selected' : ''}}>Homme</option>
                                            <option value="F" {{$listedepartemental->sexe=="F" ? 'selected' : ''}}>Femme</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Profession </label>
                                        <input type="text" name="profession" id="profession"  value="{{$listedepartemental->profession }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Date de naissance </label>
                                        <input type="date" name="datenaiss" id="datenaiss"  value="{{$listedepartemental->datenaiss }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Lieu de naissance  </label>
                                        <input type="text" name="lieunaiss" id="lieunaiss" value="{{$listedepartemental->lieunaiss }}" class="form-control" min="1" required>
                                    </div>
                                </div>
                               
                                <div class="col-lg-3" style="display: none;">
                                    <div class="form-group">
                                        <label>Type Liste </label>
                                        <select class="form-control" name="type" required="">
                                            <option value="">Selectionner</option>
                                            <option value="titulaire" {{$listedepartemental->type=="titulaire" ? 'selected' : ''}}>titulaire</option>
                                            <option value="supleant" {{$listedepartemental->type=="supleant" ? 'selected' : ''}}>supleant</option>
                                        </select>
                                    </div>
                                </div>
                               
                                    <div class="col-lg-3">
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id" required="">
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}" {{$listedepartemental->departement_id==$departement->id ? 'selected' : ''}}>{{$departement->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-3" style="display: none;">
                                        <label> Liste</label>
                                        <select class="form-control" name="liste_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($listes as $liste)
                                            <option value="{{$liste->id}}" {{$listedepartemental->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                  {{--   <div style="display: none;">
                                        <label> Liste</label>
                                        <select class="form-control"  name="liste" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($listes as $liste)
                                            <option value="{{$liste->nom}}" {{Auth::user()->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                                @endforeach
    
                                        </select>
                                       </div> --}}
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Domicile </label>
                                            <input type="text" name="domicile"   value="{{ $listedepartemental->domicile }}" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Service, Emploi et lieu d’affectation pour les agents de l’Etat </label>
                                            <input type="text" name="se"   value="{{ $listedepartemental->se }}" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Une extrait d’acte de naissance datant de moins de six (06) mois ou la photocopie légalisée de la carte d’identité biométrique CEDEAO </label>
                                            <input type="file" name="extrait_ou_cnis"  value="{{ old('extrait_ou_cni') }}" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>bulletin n°3 du casier judiciaire datant de moins de trois mois</label>
                                            <input type="file" name="casiers"  value="{{ old('casier') }}" class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> MODIFIER</button>
                                    </center>
                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection

@section('script')

<script>

$(document).ready(function () {
           
           // setTimeout(, 2000); 
           url_app = '{{ config('app.url_app') }}';
           url_api = '{{ config('app.url_api') }}';
          
            $("#btncni").click(function () {
                var cni = $("#cni").val();
                $.blockUI({ message: "<p>Patienter</p>" }); 
                $.ajax({
            type:'GET',
          // url:'http://127.0.0.1:7777/api/cartes/get/by/nin?nin='+cni,
            url: url_api+'cartes/get/by/nin?nin='+cni,
          
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data) {
                console.log(data,data.length);
                setTimeout($.unblockUI, 1);
                if(data.length >=1)
                {
                    console.log(data[0].ELEC_PRENOM)
                    $("#prenom").val(data[0].ELEC_PRENOM)
                    $("#nom").val(data[0].ELEC_NOM)
                    $("#sexe").val(data[0].ELEC_SEXE)
                    $("#datenaiss").val(convertirDate(data[0].ELEC_DATE_NAISSANCE))
                    $("#numelecteur").val(data[0].ELEC_NUM_ELECTEUR)
                    $("#commune").val(data[0].COMMUNE)
                }
                else
                {
                    alert("CNI non trouve");
                }
                
            },
            error:function(){
                setTimeout($.unblockUI, 1); 
            }
        });
            });
            $("#btnnumelec").click(function () {
                var numelecteur = $("#numelecteur").val();
                $.blockUI({ message: "<p>Patienter</p>" }); 
                $.ajax({
            type:'GET',
          // url:'http://127.0.0.1:7777/api/cartes/get/by/numelec?numelec='+numelecteur,
           url: url_api+'cartes/get/by/numelec?numelec='+numelecteur,
          
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data) {
                console.log(data,data.length);
                if(data.length >=1)
                {
                    console.log(data[0].ELEC_PRENOM)
                    $("#prenom").val(data[0].ELEC_PRENOM)
                    $("#nom").val(data[0].ELEC_NOM)
                    $("#sexe").val(data[0].ELEC_SEXE)
                    $("#datenaiss").val(convertirDate(data[0].ELEC_DATE_NAISSANCE))
                    $("#cni").val(data[0].NIN)
                    $("#commune").val(data[0].COMMUNE)
                }
                else
                {
                    alert("CNI non trouve");
                }
                setTimeout($.unblockUI, 1); 
            },
            error:function(){
                setTimeout($.unblockUI, 1); 
            }
        });
            });
            setTimeout($.unblockUI, 1); 
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
