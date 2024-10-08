<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>DGE </title>
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
            .page-break{
                page-break-after: always;
            }
            td{
                font-size: 18px;
            }
                #sa-params{
                    display: none;
                }
                html{
                    background: white;
                }
        </style>



    <!-- Begin page -->

<div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-8 text-center">
            <p>REPUBLIQUE DU SENEGAL</p>
            <p>Un peuple-un but-une foi</p>
            <p>------------------</p>
            <p>ELECTIONS LEGISLATIVES ANTICIPEES DU 17 novembre 2024</p>
            <p>………………………………………………………………………………………… (1)</p>
            <h5>BORDEREAU DE DEPOT  <br>
                DES DOSSIERS DE DECLARATION DE CANDIDATURES
                </h5>
            <p>Départements où la liste se présente </p>

        </div>
        <div class="col-sm-2">

        </div>
</div>
<div class="row">
    <div class="col-sm-2">
        
    </div>
    <div class="col-sm-8 text-center">
        <div class="row">
            <div class="col-sm-6">
                Déclaration d’investiture : <br>
                Quittance et attestation de la caution : <br>
            </div>
            <div class="col-sm-6">
                Déclaration de candidature : <br>
                Photo de la tête de liste : <br>
            </div>
        </div>
    </div>
    <div class="col-sm-2">

    </div>
</div>

                            

		           

<div class="row" >
    <div class="col-12">
        <b>1-Sur le territoire national</b>
       
        
    </div>
    @foreach ($tabCandidats as $item)
    
        @if($item['lieu']==0)
            @if($item['titulaire'] > 0 || $item['suppleant'] >0) <div class="col" style="font-size: 13px;">{{$item['departement']}} <b>{{$item['titulaire'] + $item['suppleant']}}</b></div >@endif
        @endif
    @endforeach
    <div class="col-12">
        <div class="row">
            <div class="col-12">
            <b>2-A l’extérieur</b>
            </div>
            @foreach ($tabCandidats as $item)
            @if($item['lieu']==1)
                    @if($item['titulaire'] > 0 || $item['suppleant'] >0) 
                       
                            <div class="col" style="font-size: 13px;">{{$item['departement']}} <b>{{$item['titulaire'] + $item['suppleant']}}</b></div >

                        
                    @endif
                @endif
             @endforeach
        </div>
        
    </div>
    <div class="col-12">
       <table class=" table table-bordered  table-striped ">
        <tr  class="text-center">
            <td colspan="2">Total des candidats présentés dans les départements <b>{{$suppleantd+$titulaired}}</b></td>
        </tr>
        <tr class="text-center">
            <td>TITULAIRES  : <b>{{$titulaired}}</b></td>
            <td>SUPPLEANTS  : <b>{{$suppleantd}}</b></td>
        </tr>
        <tr>
            <td>
                <li>Nombre total de déclarations <br>individuelles de candidature: <b>......................................</b></li>
                <li>Nombre total d’extraits <br>de naissance ou de photocopies de CNI légalisées  : <b>...............................</b></li>
                <li>Nombre total de <br>bulletins n°3 du casier judiciaire : <b>..................................</b></li>
            </td>
            <td>
                <li>Nombre total de déclarations <br>individuelles de candidature: <b>......................................</b></li>
                <li>Nombre total d’extraits <br>de naissance ou de photocopies de CNI légalisées  : <b>...............................</b></li>
                <li>Nombre total de <br>bulletins n°3 du casier judiciaire : <b>..................................</b></li>
            </td>
        </tr>   
       </table>

    </div>
    <div class="col-12">
        <table class=" table table-bordered  table-striped ">
         <tr class="text-center">
             <td colspan="2">Total des candidats présentés sur la liste nationale : <b>{{$nbSupleantNational+$nbTitulaireNational}}</b></td>
         </tr>
         <tr class="text-center">
            <td>TITULAIRES  : <b>{{$nbTitulaireNational}}</b></td>
            <td>SUPPLEANTS  : <b>{{$nbSupleantNational}}</b></td>
         </tr>
         <tr>
            <td>
                <li>Nombre total de déclarations <br>individuelles de candidature: <b>......................................</b></li>
                <li>Nombre total d’extraits <br>de naissance ou de photocopies de CNI légalisées  : <b>...............................</b></li>
                <li>Nombre total de <br>bulletins n°3 du casier judiciaire : <b>..................................</b></li>
            </td>
            <td>
                <li>Nombre total de déclarations <br>individuelles de candidature: <b>......................................</b></li>
                <li>Nombre total d’extraits <br>de naissance ou de photocopies de CNI légalisées  : <b>...............................</b></li>
                <li>Nombre total de <br>bulletins n°3 du casier judiciaire : <b>..................................</b></li>
            </td>
        </tr>       
        </table>
        
     </div>
     <div class="col-12">
        <table class=" table table-bordered  table-striped text-center">
         <tr>
             <td colspan="2">Total des candidats présentés <b>{{$titulaired+$nbTitulaireNational+$suppleantd+$nbSupleantNational}}</b></td>
         </tr>
         <tr>
             <td>TITULAIRES  : <b>{{$titulaired+$nbTitulaireNational}}</b></td>
             <td>SUPPLEANTS  : <b>{{$suppleantd+$nbSupleantNational}}</b></td>
         </tr>
         
        </table>
        
     </div>
   
</div>







   
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
