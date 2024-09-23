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
                    <h4 class="page-title">{{Auth::user()->liste->nom}}</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row">
        @foreach (liste as $item)
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
                            <div class="m-l-10">
                                <h5 class="mt-0"></h5>
                                <a href=""><p class="mb-0 text-muted">{{$item->nom}} </p></a> {{--<span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>--}}
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
