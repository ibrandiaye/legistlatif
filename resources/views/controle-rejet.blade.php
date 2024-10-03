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
            <h4>POUR LE SCRUTIN PROPORTIONNEL</h4>

        </div>
        <div class="col-sm-2">

        </div>
</div>
<div class="row " >
    <div class="col text-center">
        <h4>Elections législatives anticipées du 17 novembre 2024</h4>

    </div>
</div>



<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8 text-center">
        <h4>{{$liste->nom}}</h4>
        <br>
        <p>  @if ($liste->verif==0)
                <span class="badge badge-boxed  badge-info"> Non verifier</span>
                @elseif($liste->etat==0)
                <span class="badge badge-boxed  badge-danger"> Rejeter </span> Commentaire : {{$liste->commentaire}}
                @else
                <span class="badge badge-boxed  badge-success"> Valider</span>
                @endif</p>
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
        <p>Cinquante trois (53) candidats</p>
    </div>

</div>
<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>ordre</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Etat</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($listenationalTitulaire as $listenational)
                @if( $listenational->type=='titulaire' && $listenational->verif==1 && $listenational->etat==0)

                        <tr>
                            <td>{{ $listenational->ordre }}</td>
                            <td>{{ $listenational->prenom }}</td>
                            <td>{{ $listenational->nom }}</td>
                            <td>{{ $listenational->numelecteur }}</td>
                            <td>{{ $listenational->datenaiss }} à {{ $listenational->lieunaiss }}</td>
                            <td>{{ $listenational->sexe }}</td>
                            <td>{{ $listenational->profession }}</td>
                            <td>{{ $listenational->domicile }}</td>
                            <td>
                                @if ($listenational->verif==0)
                                    <span class="badge badge-boxed  badge-info"> Non verifer</span>
                                @elseif($listenational->etat==0)
                                <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                @else
                                <span class="badge badge-boxed  badge-success"> Valider</span>
                                @endif
                             </td>
                             <td>{{$listenational->commentaire}}</td>


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
        <p> Cinquante (50) candidats</p>
    </div>

</div>
<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>ordre</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Etat</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($listenationalSuppleant as $listenational)
                            @if($listenational->type=='supleant' && $listenational->verif==1 && $listenational->etat==0)

                        <tr>
                            <td>{{$listenational->ordre }}</td>
                            <td>{{$listenational->prenom }}</td>
                            <td>{{$listenational->nom }}</td>
                            <td>{{ $listenational->numelecteur }}</td>
                            <td>{{$listenational->datenaiss }} à {{$listenational->lieunaiss }}</td>
                            <td>{{$listenational->sexe }}</td>
                            <td>{{$listenational->profession }}</td>
                            <td>{{$listenational->domicile }}</td>

                            <td>
                                @if ($listenational->verif==0)
                                    <span class="badge badge-boxed  badge-info"> Non verifer</span>
                                @elseif($listenational->etat==0)
                                <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                @else
                                <span class="badge badge-boxed  badge-success"> Valider</span>
                                @endif
                             </td>
                             <td>{{$listenational->commentaire}}</td>


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
            <h4>POUR LE SCRUTIN MAJORITAIRE DEPARTEMENTAL</h4>


        </div>
        <div class="col-sm-2">

        </div>
</div>
<div class="row text-center" >
    <div class="col text-center">
        <h4>Elections législatives anticipées du 17 novembre 2024</h4>

    </div>
</div>


<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8 text-center">
        <h4>{{$liste->nom}}</h4>
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
        <p>{{$categories['nombre']}} candidats</p>
    </div>

</div>
<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>ordre</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Etat</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>

                @if(!empty($categories['titulaire']))
                    @foreach($categories['titulaire'] as $titulaire)
                    @if( $titulaire['data']->verif==1 && $titulaire['data']->etat==0)

                        <tr>
                            <td>{{ $titulaire['data']->ordre }}</td>
                            <td>{{ $titulaire['data']->prenom }}</td>
                            <td>{{ $titulaire['data']->nom }}</td>
                            <td>{{ $titulaire['data']->numelecteur }}</td>
                            <td>{{ date('d-m-Y', strtotime($titulaire['data']->datenaiss)) }} à {{ $titulaire['data']->lieunaiss }}</td>
                            <td>{{ $titulaire['data']->sexe }}</td>
                            <td>{{ $titulaire['data']->profession }}</td>
                            <td>{{ $titulaire['data']->domicile }}</td>

                            <td>
                                @if ($titulaire['data']->verif==0)
                                    <span class="badge badge-boxed  badge-info"> Non verifer</span>
                                @elseif($titulaire['data']->etat==0)
                                <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                                @else
                                <span class="badge badge-boxed  badge-success"> Valider</span>
                                @endif
                             </td>
                             <td>{{$titulaire['data']->commentaire}}</td>


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
        <h4>II- SUPPLEANTS</h4>
        <p>{{$categories['nombre']}} candidats</p>
    </div>

</div>
<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-10">

        <table  class="table table-bordered table-responsive-md table-striped text-center ">
            <thead>
                <tr>
                    <th>ordre</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Num Electeur</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Profession</th>
                    <th>Domicile </th>
                    <th>Etat</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>

                @if(!empty($categories['supleant']))
                    @foreach($categories['supleant'] as $supleant)
                    @if( $supleant['data']->verif==1 && $supleant['data']->etat==0)
                        <tr>
                            <td>{{ $supleant['data']->ordre }}</td>
                            <td>{{ $supleant['data']->prenom }}</td>
                            <td>{{ $supleant['data']->nom }}</td>
                            <td>{{  $supleant['data']->numelecteur }}</td>
                            <td>{{ date('d-m-Y', strtotime($supleant['data']->datenaiss)) }} à {{ $supleant['data']->lieunaiss }}</td>
                            <td>{{ $supleant['data']->sexe }}</td>
                            <td>{{ $supleant['data']->profession }}</td>
                            <td>{{ $supleant['data']->domicile }}</td>
                            <td>
                            @if ($supleant['data']->verif==0)
                            <span class="badge badge-boxed  badge-info"> Non verifer</span>
                            @elseif($supleant['data']->etat==0)
                            <span class="badge badge-boxed  badge-danger"> Rejeter</span>
                            @else
                            <span class="badge badge-boxed  badge-success"> Valider</span>
                            @endif </td>
                            <td>{{$supleant['data']->commentaire}}</td>

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
<div class="page-break"></div>
@endforeach
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
