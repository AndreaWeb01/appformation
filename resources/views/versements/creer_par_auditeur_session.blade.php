@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">VERSEMENTS</span></h4>
        <h5>Formation: {{ $session->formation->nom }} </h5>
        <h5>Code Session: {{ $session->code }} </h5>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ajouter un Nouveau Versement pour <span style="text-transform:uppercase">{{ $auditeur->nom }} {{ $auditeur->prenom }}</span></h5>
                        {{-- <a class="btn btn-outline-primary" href="{{ route('versements.index') }}">Voir la liste</a> --}}
                    </div>

                    <div class="card-body">

                        @php
                            // Vérifie si l'auditeur a déjà payé l'inscription pour cette session
                            $inscriptionPayee = $auditeur->versements()
                                ->where('session_id', $session->id)
                                ->where('description', 'Inscription')
                                ->exists();
                        @endphp



                        <form action="{{ route('versements.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="auditeur_id" value="{{ $auditeur->id }}">
                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                            
                            {{-- <input type="text" name="resteapayer" value="{{ $session->formation->nom - $montant }}"> --}}

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="description">Intitulé</label>
                                    <select name="description" id="description"class="form-control @error('description') is-invalid @enderror">
                                        <option selected disabled>Selectionner l'intitulé du versement</option>
                                        {{-- Afficher l'option "Inscription" uniquement si elle n'a pas été payée --}}
                                        @if(!$inscriptionPayee)
                                            <option value="Inscription">Inscription</option>
                                        @endif
                                        
                                        {{-- Autres versements : désactivés si inscription non payée --}}
                                        <option value="1er Versement" {{ !$inscriptionPayee ? 'disabled' : '' }}>1er Versement</option>
                                        <option value="2eme Versement" {{ !$inscriptionPayee ? 'disabled' : '' }}>2eme Versement</option>
                                        <option value="3eme Versement" {{ !$inscriptionPayee ? 'disabled' : '' }}>3eme Versement</option>
                                        <option value="4eme Versement" {{ !$inscriptionPayee ? 'disabled' : '' }}>4eme Versement</option>
                                                                
                                        {{-- <option value="Inscription">Inscription</option>
                                        <option value="1er Versement">1er Versement</option>
                                        <option value="2eme Versement">2eme Versement</option>
                                        <option value="3eme Versement">3eme Versement</option>
                                        <option value="4eme Versement">4eme Versement</option> --}}
                                    </select>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                                <div class="col-md-6">
                                    <label for="montant">Montant</label>
                                    <input type="text" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}">
                                    @error('montant')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6" >
                                    <label for="date_versement">Date de Versement</label>
                                    <input type="date" name="date_versement" id="date_versement" class="form-control @error('date_versement') is-invalid @enderror" value="{{ old('date_versement') }}">
                                    @error('date_versement')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="mode_paiement">Mode de paiement</label>
                                    <select name="mode_paiement" id="mode_paiement" class="form-control @error('mode_paiement') is-invalid @enderror">
                                        <option selected disabled>Choisir un mode paiement</option>
                                        <option value="especes" {{ old('mode_paiement') == 'especes' ? 'selected' : '' }}>Espèces</option>
                                        <option value="carte bancaire" {{ old('mode_paiement') == 'carte bancaire' ? 'selected' : '' }}>Carte bancaire</option>
                                        <option value="paiement mobile" {{ old('mode_paiement') == 'paiement mobile' ? 'selected' : '' }}>Paiement mobile</option>
                                        <option value="virement bancaire" {{ old('mode_paiement') == 'virement bancaire' ? 'selected' : '' }}>Virement bancaire</option>
                                        {{-- <option value="especes">Espèces</option>
                                        <option value="carte bancaire">Carte bancaire</option>
                                        <option value="paiement mobile">Paiement mobile</option>
                                        <option value="virement bancaire">Virement bancaire</option> --}}
                                    </select>
                                    @error('mode_paiement')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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