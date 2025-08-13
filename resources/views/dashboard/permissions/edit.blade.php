@extends('layouts.template')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">PERMISSIONS</h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ajouter une permission</h5>
                    <a class="btn btn-outline-primary" href="{{ route('permissions.index') }}">Voir la liste</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                         @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label" for="titre">Titre</label>
                                <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrer le titre" value="{{ $permission->name }}" required />
                                @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection