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
                    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            @foreach ($permissions as $permission)

                            <div class="col-md-2">
                                <label class="form-label">
                                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}/>
                                    {{ $permission->name }}
                                </label>
                            </div>

                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection