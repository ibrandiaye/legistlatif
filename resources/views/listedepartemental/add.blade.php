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

        <form action="{{ route('listedepartemental.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="card">
                        <div class="card-header  text-center"> <span id="sexeSaisir"></span>  &nbsp;&nbsp; Ordre à saisir <h4 id="numero"></h4></div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger" >
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
                            <div id="error">

                            </div>
                            <div  id="full-message">
                              
                            </div>
                                <div class="row">
                                    <input type="hidden" id="commune" name="commune">
                                    <div class="col-lg-2">
                                        <label> Scrutin</label>
                                        <select class="form-control" id="scrutin" name="scrutin" required="">
                                            <option value="">Selectionner</option>
                                            <option value="majoritaire" {{old('scrutin') == 'majoritaire' ? 'selected' : '' }}>Majoritaire</option>
                                            <option value="propotionnel" {{old('scrutin') == 'propotionnel' ? 'selected' : '' }}>Propotionnel</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 typeliste" >
                                        <div class="form-group">
                                            <label>Type Liste </label>
                                            <select class="form-control" id="type" name="type" required="">
                                                <option value="">Selectionner</option>
                                                <option value="titulaire" {{old('type') == 'titulaire' ? 'selected' : '' }}>titulaire</option>
                                                <option value="supleant"  {{old('type') == 'supleant' ? 'selected' : ''}}>supleant</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 departement">
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id"  id="departement_id">
                                            <option value="">Selectionner</option>
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}"  {{old('departement_id') == $departement->id ? 'selected' : '' }}>{{$departement->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        
                                        <div class="form-group ">
                                            <label>Numéro CNI </label>
                                            <input type="text" name="numcni" id="cni" class="form-control"  required>
                                            <span class="input-group-append">
                                                <button type="button" id="btncni" class="btn  btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                                </span>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Numéro Electeur </label>
                                            <input type="number" name="numelecteur" id="numelecteur"  class="form-control"  required>
                                            <span class="input-group-append">
                                                <button type="button" id="btnnumelec" class="btn  btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                                                </span>
                                        </div>
                                    </div>
                                    
                                   
                                   {{--  <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Numéro Ordre </label>
                                            <input type="number" name="ordre"  value="{{ old('ordre') }}" class="form-control"  required>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Prenom </label>
                                            <input type="text" name="prenom" id="prenom"   class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom" id="nom"   class="form-control"  required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Sexe </label>
                                            <select class="form-control" name="sexe" id="sexe" required="">
                                                <option value="">Selectionner</option>
                                                <option value="M">Homme</option>
                                                <option value="F">Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Date de naissance </label>
                                            <input type="date" name="datenaiss" id="datenaiss"   class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Lieu de naissance  </label>
                                            <input type="text" name="lieunaiss" id="lieunaiss"   class="form-control"  required>
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
                                       
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Domicile </label>
                                                <input type="text" name="domicile" id="domicile"   class="form-control"  >
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Profession </label>
                                                <input type="text" name="profession"    class="form-control"  required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Service, Emploi et lieu d’affectation  </label> {{-- pour les agents de l’Etat --}}
                                                <input type="text" name="se"   class="form-control"  >
                                            </div>
                                        </div>
                                       {{--  <div class="col-md-6">
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
                                        </div> --}}
                                    </div>
                                    <input type="hidden" value="{{old('nb')}}" name="nb" id="nb">
                                    <input type="hidden"  name="present" id="present">
                                <div>
                                    <center>
                                        <button  type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"> ENREGISTRER</button>
                                    </center>
                                     <!-- sample modal content -->
                                     <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="myModalLabel">Confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 class="mt-0" id="validation_modal"></h6>
                                                   
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fermer</button>
                                                    <button type="Submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                                <?php /*$candidats = Session::get('candidats') ?  Session::get('candidats') : array();*/ ?> 
                            </form>
                                <div class="col-lg-12">
                                    
                               
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
                                    <form action="{{ route('generer.formulaire') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="departement_id"  id="departement_idf">
                                        <input type="hidden" name="scrutin"  id="scrutinf" required>
                                        <input type="hidden" name="type"  id="typef" required>
                                        <center>
                                            <button type="submit" class="btn btn-success btn btn-lg "> Imprimer</button>
                                        </center>
                                      
                                    </form>
                                </div>
                            </div>

                            </div>

                            
         <input type="hidden" value="{{ config('app.url_app') }}"  id="app_url">
         <input type="hidden" value="{{ config('app.url_api') }}"  id="url_api">

@endsection
@section('script')
    <script>
        url_app = '{{ config('app.url_app') }}';
        url_api = '{{ config('app.url_api') }}';
   //   url = ""+url_app+"";
    //  url = "http://127.0.0.1:8000/";
    // url_app+"search/ajax" = ""+url_app+"search/ajax";
      //  url_app+"search/ajax" = "http://127.0.0.1:8000/search/ajax";
      var veriParite = ""
      liste_id = {{Auth::user()->liste_id}}
        sexe =""
        $(document).ready(function () 
        {
           
           // setTimeout(, 2000); 
            $(".departement").hide();
            $(".typeliste").hide();
            
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
            $("#btncni").click(function () {
                var scrutin = $("#scrutin").val();;
                var type =  $("#type").val();;
                var departement_id = $("#departement_id").val();
                var cni = $("#cni").val();
                $("#error").empty();
                $("#validation_modal").empty();
                sexeSaisi ="";
                $.blockUI({ message: "<p>Patienter</p>" }); 
                $.ajax({
                type:'GET',
                // url:'http://127.0.0.1:7777/api/cartes/get/by/nin?nin='+cni,
                url: url_api+'cartes/get/by/nin?nin='+cni,
          
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                        console.log(data,data.length);
                        if(data.length >=1)
                        {
                            console.log(data[0].ELEC_DATE_NAISSANCE)
                            $("#prenom").val(data[0].ELEC_PRENOM)
                            $("#nom").val(data[0].ELEC_NOM)
                            $("#sexe").val(data[0].ELEC_SEXE)
                            sexeSaisi = data[0].ELEC_SEXE;
                            console.log("sexe saisi",sexeSaisi)
                            $("#datenaiss").val(convertirDate(data[0].ELEC_DATE_NAISSANCE))
                            $("#numelecteur").val(data[0].ELEC_NUM_ELECTEUR)
                            $("#lieunaiss").val(data[0].ELEC_LIEU_NAISSANCE)
                            $("#commune").val(data[0].COMMUNE)
                            const givenDate = new Date(convertirDate( data[0].ELEC_DATE_NAISSANCE));
                            const today = new Date();
                            // Calcul de la différence en millisecondes
                            const differenceInMilliseconds = today.getTime() - givenDate.getTime();
                            const differenceInYears = differenceInMilliseconds / (1000 * 60 * 60 * 24 * 365.25);
                            console.log(differenceInYears)
                            if(differenceInYears< 25)
                            {
                                $("#error").append(" <div  class='alert alert-danger'> age minimun non ateint. age :"+parseInt(differenceInYears)+" ans</div>");
                            }
                            $("#present").val(1);
                            $("#validation_modal").append("Voulez-vous enregistrer  "+data[0].ELEC_PRENOM+" "+data[0].ELEC_NOM+"  "+data[0].NIN+"?");

                        }
                        else
                        {
                            $("#validation_modal").empty();
                            $("#present").val(0);
                            //alert("CNI non trouve");
                            $("#error").append(" <div  class='alert alert-danger'> Personne non identifier</div>");
                        }
                        setTimeout($.unblockUI, 1); 
                    },
                    error:function(){
                        setTimeout($.unblockUI, 1); 
                    }
                });
               
                if(scrutin=='propotionnel')
                {
                    $.ajax({
                    type:'GET',
                    url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                        console.log(data)
                        if(data.ordre)
                        {
                            sexe = data.sexe;                        
                            if(sexe=="M")
                                {
                                    if((data.ordre +1)%2==0)
                                    {
                                        if(sexeSaisi=="M")
                                        {
                                            console.log(1)
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    }
                                    else
                                    {
                                        if(sexeSaisi=="F")
                                        {
                                            console.log(2)
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    } 
                                    
                                }
                                else if(sexe=="F")
                                {
                                    if((data.ordre +1)%2==0)
                                    {
                                        if(sexeSaisi=="F")
                                        {
                                            console.log(3)
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    }
                                    else
                                    {
                                        if(sexeSaisi=="M")
                                        {
                                            console.log(4)
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    } 
                                }
                            
                            }
                        }
                    });
                  
                }
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                            $.ajax({
                        type:'GET',
                        url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',
                        data:'_token = <?php echo csrf_token() ?>',
                        success:function(data) {
                                sexe =""
                                console.log(data);
                            if(data.ordre)
                                {
                                    sexe = data.sexe; 
                                
                                    if((data.ordre +2 <= data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                    {
                                    
                                
                                        if(sexe=="M")
                                        {
                                            if((data.ordre +1)%2==0){
                                                if(sexeSaisi=="M")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            }
                                            else{
                                                if(sexeSaisi=="F")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            } 
                                            
                                        }
                                        else if(sexe=="F")
                                        {
                                            if((data.ordre +1)%2==0)
                                            {
                                                if(sexeSaisi=="F")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            }
                                            else
                                            {
                                                if(sexeSaisi=="M")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            } 
                                        }
                                    }
                                   
                                }
                                
                            }
                        });
                    }
                }              
                
                
            });

            $("#btnnumelec").click(function () 
            {
                var numelecteur = $("#numelecteur").val();
                var scrutin = $("#scrutin").val();;
                var type =  $("#type").val();;
                var departement_id = $("#departement_id").val();;
                $("#validation_modal").empty();
                sexeSaisi = ""
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
                        $("#lieunaiss").val(data[0].ELEC_LIEU_NAISSANCE)
                        $("#commune").val(data[0].COMMUNE)
                        $("#present").val(1);
                        sexeSaisi = data[0].ELEC_SEXE;
                        $("#validation_modal").append("Voulez-vous enregistrer "+data[0].ELEC_PRENOM+" "+data[0].ELEC_NOM+"  Numero NIN"+data[0].NIN+"?");
                        const givenDate = new Date(convertirDate( data[0].ELEC_DATE_NAISSANCE));
                        const today = new Date();
                        // Calcul de la différence en millisecondes
                        sexeSaisi = $("#sexe").val()
                        const differenceInMilliseconds = today.getTime() - givenDate.getTime();
                        const differenceInYears = differenceInMilliseconds / (1000 * 60 * 60 * 24 * 365.25);
                        console.log(differenceInYears)
                        if(differenceInYears< 25)
                        {
                            $("#error").append(" <div  class='alert alert-danger'> age minimun non ateint. age :"+parseInt(differenceInYears)+" ans</div>");
                        }
                    
                    }
                    else
                    {
                        $("#validation_modal").empty();
                    // alert("CNI non trouve");
                        $("#error").append(" <div  class='alert alert-danger'> Personne non identifier</div>");
                        $("#present").val(0);
                    }
                    setTimeout($.unblockUI, 1); 
                    },
                    error:function(){
                        setTimeout($.unblockUI, 1); 
                    }
                });
                if(scrutin=='propotionnel')
                {
                    $.ajax({
                    type:'GET',
                    url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                        if(data.ordre)
                        {
                            sexe = data.sexe;                        
                            if(sexe=="M")
                                {
                                    if((data.ordre +1)%2==0){
                                        if(sexeSaisi=="M")
                                        {
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    }
                                    else{
                                        if(sexeSaisi=="F")
                                        {
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    } 
                                    
                                }
                                else if(sexe=="F")
                                {
                                    if((data.ordre +1)%2==0)
                                    {
                                        if(sexeSaisi=="F")
                                        {
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    }
                                    else
                                    {
                                        if(sexeSaisi=="M")
                                        {
                                            $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                        }
                                    } 
                                }
                               
                            }
                        }
                    });
                  
                }
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                            $.ajax({
                        type:'GET',
                        url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',
                        data:'_token = <?php echo csrf_token() ?>',
                        success:function(data) {
                                sexe =""
                                console.log(data);
                            if(data.ordre)
                                {
                                    sexe = data.sexe; 
                                
                                    if((data.ordre +2 <= data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                    {
                                    
                                
                                        if(sexe=="M")
                                        {
                                            if((data.ordre +1)%2==0){
                                                if(sexeSaisi=="M")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            }
                                            else{
                                                if(sexeSaisi=="F")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            } 
                                            
                                        }
                                        else if(sexe=="F")
                                        {
                                            if((data.ordre +1)%2==0)
                                            {
                                                if(sexeSaisi=="F")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            }
                                            else
                                            {
                                                if(sexeSaisi=="M")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            
                                            } 
                                        }
                                    }
                                   
                                }
                                
                            }
                        });
                    }
                }
            });
                setTimeout($.unblockUI, 1); 
                var scrutin = '{{old('scrutin')}}';
                var type =  '{{old('type')}}';
                var departement_id = '{{old('departement_id')}}';
                console.log(scrutin,type);
                $("#scrutinf").val(scrutin);
                $("#typef").val(type);
                $("#departement_idf").val(departement_id);
                $("#tbody").empty();
                if(scrutin && type)
                {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        $.ajax({
                    type:'GET',
                    url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

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
                            
                                if((data.ordre +2 <= data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                {
                                
                            
                                    if(sexe=="M")
                                    {
                                        if((data.ordre +1)%2==0){
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                        
                                        }
                                        else{
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                        
                                        } 
                                        
                                    }
                                    else if(sexe=="F")
                                    {
                                        if((data.ordre +1)%2==0)
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                        
                                        }
                                        else
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                        
                                        } 
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
                        
                        $.ajax({
                                url: url_app+"search/ajax",
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
                                        "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                        "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                        "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                        "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                                        "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                        "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                        "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                        "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                        //alert("ibra")
                        $.ajax({
                            type:'GET',
                            url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
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
                                            if((data.ordre +1)%2==0){
                                                $("#sexeSaisir").append("Sexe à saisi Feminin  ")
                                                if(sexeSaisi=="M")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            }
                                            else{
                                                $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                                if(sexeSaisi=="F")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            } 
                                            
                                        }
                                        else if(sexe=="F")
                                        {
                                            if((data.ordre +1)%2==0)
                                            {
                                                $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                                if(sexeSaisi=="F")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            }
                                            else
                                            {
                                                console.log("fff");
                                                $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                                if(sexeSaisi=="M")
                                                {
                                                    $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                                }
                                            } 
                                        }
                                        if( data.type == "titulaire" && data.ordre ==53 )
                                        {
                                            $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                        }
                                        else if(data.type == "supleant" && data.ordre ==50 )
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
                    
                        $.ajax({
                            url: url_app+"search/ajax",
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
                                        "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                        "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                        "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                        "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                                        "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                        "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                        "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                        "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
          $("#scrutin").change(function () {
            var scrutin =  $("#scrutin").children("option:selected").val();
            var type =  $("#type").children("option:selected").val();
            var departement_id =  $("#departement_id").children("option:selected").val();
            $("#scrutinf").val(scrutin);
            $("#typef").val(type);
            $("#departement_idf").val(departement_id);
            $("#tbody").empty();
           if(scrutin && type)
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        $.ajax({
                    type:'GET',
                    url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

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
                                if((data.ordre +2 <= data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                {
                                    
                               
                                    if(sexe=="M")
                                    {
                                        if((data.ordre +1)%2==0){
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                        }
                                        else{
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                        } 
                                        
                                    }
                                    else if(sexe=="F")
                                    {
                                        if((data.ordre +1)%2==0)
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                        }
                                        else
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                        } 
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
                        url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
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
                                        if((data.ordre +1)%2==0){
                                            $("#sexeSaisir").append("Sexe à saisi Feminin  ")
                                        }
                                        else{
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                        } 
                                        
                                    }
                                    else if(sexe=="F")
                                    {
                                        if((data.ordre +1)%2==0)
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                        }
                                        else
                                        {
                                            console.log("fff");
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                        } 
                                    }
                                    if( data.type == "titulaire" && data.ordre ==53 )
                                    {
                                        $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                    }
                                    else if(data.type == "supleant" && data.ordre ==50 )
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
                    url: url_app+"search/ajax",
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
            var sexeSaisi   = $("#sexe").val()
            $("#scrutinf").val(scrutin);
            $("#typef").val(type);
            $("#departement_idf").val(departement_id);
            console.log(scrutin,type,departement_id);
            $("#tbody").empty();
            $("#tbodys").empty();
            //aler("ibra");
            if(scrutin )
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        if(type)
                    {
                        $.ajax({
                    type:'GET',
                    url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

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
                                if((data.ordre +2 <= data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                {
                                    
                               
                                    if(sexe=="M")
                                    {
                                        if((data.ordre +1)%2==0){
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                            if(sexeSaisi=="M")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        }
                                        else{
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                            if(sexeSaisi=="F")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        } 
                                        
                                    }
                                    else if(sexe=="F")
                                    {
                                        if((data.ordre +1)%2==0)
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                            if(sexeSaisi=="F")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        }
                                        else
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                            if(sexeSaisi=="F")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        } 
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
                   
                $.ajax({
                        url: url_app+"search/ajax",
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                    if(type)
                    {
                        $.ajax({
                        type:'GET',
                        url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+0+'/',
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
                                        if((data.ordre +1)%2==0){
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                            if(sexeSaisi=="M")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        }
                                        else{
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                            if(sexeSaisi=="F")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        } 
                                        
                                    }
                                    else if(sexe=="F")
                                    {
                                        if((data.ordre +1)%2==0)
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                            if(sexeSaisi=="F")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        }
                                        else
                                        {
                                            $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                            if(sexeSaisi=="M")
                                            {
                                                $("#error").append(" <div  class='alert alert-danger'> Probleme de Parite</div>"); 
                                            }
                                        } 
                                    }
                                if( data.type == "titulaire" && data.ordre ==53 )
                                {
                                    $("#full-message").append(" <div class='alert alert-danger'>Vous avez atteind le nombre de candidat requis</div> ");
                                }
                                else if(data.type == "supleant" && data.ordre ==50 )
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
                $.ajax({
                        url: url_app+"search/ajax",
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
            $("#scrutinf").val(scrutin);
            $("#typef").val(type);
            $("#departement_idf").val(departement_id);
            $("#nb").val('');
            $("#tbody").empty();
            $("#tbodys").empty();

            if(departement_id)
            {
                $.ajax({
                    type:'GET',
                    url: url_app+'get/by/departement/'+departement_id,

                //   url:'http://vmi435145.contaboserver.net:9000/pays/by/juridiction/'+juridiction_id,
                    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {

                    
                            console.log(data);
                            $("#nb").val(data.nb);
                        
                    
                        //$("#localite_id").empty();
                    }
                });
            }
            
            if(scrutin )
            {
                if(scrutin == "majoritaire")
                {
                    if(departement_id)
                    {
                        if(type)
                        {
                            $.ajax({
                                type:'GET',
                                url:url_app+'last/save/by/liste/'+scrutin+'/'+type+'/'+departement_id+'/',

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
                                            if((data.ordre +2 <= data.nb &&  data.nb%2!=0 ) || data.nb%2==0)
                                            {
                                                
                                        
                                                if(sexe=="M")
                                                {
                                                    if((data.ordre +1)%2==0){
                                                        $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                                    }
                                                    else{
                                                        $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                                    } 
                                                    
                                                }
                                                else if(sexe=="F")
                                                {
                                                    if((data.ordre +1)%2==0)
                                                    {
                                                        $("#sexeSaisir").append("Sexe à saisi Masculin ")
                                                    }
                                                    else
                                                    {
                                                        $("#sexeSaisir").append("Sexe à saisi Feminin ")
                                                    } 
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
                    
                     
                    $.ajax({
                            url: url_app+"search/ajax",
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listedepartemental/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/majoritaire' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listedepartemental/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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
                                "<td class='text-danger'>"+element.erreur+"<br>" + element.parite+"<br>"+element.doublon_interne+"<br>"+element.sur_le_fichier+"</td>"+
                                "<td> <a href='"+url_app+"listenational/"+element.id+"' role='button' class='btn btn-warning'><i class='fas fa-eye'></i></a>"+
                                "<a href='"+url_app+"declaration/"+element.id+"/propotionnel' role='button' class='btn btn-warning'><i class='fas fa-file'></i></a>"+
                                "<a href='"+url_app+"listenational/"+element.id+"/edit' role='button' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>"+
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

