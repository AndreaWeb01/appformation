@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SESSION</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ajouter une Nouvelle Session </h5>
                        <a class="btn btn-outline-primary" href="{{ route('sessions.index') }}">Voir la liste</a>
                    </div>

                    <div class="card-body">
                    <form action="{{ route('sessions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="formation_id" class="form-label">Formation</label>
                            <select name="formation_id" id="formation_id" class="form-control">
                                @foreach($formations as $formation)
                                    <option selected disabled>Choisir une formation</option>
                                    <option value="{{ $formation->id }}">{{ $formation->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-6" >
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nbreplaces" class="form-label">Nbre de places</label>
                            <input type="number" name="nbreplaces" id="nbreplaces" class="form-control" placeholder="Entrer le nombre de places de la session" required>
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