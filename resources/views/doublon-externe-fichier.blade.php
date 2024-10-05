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
                font-size: 10px;
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
table{
    width: 100%;
}
  
        </style>



<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE PROPORTIONNEL</div>
            <div class="card-body">


                <table id="datatable-buttons" class="table datatable-buttons1    table-bordered table-responsive-md table-striped text-center ">
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

                            {{-- <th>Action</th> --}}
                            <th>Etat</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listeNationals as $listenational)
                      
                            <tr>
                                <td>{{ $listenational->ordre }}</td>
                                <td>{{ $listenational->prenom }}</td>
                                <td>{{ $listenational->nom }}</td>
                                <td>{{ $listenational->numelecteur }}</td>
                                <td>{{ $listenational->sexe }}</td>
                                <td>{{ $listenational->profession }}</td>
                                <td>{{ date('d-m-Y', strtotime($listenational->datenaiss)) }}</td>
                                <td>{{ $listenational->lieunaiss }}</td>
                               <td class="text-danger">{{ $listenational->erreur }} <br>{{ $listenational->parite }}<br>{{ $listenational->doublon_interne }}<br>{{ $listenational->doublon_externe }} <br>	{{ $listenational->sur_le_fichier }}</td>
                                    {{--  <td> <a href="{{ route('valider.national',["id"=>$listenational->id]) }}" role="button" class="btn btn-success"><i class="fas fa-check"></i></a>
                                        <a href="{{ route('listenational.edit', $listenational->id) }}" data-toggle="modal" data-target="#listenational{{$listenational->id}}" role="button" class="btn btn-danger"><i class="fas fa-ban"></i></a>

                                     
                                    </td> --}}
                             <td>
                               @if ($listenational->verif==0)
                                   <span class="badge badge-boxed  badge-info"> Non verifier</span>
                               @elseif($listenational->etat==0)
                               <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                               @else
                               <span class="badge badge-boxed  badge-success"> Valider</span>
                               @endif
                            </td>
                          
                            </tr>
                      
                    @endforeach

                    </tbody>
                </table>
        
            </div>
    </div>
</div>
<div class="page-break"></div>
<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE DEPARTEMENTAL</div>
            <div class="card-body">
                
                <table id="datatable-buttons" class="table  datatable-buttons1 table-bordered table-responsive-md table-striped text-center ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Numero Electeur</th>
                            <th>Sexe</th>
                            <th>Liste</th>
                            <th>Date de Naissance</th>
                            <th>Departement</th>
                            <th>Erreur</th>

                            {{-- <th>Action</th> --}}

                            <th>Etat</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listeDepartements as $listeDepartement)
                       
                            <tr>
                                <td>{{ $listeDepartement->ordre }}</td>
                                <td>{{ $listeDepartement->prenom }}</td>
                                <td>{{ $listeDepartement->nom }}</td>
                                <td>{{ $listeDepartement->numelecteur }}</td>
                                <td>{{ $listeDepartement->sexe }}</td>
                                <td>{{ $listeDepartement->liste }}</td>
                                <td>{{ date('d-m-Y', strtotime($listeDepartement->datenaiss)) }}</td>
                                <td>{{ $listeDepartement->departement }}</td>
                                <td class="text-danger">{{ $listeDepartement->erreur }}<br>{{ $listeDepartement->parite }}<br>{{ $listeDepartement->doublon_interne }}<br>{{ $listeDepartement->doublon_externe }} <br>	{{ $listeDepartement->sur_le_fichier }}</td>
                                {{-- <td> </td> --}}
                                <td>
                                    @if ($listeDepartement->verif==0)
                                        <span class="badge badge-boxed  badge-info"> Non verifier</span>
                                    @elseif($listeDepartement->etat==0)
                                    <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                    @else
                                    <span class="badge badge-boxed  badge-success"> Valider</span>
                                    @endif
                                </td>
                              
                            </tr>
                       
                    @endforeach

                    </tbody>
                </table>
            </div>
    </div>
</div>






<div class="page-break"></div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
