{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('listedepartemental.index') }}" >LISTE D'ENREGISTREMENT DES listedepartementals</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('listedepartemental.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="card">
                        <div class="card-header  text-center">FORMULAIRE D'ENREGISTREMENT D'UN Département</div>
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
                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                                <div class="row">

                                    <div class="col-lg-3">
                                        <label> Scrutin</label>
                                        <select class="form-control" id="scrutin" name="scrutin" required="">
                                            <option value="">Selectionner</option>
                                            <option value="majoritaire">Majoritaire</option>
                                            <option value="propotionnel">Propotionnel</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 typeliste" >
                                        <div class="form-group">
                                            <label>Type Liste </label>
                                            <select class="form-control" name="type" required="">
                                                <option value="">Selectionner</option>
                                                <option value="titulaire">titulaire</option>
                                                <option value="supleant">supleant</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 departement">
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id" required="">
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}">{{$departement->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Elecetur </label>
                                            <input type="number" name="numelecteur" id="numelecteur" value="{{ old('numelecteur') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        
                                        <div class="form-group ">
                                            <label>Numéro CNI </label>
                                            <input type="number" name="numcni" id="cni" value="{{ old('numcni') }}" class="form-control"  required>
                                            <span class="input-group-append">
                                                <button type="button" id="btncni" class="btn  btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Ordre </label>
                                            <input type="number" name="ordre"  value="{{ old('ordre') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Prenom </label>
                                            <input type="text" name="prenom" id="prenom"  value="{{ old('prenom') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom" id="nom"  value="{{ old('nom') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Sexe </label>
                                            <select class="form-control" name="sexe" id="sexe" required="">
                                                <option value="">Selectionner</option>
                                                <option value="M">Homme</option>
                                                <option value="F">Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Profession </label>
                                            <input type="text" name="profession"   value="{{ old('profession') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Date de naissance </label>
                                            <input type="date" name="datenaiss" id="datenaiss"  value="{{ old('datenaiss') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Lieu de naissance  </label>
                                            <input type="text" name="lieunaiss" id="lieunaiss"  value="{{ old('lieunaiss') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                   
                                   
                                        <div class="col-lg-3">
                                            <label> Liste</label>
                                            <select class="form-control" id="liste_id" name="liste_id" required="">
                                                <option value="">Selectionner</option>
                                                @foreach ($listes as $liste)
                                                <option value="{{$liste->id}}" {{Auth::user()->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Domicile </label>
                                                <input type="text" name="domicile"   value="{{ old('domicile') }}" class="form-control"  >
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Service, Emploi et lieu d’affectation pour les agents de l’Etat </label>
                                                <input type="text" name="se"   value="{{ old('se') }}" class="form-control"  >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Une extrait d’acte de naissance datant de moins de six (06) mois ou la photocopie légalisée de la carte d’identité biométrique CEDEAO </label>
                                                <input type="file" name="extrait_ou_cnis"   class="form-control"  >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>bulletin n°3 du casier judiciaire datant de moins de trois mois</label>
                                                <input type="file" name="casiers"  class="form-control"  >
                                            </div>
                                        </div>
                                    </div>

                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> ENREGISTRER</button>
                                    </center>
                                </div>
                            </div>

                            </div>

            </form>

@endsection
@section('script')
    <script>
          $(document).ready(function () {
           
           // setTimeout(, 2000); 
            $(".departement").hide();
            $(".typeliste").hide();
            $("#btncni").click(function () {
                var cni = $("#cni").val();
                $.blockUI({ message: "<p>Patienter</p>" }); 
                $.ajax({
            type:'GET',
            url:'http://127.0.0.1:7777/api/cartes/get/by/nin?nin='+cni,
          
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
                    $("#numelecteur").val(data[0].ELEC_NUM_ELECTEUR)
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
          $("#scrutin").change(function () {
            var scrutin =  $("#scrutin").children("option:selected").val();
            if(scrutin=='majoritaire')
            {
                $(".typeliste").show();
                $(".departement").show();
            }
            else if(scrutin=='propotionnel')
            {
                $(".departement").hide();
                $(".typeliste").show();
            }
            else
            {
                $(".departement").hide();
                $(".typeliste").hide();
            }
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

