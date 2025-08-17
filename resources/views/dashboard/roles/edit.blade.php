@extends('layouts.template')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">ROLES</h4>
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
                    <h5 class="mb-0">Ajouter un rôle</h5>
                    <a class="btn btn-outline-primary" href="{{ route('roles.index') }}">Voir la liste</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label" for="titre">Titre</label>
                                <input type="text" class="form-control" id="titre" name="name" value="{{ $role->name }}" required />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            @foreach ($permissions as $permission)
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}/>
                                <label class="form-label">{{ $permission->name }}</label>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection