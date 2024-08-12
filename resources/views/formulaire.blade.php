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
            <h3>FORMULAIRE</h3>
            <h4>DE PRESENTATION DE LA LISTE DES CANDIDATS </h4>
            <h4>POUR LE SCRUTIN PROPORTIONNEL</h4>
            <h4>(liste nationale)</h4>

        </div>
        <div class="col-sm-2">

        </div>
</div>
<div class="row " >
    <div class="col text-center">
        <h4>ELECTIONS LEGISLATIVES DU 31 juillet 2024</h4>

    </div>
</div>

<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <p>Nom du parti, de la coalition de partis politiques ou de l’entité indépendante</p>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <p>TITRE (éventuellement)  </p>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h4>{{Auth::user()->liste->nom}}</h4>
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
        <h4>I- TITULAIRE</h4>
        <p>Soixante (60) candidats</p>
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
            
                @foreach ($listenationalTitulaire as $listenational)
                @if($listenational->type=='titulaire')
                    
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
                        @endif
                    @endforeach        
               
                    
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        <h4>II- SUPPLEANTS</h4>
        <p>Soixante (52) candidats</p>
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
            
                @foreach ($listenationalSuppleant as $listenational)
                            @if($listenational->type=='suppleant')
                    
                        <tr>
                            <td>{{ $supleant['data']->ordre }}</td>
                            <td>{{ $supleant['data']->prenom }}</td>
                            <td>{{ $supleant['data']->nom }}</td>
                            <td>{{ $supleant['data']->datenaiss }} à {{ $supleant['data']->lieunaiss }}</td>
                            <td>{{ $supleant['data']->sexe }}</td>
                            <td>{{ $supleant['data']->profession }}</td>
                            <td>{{ $supleant['data']->domicile }}</td>
                            <td>{{ $supleant['data']->se }}</td>


                        </tr>
                        @endif
                    
                    @endforeach        
               
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>

 <div class="page-break"></div>
      <!--  jQuery  -->
      @foreach($listeParDepartementFinal as $departement => $categories)

      <div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-8 text-center">
            <h3>FORMULAIRE</h3>
            <h4>DE PRESENTATION DE LA LISTE DES CANDIDATS </h4>
            <h4>POUR LE SCRUTIN MAJORITAIRE DEPARTEMENTAL</h4>
            

        </div>
        <div class="col-sm-2">

        </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        <h4>ELECTIONS LEGISLATIVES DU 31 juillet 2024</h4>

    </div>
</div>

<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <p>Nom du parti, de la coalition de partis politiques ou de l’entité indépendante</p>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <p>TITRE (éventuellement)  </p>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h4>{{Auth::user()->liste->nom}}</h4>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h4>SCRUTIN MAJORITAIRE</h4>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
    
    </div>
    <div class="col-sm-8 text-center">
        <h4>DEPARTEMENT DE {{ $departement }}
        </h4>
    </div>
    <div class="col-sm-2">

    </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        <h4>I- TITULAIRE</h4>
        <p>Soixante (60) candidats</p>
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
            
                @if(!empty($categories['supleant']))
                    @foreach($categories['supleant'] as $supleant)
                    
                        <tr>
                            <td>{{ $supleant['data']->ordre }}</td>
                            <td>{{ $supleant['data']->prenom }}</td>
                            <td>{{ $supleant['data']->nom }}</td>
                            <td>{{ $supleant['data']->datenaiss }} à {{ $supleant['data']->lieunaiss }}</td>
                            <td>{{ $supleant['data']->sexe }}</td>
                            <td>{{ $supleant['data']->profession }}</td>
                            <td>{{ $supleant['data']->domicile }}</td>
                            <td>{{ $supleant['data']->se }}</td>


                        </tr>
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
        <h4>II- SUPPLEANTS</h4>
        <p>Soixante (52) candidats</p>
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
            
                @if(!empty($categories['supleant']))
                    @foreach($categories['supleant'] as $supleant)
                    
                        <tr>
                            <td>{{ $supleant['data']->ordre }}</td>
                            <td>{{ $supleant['data']->prenom }}</td>
                            <td>{{ $supleant['data']->nom }}</td>
                            <td>{{ $supleant['data']->datenaiss }} à {{ $supleant['data']->lieunaiss }}</td>
                            <td>{{ $supleant['data']->sexe }}</td>
                            <td>{{ $supleant['data']->profession }}</td>
                            <td>{{ $supleant['data']->domicile }}</td>
                            <td>{{ $supleant['data']->se }}</td>


                        </tr>
                    @endforeach        
                @endif
                    
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>
@endforeach
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
