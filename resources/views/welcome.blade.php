<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Election 2024</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{asset('images/favicon.ico') }}">

        <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <script src="{{asset('js/jquery.min.js') }}"></script>
        <!-- DataTables -->
        <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />


        @yield("css")

    </head>


    <body class="fixed-left">

        <!-- Loader -->
       {{--   <div id="preloader"><div id="status"><div class="spinner"></div></div></div>  --}}

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Zoter</a>-->
                        <a href="index.html" class="logo">
                            <img src="{{ asset('images/logo.png') }}" alt="" class="logo-large" style="height: 60px;">
                        </a>
                    </div>
                </div>

                <div class="sidebar-inner niceScrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Menu</li>
                            @if(Auth::user()->role=='admin')
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Region </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('region.create') }}"> Ajouter</a></li>
                                    <li><a href="{{ route('region.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Departement </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('departement.create') }}"> Ajouter</a></li>
                                    <li><a href="{{ route('departement.index') }}"> Lister</a></li>
                                </ul>
                            </li>
                           
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Liste </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('liste.create') }}"> Ajouter</a></li>
                                    <li><a href="{{ route('liste.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('listedepartemental.index') }}">
                                <i class="mdi mdi-airplay"></i> Liste Candidat
                            </a>
                            </li>
                           {{--  <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Liste National </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('listenational.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('listenational.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Liste Departemental </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('listedepartemental.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('listedepartemental.index') }}">Lister</a></li>
                                </ul>
                            </li> --}}
                            <li>
                                <a href="#"><button type="button" class="btn btn-primary waves-e	ffect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg">Chercher</button>
                                </a>
                            </a>
                            </li>
                           
                            @endif
                            @if(Auth::user()->role=="candidats")
                            <li>
                                <a href="{{ route('home') }}">
                                <i class="mdi mdi-airplay"></i> Tableau de bords
                            </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('listedepartemental.create') }}">
                                <i class="mdi mdi-airplay"></i> Inserer Candidtats
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('liste.tableau',["type"=>1]) }}">
                                <i class="mdi mdi-airplay"></i> Liste Candidats
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('liste.tableau',["type"=>2]) }}">
                                <i class="mdi mdi-airplay"></i> Formulaire
                            </a>
                            </li>
                            <li>
                                <a href="{{route('liste.candidat')}}">
                                <i class="mdi mdi-airplay"></i> Rechercher
                            </a>
                            </li>
                            <li>
                                <a href="{{route('supprimer.voir')}}">
                                <i class="mdi mdi-airplay"></i> Supprimer
                            </a>
                            </li>
                           {{--  <li>
                                <a href="{{ route('listedepartemental.index') }}">
                                <i class="mdi mdi-airplay"></i> Liste Majoritaire
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('listenational.index') }}">
                                <i class="mdi mdi-airplay"></i> Liste Propotionnel
                            </a>
                            </li> --}}
                            @endif
                           
                            @if(Auth::user()->role=='admin')
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Compte </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('user.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('user.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            @endif
                            {{-- <li>
                                <a href="{{ route('home') }}">
                                <i class="mdi mdi-airplay"></i> Tableau de bords
                            </a>
                            </li>


                            <li>
                                <a href="{{ route('carte.index') }}">
                                <i class="mdi mdi-airplay"></i> Carte Electorale National
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('carted.index') }}">
                                <i class="mdi mdi-airplay"></i> Carte Electorale Diaspora
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('generer.decharge') }}">
                                <i class="mdi mdi-airplay"></i> Decharge
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('generer.decharged') }}">
                                <i class="mdi mdi-airplay"></i> Decharge Diaspora
                            </a>
                            </li>
                            <li>
                                <a href="{{ route('approvisionnement.index') }}">
                                <i class="mdi mdi-airplay"></i> Mouvement Materiels Lourd
                            </a>
                            </li>

                            <li>
                                <a href="{{ route('approvisionnementl.index') }}">
                                <i class="mdi mdi-airplay"></i> Mouvement Materiels Legers
                            </a>
                            </li>
                             <li>
                                <a href="{{ route('approvisionnementd.index') }}">
                                <i class="mdi mdi-airplay"></i> Mouvement Materiels Lourd Diaspora
                            </a>
                            </li>

                            <li>
                                <a href="{{ route('approvisionnementld.index') }}">
                                <i class="mdi mdi-airplay"></i> Mouvement Materiels Legers Diaspora
                            </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Centre de Vote </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('centrevote.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('centrevote.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Lieu de vote </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('lieuvote.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('lieuvote.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Centre de Vote Diaspora</span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('centrevoted.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('centrevoted.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Lieu de vote Diaspora </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('bureauvoted.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('bureauvoted.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Materiel Lourds </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('materiel.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('materiel.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-circle"></i><span>Materiel Legers </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('leger.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('leger.index') }}">Lister</a></li>
                                </ul>
                            </li>
                           
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Arrondissement </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('arrondissement.create') }}"> Ajouter</a></li>
                                    <li><a href="{{ route('arrondissement.index') }}"> Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Commune </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('commune.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('commune.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Juridiction </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('juridiction.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('juridiction.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Pays </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('pays.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('pays.index') }}">Lister</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span>Localite </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('localite.create') }}"> Ajoute</a></li>
                                    <li><a href="{{ route('localite.index') }}">Lister</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">
                                <!-- language-->

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ asset('images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Bienvenue {{Auth::user()->name}}</h5>
                                        </div>

                                       <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="mdi mdi-logout m-r-5 text-muted"></i>{{ __('Deconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form> 
                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-light waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                           @yield("content")

                           <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Large modal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form action="{{ route('search.candidat') }}" method="POST">
                                        @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Numero Carte d'identite</label>
                                                    <input type="text" class="form-control" id="field-3"   name="cni">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group no-margin">
                                                    <label for="field-7" class="control-label">Numero Electeur</label>
                                                    <input type="text" name="numelec" class="form-control" id="field-3" >                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        <button type="submint" class="btn btn-primary">Chercher</button>
                                    </div>
                                    </form>        
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <footer class="footer">
                    © 2024 DGE.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{asset('js/popper.min.js') }}"></script>
        <script src="{{asset('js/bootstrap.min.js') }}"></script>
        <script src="{{asset('js/modernizr.min.js') }}"></script>
        <script src="{{asset('js/detect.js') }}"></script>
        <script src="{{asset('js/fastclick.js') }}"></script>
        <script src="{{asset('js/jquery.blockUI.js') }}"></script>
        <script src="{{asset('js/waves.js') }}"></script>
        <script src="{{asset('js/jquery.nicescroll.js') }}"></script>
        <!-- Required datatable js -->
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.j') }}s"></script>

        <script src="{{asset('plugins/select2/select2.min.js') }}" type="text/javascript"></script>

        <!-- Datatable init js -->
        <script src="{{asset('pages/datatables.init.js') }}"></script>
        @yield("script")

        <!-- App js -->
        <script src="{{asset('js/app.js') }}"></script>

    </body>
</html>
