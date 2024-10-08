{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 --}}

 @extends('welcome')
@section('title', '| user')


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">

                    <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>

                    </ol>
                </div>
                    <h4 class="page-title">

                        @if(Auth::user()->role=="admin") DGE
                        @else
                        {{Auth::user()->liste->nom}}
                         @endif
                    </h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <h5>Total Homme : <span class="badge badge-success">{{$nbHommeNational + $nbHommeDepartement }}</span>  &nbsp;&nbsp; Total Femme : <span class="badge badge-success">{{$nbFemmeNational + $nbFemmeDepartement }}</span>
        Entre 18 et 35 ans :  <span class="badge badge-success">{{ $entre18_35 }}</span> &nbsp;&nbsp;&nbsp;&nbsp; Entre 36 et 45 :  <span class="badge badge-success">{{ $entre35_45 }}</span> &nbsp;&nbsp;&nbsp;&nbsp; Plus de  45 :  <span class="badge badge-success">{{ $entre45_plus }}</span>
    </h5>

    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{$nbHommeNational}}</h5>
                                <p class="mb-0 text-muted">NB Homme Propotionnel</p>
                            </div>
                        </div>

                    </div>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-3 ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{ $nbFemmeNational }}</h5>
                                <p class="mb-0 text-muted">NB Femme Propotionnel</p>
                            </div>
                        </div>

                    </div>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{ $nbHommeDepartement }}</h5>
                                <p class="mb-0 text-muted">NB Homme Majoritaire</p>
                            </div>
                        </div>
                    </div>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-eye"></i>
                            </div>
                        </div>
                         <div class="col-9 align-self-center text-right">
                            <div class="m-l-10 ">
                                <h5 class="mt-0">{{ $nbFemmeDepartement }}</h5>
                                <p class="mb-0 text-muted">NB Femme Majoritaire</p>
                            </div>
                        </div>

                    </div>

                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

    </div>
    <div class="row">

        @foreach ($listes as $item)
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
                                <h5 class="mt-0"></h5>
                                <a href="{{ route('liste.admin', ['id'=>$item->id]) }}"><p class="mb-0 text-muted">{{$item->nom}} </p></a> {{--<span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height:3px;">
                        <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        @endforeach

    </div>



@endsection
