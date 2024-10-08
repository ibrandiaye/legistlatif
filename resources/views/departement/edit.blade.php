{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('departement.index') }}" >RETOUR</a></li>

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

        {!! Form::model($departement, ['method'=>'PATCH','route'=>['departement.update', $departement->id]]) !!}
            @csrf
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION Département</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                    <input type="text" name="nom" class="form-control" value="{{$departement->nom}}"   required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nombre decandidat</label>
                                    <input type="number" name="nb" class="form-control" value="{{$departement->nb}}"   required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <label>Région</label>
                                    <select class="form-control" name="region_id" required="">
                                        @foreach ($regions as $region)
                                        <option {{old('region_id', $departement->region_id) == $region->id ? 'selected' : ''}}
                                            value="{{$region->id}}">{{$region->nom}}</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>Territoire</label>
                                    <select class="form-control" name="is_diaspora" required="">
                                        <option value="">Selectionner</option>
                                        <option value="0"  {{ $departement->is_diaspora == 0 ? 'selected' : ''}}>National</option>
                                        <option value="1" {{ $departement->is_diaspora == 1  ? 'selected' : ''}}>Etrangers</option>
                                    </select>
                                </div>
                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> MODIFIER</button>
                                    </center>
                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection
