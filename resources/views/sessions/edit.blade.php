@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Session</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Modifier la Session </h5>
                        <a class="btn btn-outline-primary" href="{{ route('sessions.index') }}">Voir la liste</a>
                    </div>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>

                    <div class="card-body">
                    <form action="{{ route('sessions.update', $session->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="formation_id" class="form-label">Formation</label>
                            <select name="formation_id" id="formation_id" class="form-control">
                                @foreach($formations as $formation)
                                    <option value="{{ $formation->id }}" @if($session->formation_id == $formation->id) selected @endif>{{ $formation->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $session->date_debut }}" required>
                            </div>
                            <div class="col-md-6" >
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $session->date_fin }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nbreplaces" class="form-label">Nbre de places</label>
                            <input type="number" name="nbreplaces" id="nbreplaces" class="form-control" value="{{ $session->nbre_place }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Valider</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
    <!-- / Content -->

    
@endsection