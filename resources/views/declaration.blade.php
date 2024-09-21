<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>DGE</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        {{--<link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css"> --}}
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body style="background: white;">
        <style>
                p{
                    font-size:18px;
                }
               input
               {
                width: 50px;
               }
        </style>


    <!-- Begin page -->
<div class="content">
<div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-8 text-center">
            <h3>Déclaration INDIVIDUELLE dE CANDIDATURE</h3>
            <h4>pour les élections législatives anticipées du 17 novembre 2024</h4>
        </div>
        <div class="col-sm-2">

        </div>
</div>

<div class="row">
    <div class="col-sm-3">
    
    </div>
    <div class="col-sm-6 text-center">
        <p><b>@if ($candidat->sexe=="F")Mme @else M. @endif </b>  <b> {{$candidat->prenom}}  {{$candidat->nom}}</b></p>
        <p>pour les élections législatives anticipées du 17 novembre 2024</p>
        <p>A</p>
        <p>Monsieur le Ministre chargé des élections</p>
        <p>OBJET :  <b>Déclaration individuelle de candidature.</b></p>
    </div>
    <div class="col-sm-3">

    </div>
</div>
<div class="row">
    <div class="col-sm-1">
    
    </div>
    <div class="col-sm-9">

    
    <p>Je soussigné <b>{{$candidat->prenom}}  {{$candidat->nom}}</b>

        @if ($candidat->sexe=="M") Né @else Née @endif le <b>{{$candidat->datenaiss}}</b> à <b>{{$candidat->lieunaiss}}</b>, @if ($candidat->sexe=="M") fils @else fille @endif de ________________ et de _________________________
        
        @if ($candidat->sexe=="M") domicilié @else domiciliée @endif à @if ($candidat->domicile) <b>{{$candidat->domicile}}</b> @else ______________ @endif sexe  <b> @if ($candidat->sexe=="M") masculin @else feminin @endif </b>exerçant la profession de <b>{{$candidat->profession}}</b>
         
        @if ($candidat->sexe=="M") inscrit @else inscrite @endif  sur la liste électorale de @if(!empty($candidat->commune)) {{$candidat->commune}} @else _____________________ @endif sous le n°{{$candidat->numelecteur}}
        déclare être @if ($candidat->sexe=="M") candidat @else candidate @endif  aux élections législatives anticipées qui auront lieu le 17 novembre 2024 .
        
    </p>
        
       <p> @if ($candidat->sexe=="M") Investi @else Investie @endif  par le parti politique, la coalition de partis politiques </p>
        
       <h5><b>{{$liste->nom}} </b></h5>

           <p> je figure en qualité de titulaire  <input type="text">  de suppléant   <input type="text">        sur :   </p>
            
        
         <p>1° <input type="text">  liste du Département de  @if ($type=="majoritaire"){{$departement->nom}} @else __________________  @endif   </b> pour le scrutin majoritaire  </p>
         <p>2°<input type="text">  la liste nationale, pour le scrutin proportionnel  </p>

       
         @if ($liste->type=="partie_ou_coalition")
         <p><strong> Je certifie sur l’honneur n’être  @if ($candidat->sexe=="M") candidat @else candidat @endif que sur cette liste, je jouis de mes droits civiques et politiques et je ne me trouve dans aucun des cas d’inéligibilité prévus par le Code électoral.</strong> </p>

         @else
         <p> <strong>  Je certifie sur l’honneur n’être  @if ($candidat->sexe=="M") candidat @else candidat @endif que sur cette liste, je jouis de mes droits civiques et politiques et je ne me trouve dans aucun des cas d’inéligibilité prévus par le Code électoral.</strong> </p>
            
         <p>  <strong> En ma qualité de candidat indépendant, j’atteste que je ne milite dans aucun parti politique ou que j’ai cessé toutes activités militantes dans un parti politique depuis au moins douze mois </strong> </p>
            
         @endif
            

            
            

         
            
    </div>
        <div class="col-sm-2">
    
        </div>
</div>

<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-4">
      
            
        
    </div>
    <div class="col-sm-6">
        <center>Fait à  _____________le__________________<br><br><br>
       Signature</center>
    </div>
</div>



				
				
</div>
		 





 <!-- <div class="page-break"></div>
       jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
