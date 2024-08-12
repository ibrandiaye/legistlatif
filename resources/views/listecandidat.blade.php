<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Zoter - Responsive Bootstrap 4 Admin Dashboard</title>
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

                html{
                    background: white;
                }
        </style>


    <!-- Begin page -->

<div class="row">
        <div class="col-sm-6">
          REPUBLIQUE DU SENEGAL<br>
          *********************<br>
          Un Peuple _ Un But _Une Foi<br>
          *********************<br>
          MINISTERE DE L’INTERIEUR<br>
          ************************<br>
          DIRECTION GENERALE DES ELECTIONS<br>
          ********************************<br>
          DIRECTION DES OPERATIONS ELECTORALES<br>
          {{--  <img src="assets/image/dge.jpg">  --}}
        </div>
        <div class="col-sm-2">

        </div>
        <div class="col-sm-4">
            <h4>ELECTION PRESIDENTIELLE  DU 25 FEVRIER 2024</h4>

        </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center"><h6>LV: {{ $nbCentreVote  }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   BV: {{ $nbBureauVote  }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Electeurs: {{ $nbElecteurs }}</h6></div>

</div>
    <div class="col-lg-12">
        <table   class="table table-bordered  table-striped text-center">
            <thead>
                <tr>
                    <th>NOMENCLATURE DES MATERIELS</th>
                    <th>CLE DE REPARTITION PAR BV</th>
                    <th>DOTATION</th>
                   {{--   <th>RESERVE</th>  --}}
                    <th>OBSERVATION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiels as $materiel)
                @foreach ($lourdsAfficher as $afficher)
                @if($afficher==$materiel->id)
                    <tr>
                        <td>{{ $materiel->nomenclature }}</td>
                        <td>{{ $materiel->nb }}</td>
                        <td>
                            @if ($materiel->partition=='lv')
                               {{ $materiel->nb *$nbCentreVote + (round(($nbCentreVote*$materiel->stock)/100))}}
                            @elseif ($materiel->partition=='bv')
                                {{ $materiel->nb *$nbBureauVote + (round(($nbBureauVote*$materiel->stock)/100))}}
                            @elseif ($materiel->partition=='electeur')
                            {{ $materiel->nb *$nbElecteurs + (round(($nbElecteurs*$materiel->stock)/100))}}
                            @endif</td>
                        <td> </td>
                    </tr>
                    @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>

</div>


<div class="page-break"></div>
        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    </body>
</html>
