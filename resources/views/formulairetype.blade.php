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
@if($scrutin=="propotionnel")
<div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-8 text-center">
            <h4>FORMULAIRE</h4>
            <h5>POUR LE SCRUTIN PROPORTIONNEL</h5>

        </div>
        <div class="col-sm-2">

        </div>
</div>
<div class="row " >
    <div class="col text-center">
        <h5>Elections législatives anticipées du 17 novembre 2024</h5>

    </div>
</div>



<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h5>{{Auth::user()->liste->nom}}</h5>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
      <h4>SCRUTIN PROPORTIONNEL</h4> 

    </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        @if($type=="titulaire")
            <h5>TITULAIRE : Soixante (53) candidats</h5>
        @else
        <h5>SUPPLEANTS : Soixante (20) candidats</h5>
        @endif
    </div>
    
</div>
<div class="row">
    <div class="col-sm-1">
    
    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Service, Emploi et lieu d’affectation pour les agents de l’Etat</th>
                </tr>
            </thead>
            <tbody>
            
                @foreach ($listes as $listenational)                    
                        <tr>
                            <td>{{ $listenational->ordre }}</td>
                            <td>{{ $listenational->prenom }}</td>
                            <td>{{ $listenational->nom }}</td>
                            <td>{{ $listenational->datenaiss }} à {{ $listenational->lieunaiss }}</td>
                            <td>{{ $listenational->sexe }}</td>
                            <td>{{ $listenational->profession }}</td>
                            <td>{{ $listenational->domicile }}</td>
                            <td>{{ $listenational->se }}</td>


                        </tr>
                    @endforeach        
               
                    
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>
@endif
@if($scrutin=="majoritaire")

    
<div class="row text-center" >
    <div class="col text-center">
        <h5>Elections législatives anticipées du 17 novembre 2024</h5>

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h5>{{Auth::user()->liste->nom}}</h5>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h5>SCRUTIN MAJORITAIRE</h5>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h5>DEPARTEMENT DE {{ $departement->nom }}
        </h5>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        <h5>TItulaire : {{$departement->nb}} candidats</h5>
    </div>
   
</div>
<div class="row">
    <div class="col-sm-1">
    
    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Service, Emploi et lieu d’affectation pour les agents de l’Etat</th>
                </tr>
            </thead>
            <tbody>
            
                @if(!empty($listes))
                    @foreach($listes as $liste)
                        @if($liste->type=="titulaire")
                    
                        <tr>
                            <td>{{ $liste->ordre }}</td>
                            <td>{{ $liste->prenom }}</td>
                            <td>{{ $liste->nom }}</td>
                            <td>{{ $liste->datenaiss }} à {{ $liste->lieunaiss }}</td>
                            <td>{{ $liste->sexe }}</td>
                            <td>{{ $liste->profession }}</td>
                            <td>{{ $liste->domicile }}</td>
                            <td>{{ $liste->se }}</td>


                        </tr>
                        @endif
                    @endforeach        
                @endif
                    
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        <h5>Suppleant : {{$departement->nb}} candidats</h5>
    </div>
   
</div>
<div class="row">
    <div class="col-sm-1">
    
    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Service, Emploi et lieu d’affectation pour les agents de l’Etat</th>
                </tr>
            </thead>
            <tbody>
            
                @if(!empty($listes))
                    @foreach($listes as $liste)
                        @if($liste->type=="supleant")
                    
                        <tr>
                            <td>{{ $liste->ordre }}</td>
                            <td>{{ $liste->prenom }}</td>
                            <td>{{ $liste->nom }}</td>
                            <td>{{ $liste->datenaiss }} à {{ $liste->lieunaiss }}</td>
                            <td>{{ $liste->sexe }}</td>
                            <td>{{ $liste->profession }}</td>
                            <td>{{ $liste->domicile }}</td>
                            <td>{{ $liste->se }}</td>


                        </tr>
                        @endif
                    @endforeach        
                @endif
                    
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>
@endif


        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
