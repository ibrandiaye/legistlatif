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
                div
                {
                    text-align: center;
                    margin-top: 0px !important;
                    margin-bottom: 0px !important;
                }
                table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align:  center;
}
  
        </style>



    <!-- Begin page -->

<div class="row">
       
            <h3>REPUBLIQUE DU SENEGAL </h3>
            <h4>Un Peuple-Un But-une Foi </h4>
            <h4>{{$liste->nom}}</h4>
            <h4>SCRUTIN PROPORTIONNEL</h4>
            <h4>Liste des Titulaires</h4>

     
</div>

   
       




  
    

<div class="row">
  
    <div class="col-sm-10">

        <table   class="table table-bordered table-responsive-md table-striped text-center ">
            <thead >
                <tr>
                    <th>ordre d'investiture</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Numero Electeur</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                </tr>
            </thead>
            <tbody>
            
                @foreach ($listenationalTitulaire as $listenational)
                @if($listenational->type=='titulaire')
                    
                        <tr>
                            <td>{{ $listenational->ordre }}</td>
                            <td>{{ $listenational->prenom }}</td>
                            <td>{{ $listenational->nom }}</td>
                            <td>{{ $listenational->numelecteur }}</td>
                            <td>{{ $listenational->sexe }}</td>
                            <td>{{ $listenational->profession }}</td>


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
   
        <h4>Liste des suppleants</h4>
  
</div>
<div class="row">
    <div class="col-sm-1">
    
    </div>
    <div class="col-sm-10">

        <table    class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>ordre d'investiture</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                   
                </tr>
            </thead>
            <tbody>
            
                @foreach ($listenationalSuppleant as $listenational)
                            @if($listenational->type=='supleant')
                    
                        <tr>
                            <td>{{$listenational->ordre }}</td>
                            <td>{{$listenational->prenom }}</td>
                            <td>{{$listenational->nom }}</td>
                            <td>{{ $listenational->numelecteur }}</td>
                            <td>{{$listenational->sexe }}</td>
                            <td>{{$listenational->profession }}</td>
                           


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
 <div class="row">
  
        <h4>SCRUTIN MAJORITAIRE</h4>
        <h4>Liste  departementales</h4>
        <h4>{{$liste->nom}}</h4>

</div>
      <!--  jQuery  -->
      @foreach($listeParDepartementFinal as $departement => $categories)


<div class="row">
    <h4>DEPARTEMENT DE {{ $departement }}
    </h4>
    <h4>Liste des titulaires</h4>
</div>

<div class="row">
    <div class="col-sm-1">
    
    </div>
    <div class="col-sm-10">

        <table    class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>ordre d'investiture</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                  
                </tr>
            </thead>
            <tbody>
            
                @if(!empty($categories['titulaire']))
                    @foreach($categories['titulaire'] as $titulaire)
                    
                        <tr>
                            <td>{{ $titulaire['data']->ordre }}</td>
                            <td>{{ $titulaire['data']->prenom }}</td>
                            <td>{{ $titulaire['data']->nom }}</td>
                            <td>{{ $titulaire['data']->numelecteur }}</td>
                            <td>{{ $titulaire['data']->sexe }}</td>
                            <td>{{ $titulaire['data']->profession }}</td>
                           


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
  
        <h4> Liste des suppleants</h4>
   
</div>
<div class="row">
   
    <div class="col-sm-10">

        <table   style="width: 100%;"  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>orordre d'investituredre</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                  
                </tr>
            </thead>
            <tbody>
            
                @if(!empty($categories['supleant']))
                    @foreach($categories['supleant'] as $supleant)
                    
                        <tr>
                            <td>{{ $supleant['data']->ordre }}</td>
                            <td>{{ $supleant['data']->prenom }}</td>
                            <td>{{ $supleant['data']->nom }}</td>
                            <td>{{  $supleant['data']->numelecteur }}</td>
                            <td>{{ $supleant['data']->sexe }}</td>
                            <td>{{ $supleant['data']->profession }}</td>
                          
                        </tr>
                    @endforeach        
                @endif
                    
            </tbody>
                
        </table>
  
            
    </div>
    <div class="col-sm-1">

    </div>
</div>
<div class="page-break"></div>
@endforeach
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
