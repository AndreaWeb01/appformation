@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span></h4>
        <!-- Basic Layout -->
        <p>Formation: {{ $session->formation->nom }} </p>
        <p>Session: {{ $session->code }} </p>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Modifier le Versement pour {{ $auditeur->nom }} {{ $auditeur->prenom }}</h5>
                        
                        <a class="btn btn-outline-primary" href="{{ route('versements.index') }}">Voir la liste</a>
                    </div>

                    <div class="card-body">
                    <form action="{{ route('versements.update', $versement->id) }}" method="POST">
                        @csrf

                        @method('PUT')

                        <input type="hidden" name="auditeur_id" value="{{ $auditeur->id }}">
                        <input type="hidden" name="session_id" value="{{ $session->id }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="description">Intitulé</label>
                                <select name="description" id="description" class="form-control">
                                    <option selected disabled>Selectionner l'intitulé du versement</option>
                                    <option value="Inscription" {{ $versement->description == 'Inscription' ? 'selected' : '' }}>Inscription</option>
                                    <option value="1er Versement" {{ $versement->description == '1er Versement' ? 'selected' : '' }}>1er Versement</option>
                                    <option value="2eme Versement" {{ $versement->description == '2eme Versement' ? 'selected' : '' }}>2eme Versement</option>
                                    <option value="3eme Versement" {{ $versement->description == '3eme Versement' ? 'selected' : '' }}>3eme Versement</option>
                                    <option value="4eme Versement" {{ $versement->description == '4eme Versementn' ? 'selected' : '' }}>4eme Versement</option>
                                </select>
                                
                            </div> 
                            <div class="col-md-6">
                                <label for="montant">Montant</label>
                                <input type="text" name="montant" id="montant" value="{{ $versement->montant }}" class="form-control @error('montant') is-invalid @enderror" >
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6" >
                                <label for="date_versement">Date de Versement</label>
                                <input type="date" name="date_versement" id="date_versement" value="{{ $versement->date_versement }}" class="form-control @error('date_versement') is-invalid @enderror" >
                            </div>
                            <div class="col-md-6">
                                <label for="mode_paiement">Mode de paiement</label>
                                <select name="mode_paiement" id="mode_paiement" class="form-control">
                                    <option selected disabled>Choisir un mode paiement</option>
                                    <option value="especes" {{ $versement->mode_paiement == 'especes' ? 'selected' : '' }}>Espèces</option>
                                    <option value="carte bancaire" {{ $versement->mode_paiement == 'ecarte bancaire' ? 'selected' : '' }}>Carte bancaire</option>
                                    <option value="paiement mobile" {{ $versement->mode_paiement == 'paiement mobile' ? 'selected' : '' }}>Paiement mobile</option>
                                    <option value="virement bancaire" {{ $versement->mode_paiement == 'virement bancaire' ? 'selected' : '' }}>Virement bancaire</option>
                                </select>
                            </div>
                            
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