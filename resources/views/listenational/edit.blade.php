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
                        <li class="breadcrumb-item active"><a href="{{ route('listenational.index') }}" >RETOUR</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        {!! Form::model($listenational, ['method'=>'PATCH','route'=>['listenational.update', $listenational->id],"enctype"=>"multipart/form-data"]) !!}
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
                                   {{--  <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Ordre </label> --}}
                                            <input type="hidden" name="ordre"  value="{{ $listenational->ordre }}" class="form-control"  required>
                                    {{--    </ div>
                                    </div> --}}
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro CNI </label>
                                            <input type="number" name="numcni" id="cni"  value="{{$listenational->numcni }}" class="form-control"  required>
                                            <span class="input-group-append">
                                                <button type="button" id="btncni" class="btn  btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Elecetur </label>
                                            <input type="number" name="numelecteur" id="numelecteur"  value="{{$listenational->numelecteur }}" class="form-control"  required>
                                        </div>
                                    </div>
                                  
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Prenom </label>
                                            <input type="text" name="prenom" id="prenom" value="{{$listenational->prenom }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom" id="nom"  value="{{$listenational->nom }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Sexe </label>
                                            <select class="form-control" id="sexe" name="sexe" required="">
                                                <option value="">Selectionner</option>
                                                <option value="M" {{$listenational->sexe=="M" ? 'selected' : ''}}>Homme</option>
                                                <option value="F" {{$listenational->sexe=="F" ? 'selected' : ''}}>Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Profession </label>
                                            <input type="text" name="profession"  value="{{$listenational->profession }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Date de naissance </label>
                                            <input type="date" name="datenaiss" id="datenaiss"  value="{{$listenational->datenaiss }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Lieu de naissance  </label>
                                            <input type="text" name="lieunaiss" id="lieunaiss   "  value="{{$listenational->lieunaiss }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3" style="display: none;">
                                        <div class="form-group">
                                            <label>Type Liste </label>
                                            <select class="form-control" name="type" required="">
                                                <option value="">Selectionner</option>
                                                <option value="titulaire" {{$listenational->type=="titulaire" ? 'selected' : ''}}>titulaire</option>
                                                <option value="supleant" {{$listenational->type=="supleant" ? 'selected' : ''}}>supleant</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                        
                                        <div class="col-lg-3" style="display: none;">
                                            <label> Liste</label>
                                            <select class="form-control" name="liste_id" required="">
                                                <option value="">Selectionner</option>
                                                @foreach ($listes as $liste)
                                                <option value="{{$liste->id}}" {{$listenational->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                                    @endforeach

                                            </select>
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
           //alert("ibra");
           // setTimeout(, 2000); 

            $("#btncni").click(function () {
                var cni = $("#cni").val();
                $.blockUI({ message: "<p>Patienter</p>" }); 
                $.ajax({
            type:'GET',
            //url:'http://127.0.0.1:7777/api/cartes/get/by/nin?nin='+cni,
            url: 'http://5.189.166.92:7777/api/cartes/get/by/nin?nin='+cni,
          
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data) {
                setTimeout($.unblockUI, 1); 
                console.log(data,data.length);
                if(data.length >=1)
                {
                    console.log(data[0].ELEC_PRENOM)
                    $("#prenom").val(data[0].ELEC_PRENOM)
                    $("#nom").val(data[0].ELEC_NOM)
                    $("#sexe").val(data[0].ELEC_SEXE)
                    $("#datenaiss").val(convertirDate(data[0].ELEC_DATE_NAISSANCE))
                    $("#numelecteur").val(data[0].ELEC_NUM_ELECTEUR)
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
            setTimeout($.unblockUI, 1); 
        });
</script>
    
@endsection
