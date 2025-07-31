@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">FORMATION</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ajouter une Nouvelle Formation </h5>
                        <a class="btn btn-outline-primary" href="{{ route('formations.index') }}">Voir la liste</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('formations.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="nomform">Nom de formation</label>
                                    <input type="text" class="form-control" id="nomform" name="nomform" placeholder="Entrer le nom de la formation" />
                                    @error('nomform')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="prixform">Prix</label>
                                    <input type="text" class="form-control" id="prixform" name="prixform" placeholder="Entrer le coût de la formation"/>
                                    @error('prixform')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="dureeform">Durée</label>
                                    <input type="number" class="form-control" id="dureeform" name="dureeform" placeholder="Choisir le nombre d'heures"/>
                                    @error('dureeform')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="montant_inscrip">Montant Inscription</label>
                                    <input type="text" class="form-control" id="montant_inscrip" name="montant_inscrip" placeholder="Entrer le montant de l'inscription"/>
                                    @error('montant_inscrip')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="descform">Description</label>
                                <textarea class="form-control" id="descform" name="descform" placeholder="Entrer le nom de la formation"></textarea>
                                @error('descform')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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