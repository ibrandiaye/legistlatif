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
                        <li class="breadcrumb-item active"><a href="{{ route('user.index') }}" >RETOUR</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        {!! Form::model($user, ['method'=>'PATCH','route'=>['user.update', $user->id]]) !!}
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
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}"   required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>email </label>
                                        <input type="email" name="email"  value=" {{$user->email }}" class="form-control"required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Liste</label>
                                    <select class="form-control" name="liste_id" required="">
                                        @foreach ($listes as $liste)
                                        <option {{old('liste_id', $user->liste_id) == $liste->id ? 'selected' : ''}}
                                            value="{{$liste->id}}">{{$liste->nom}}</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>Role</label>
                                    <select class="form-control" name="role" required="">
                                        <option value="">Selectionner</option>
                                        <option value="admin" {{$user->role=="admin" ? 'selected' : ''}}>Admin</option>
                                        <option value="candidats"  {{$user->role=="candidats" ? 'selected' : ''}}>candidats</option> 
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
