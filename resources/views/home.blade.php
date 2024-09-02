@extends('welcome')
@section('title', '| user')


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">

                    <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('user.create') }}">ENREGISTRER user</a></li>
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


    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10">
                                <h5 class="mt-0">{{ $nbTitulaireNational}}</h5>
                                <a href="{{ route('state.by.scrutin', ['scrutin'=>'proportionnel']) }}"><p class="mb-0 text-muted">Liste Proportionnel Titulaire </p></a> {{--<span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>--}}
                            </div>
                        </div>                                                                                          
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-account-multiple-plus"></i>
                            </div>
                        </div>
                        <div class="col-9 text-right align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$nbSupleantNational}}</h5>
                                <a href="{{ route('state.by.scrutin', ['scrutin'=>'proportionnel']) }}"><p class="mb-0 text-muted">Liste Proportionnel Supleant</p></a>
                            </div>
                        </div>                                                                                                                
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="search-type-arrow"></div>
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round ">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$nbTitulaireNational + $nbSupleantNational}}</h5>
                                <a href="{{ route('state.by.scrutin', ['scrutin'=>'proportionnel']) }}"> <p class="mb-0 text-muted">Liste Proportionnel</p></a>
                            </div>
                        </div>                                                                
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10">
                                <h5 class="mt-0">{{ $nbTitulaireDepartemental}}</h5>
                                <a href="{{ route('state.by.scrutin', ['scrutin'=>'majoritaire']) }}"> <p class="mb-0 text-muted">Liste Majoritaire Titulaire </p></a> {{--<span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>--}}
                            </div>
                        </div>                                                                                          
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-account-multiple-plus"></i>
                            </div>
                        </div>
                        <div class="col-9 text-right align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$nbSupleantDepartemental}}</h5>
                                <a href="{{ route('state.by.scrutin', ['scrutin'=>'majoritaire']) }}"><p class="mb-0 text-muted">Liste Majoritaire Supleant</p></a>
                            </div>
                        </div>                                                                                                                
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="search-type-arrow"></div>
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round ">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$nbSupleantDepartemental + $nbTitulaireDepartemental}}</h5>
                                <a href="{{ route('state.by.scrutin', ['scrutin'=>'majoritaire']) }}"><p class="mb-0 text-muted">Total</p></a>
                            </div>
                        </div>                                                                
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->


      

@endsection
