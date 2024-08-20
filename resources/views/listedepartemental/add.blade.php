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
                        <div class="card-header  text-center"> <span id="sexeSaisir"></span>  &nbsp;&nbsp; Ordre à saisir <h4 id="numero"></h4></div>
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
                            <div  id="full-message">
                              
                            </div>
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
                                            <select class="form-control" id="type" name="type" required="">
                                                <option value="">Selectionner</option>
                                                <option value="titulaire">titulaire</option>
                                                <option value="supleant">supleant</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 departement">
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id"  id="departement_id">
                                            <option value="">Selectionner</option>
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}">{{$departement->nom}}</option>
                                                @endforeach

                                        </select>
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
                                            <label>Numéro Elecetur </label>
                                            <input type="number" name="numelecteur" id="numelecteur" value="{{ old('numelecteur') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                   
                                   {{--  <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Ordre </label>
                                            <input type="number" name="ordre"  value="{{ old('ordre') }}" class="form-control"  required>
                                        </div>
                                    </div> --}}
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
                                   
                                   @if (Auth::user()->role=='admin')
                                    <div class="col-lg-3">
                                        <label> Liste</label>
                                        <select class="form-control" id="liste_id" name="liste_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($listes as $liste)
                                            <option value="{{$liste->id}}" {{Auth::user()->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                   @endif
                                   <div style="display: none;">
                                    <label> Liste</label>
                                    <select class="form-control"  name="liste" required="">
                                        <option value="">Selectionner</option>
                                        @foreach ($listes as $liste)
                                        <option value="{{$liste->nom}}" {{Auth::user()->liste_id==$liste->id ? 'selected' : ''}}>{{$liste->nom}}</option>
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
                                    <input type="hidden" name="nb" id="nb">
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
       url = "http://5.189.166.92/legistlatif/public/";
      // url = "http://127.0.0.1:8000/";
          $(document).ready(function () {
           
           // setTimeout(, 2000); 
            $(".departement").hide();
            $(".typeliste").hide();
            $("#btncni").click(function () {
                var cni = $("#cni").val();
                $.blockUI({ message: "<p>Patienter</p>" }); 
                $.ajax({
            type:'GET',
           //url:'http://127.0.0.1:7777/api/cartes/get/by/nin?nin='+cni,
           url: 'http://5.189.166.92:7777/api/cartes/get/by/nin?nin='+cni,
          
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
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
            if(scrutin && type)
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        $.ajax({
                    type:'GET',
                    url:url+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                            sexe =""
                            console.log(data);
                            $("#numero").empty()
                            $("#sexeSaisir").empty()
                            $("#full-message").empty()
                           if(data.ordre)
                            {
                                $("#numero").append(data.ordre+1);
                                sexe = data.sexe; 
                                $("#sexeSaisir").empty();
                                if((data.ordre +1 < data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                {
                                    
                               
                                    if(sexe=="M")
                                    {
                                        $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                    }
                                    else if(sexe=="F")
                                    {
                                        $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                    }
                                }
                                if(data.ordre == data.nb)
                                {
                                    $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                }
                                
                            }
                            else
                            {
                                $("#sexeSaisir").empty();
                               
                                $("#numero").append("1");
                            }
                            //$("#localite_id").empty();
                    }
                });
                    }
                }
                else if(scrutin=='propotionnel')
                {
                    $.ajax({
                    type:'GET',
                    url:url+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {

                        $("#numero").empty();
                        $("#full-message").empty()
                        if(data.ordre)
                        {
                            $("#numero").append(data.ordre+1);
                            sexe = data.sexe;
                            $("#sexeSaisir").empty();
                          
                                if(sexe=="M")
                                {
                                    $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                }
                                else if(sexe=="F")
                                {
                                    $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                }
                                if( data.type == "titulaire" && data.ordre ==53 )
                                {
                                    $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                }
                                else if(ata.type == "supleant" && data.ordre ==50 )
                                {
                                    $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");

                                }

                               
                        }
                        else
                        {
                            $("#sexeSaisir").empty();
                            $("#numero").append("1");
                        }
                     
                       
                        //$("#localite_id").empty();
                    }
                });
                }
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
            console.log(scrutin,type,departement_id);
            if(scrutin && type)
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        $.ajax({
                    type:'GET',
                    url:url+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                    
                            console.log(data);
                            $("#numero").empty();
                            $("#full-message").empty()
                           if(data.ordre)
                            {
                                $("#numero").append(data.ordre+1);
                                sexe = data.sexe; 
                                $("#sexeSaisir").empty();
                                if((data.ordre +1 < data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                {
                                    
                               
                                    if(sexe=="M")
                                    {
                                        $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                    }
                                    else if(sexe=="F")
                                    {
                                        $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                    }
                                }
                                if(data.ordre == data.nb)
                                {
                                    $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                }
                            }
                            else
                            {
                               
                                $("#sexeSaisir").empty();
                                $("#numero").append("1");
                            }
                          
                            //$("#localite_id").empty();
                    }
                });
                    }
                }
                else if(scrutin=='propotionnel')
                {
                    
                    $.ajax({
                    type:'GET',
                    url:url+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {

                        console.log(data);
                        $("#numero").empty();
                        $("#full-message").empty()
                        if(data.ordre)
                        {
                            $("#numero").append(data.ordre+1);
                            sexe = data.sexe; 
                            $("#sexeSaisir").empty();
                            if(sexe=="M")
                            {
                                $("#sexeSaisir").append("Sexe à saisi Feminin ")
                            }
                            else if(sexe=="F")
                            {
                                $("#sexeSaisir").append("Sexe à saisi Masculin ")
                            }
                            if( data.type == "titulaire" && data.ordre ==53 )
                            {
                                $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                            }
                            else if(ata.type == "supleant" && data.ordre ==50 )
                            {
                                $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");

                            }
                        }
                        else
                        {
                            $("#sexeSaisir").empty();

                             $("#numero").append("1");
                        }
    
                    
                        //$("#localite_id").empty();
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
            $("#nb").val('');
            if(departement_id)
            {
                $.ajax({
                    type:'GET',
                    url: url+'get/by/departement/'+departement_id,

                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {

                    
                            console.log(data);
                            $("#nb").val(data.nb);
                        
                    
                        //$("#localite_id").empty();
                    }
                });
            }
            var scrutin =  $("#scrutin").children("option:selected").val();
            var type =  $("#type").children("option:selected").val();
            if(scrutin && type)
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        $.ajax({
                    type:'GET',
                    url:url+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                    
                            console.log(data);
                            $("#numero").empty();
                            $("#full-message").empty()
                           if(data.ordre)
                            {
                                $("#numero").append(data.ordre+1);
                                sexe = data.sexe; 
                                $("#sexeSaisir").empty();
                                if((data.ordre +1 < data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                {
                                    
                               
                                    if(sexe=="M")
                                    {
                                        $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                    }
                                    else if(sexe=="F")
                                    {
                                        $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                    }
                                    
                                }
                                if(data.ordre == data.nb)
                                {
                                    $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                }
                            }
                            else
                            {
                                $("#sexeSaisir").empty();
                                $("#numero").append("1");
                            }
                          
                            //$("#localite_id").empty();
                    }
                });
                    }
                }
            
            }
            
        });
    </script>
@endsection

