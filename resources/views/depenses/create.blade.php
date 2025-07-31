@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DEPENSES</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ajouter une Nouvelle Depense </h5>
                        <a class="btn btn-outline-primary" href="{{ route('depenses.index') }}">Voir la liste</a>
                    </div>

                    <div class="card-body">
                    <form action="{{ route('depenses.store') }}" method="POST">
                        @csrf 
                        <input type="hidden" class="form-control" id="caisse_id" name="caisse_id" value="1"/>                
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="date_depense">Date</label>
                                <input type="date" class="form-control @error('date_depense') is-invalid @enderror" id="date_depense" name="date_depense"/>
                                @error('date_depense')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="montant">Montant</label>
                                <input type="text" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" placeholder="Entrer le montant"/>
                                @error('montant')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="descform">Description</label>
                            <select class="form-select" name="description" id="description">
                                <option value="ACHAT MOBILIER">ACHAT MOBILIER</option>
                                <option value="Appointements salaires et commissions">Appointements salaires et commissions</option>
                                <option value="Assurance Multirisque">Assurance Multirisque</option>
                                <option value="Autres charges exceptionnelles">Autres charges exceptionnelles</option>
                                <option value="Autres charges externes">Autres charges externes</option>
                                <option value="Autres charges externes frais de recrutement du personnel">Autres charges externes frais de recrutement du personnel</option>
                                <option value="Autres charges externes missions">Autres charges externes missions</option>
                                <option value="Autres charges externes réceptions">Autres charges externes réceptions</option>
                                <option value="Autres entretiens et réparations">Autres entretiens et réparations</option>
                                <option value="Autres frais de transport entre etablissements">Autres frais de transport entre etablissements</option>
                                <option value="Autres frais de transport transports administratifs">Autres frais de transport transports administratifs</option>
                                <option value="Autres frais de transport voyages et déplacements">Autres frais de transport voyages et déplacements</option>
                                <option value="Autres indemnités et avantages divers">Autres indemnités et avantages divers</option>
                                <option value="Autres dons">Autres dons</option>
                                <option value="Cadeaux à la clientèle">Cadeaux à la clientèle</option>
                                <option value="Catalogues- imprimés publicitaires">Catalogues- imprimés publicitaires</option>
                                <option value="Charges diverses">Charges diverses</option>
                                <option value="Charges diverses dons">Charges diverses dons</option>
                                <option value="CHARGES LOCATIVES CABINET SAGES">CHARGES LOCATIVES CABINET SAGES</option>
                                <option value="CHARGES LOCATIVES CIAD">CHARGES LOCATIVES CIAD</option>
                                <option value="Charges sociales sur rémunération du personnel national">Charges sociales sur rémunération du personnel national</option>
                                <option value="Congés payés">Congés payés</option>
                                <option value="Dotations aux provisions pour risques et charges">Dotations aux provisions pour risques et charges</option>
                                <option value="Entretien et réparations des biens mobiliers">Entretien et réparations des biens mobiliers</option>
                                <option value="Entretien, confection et réparations des biens immobiliers">Entretien, confection et réparations des biens immobiliers</option>
                                <option value="Formation professionnelle continue">Formation professionnelle continue</option>
                                <option value="Frais bancaires autres frais bancaires">Frais bancaires autres frais bancaires</option>
                                <option value="Frais de formation du personnel">Frais de formation du personnel</option>
                                <option value="Frais de télécommunications frais de téléphone">Frais de télécommunications frais de téléphone</option>
                                <option value="Frais d'organisation DE CEREMONIE"></option>
                                <option value="Indemnités de transport">Indemnités de transport</option>
                                <option value="Internet">Internet</option>
                                <option value="Location de materiels et outillage">Location de materiels et outillage</option>
                                <option value="Locations et charges locatives diverses">Locations et charges locatives diverses</option>
                                <option value="Loyer CABINET SAGES">Loyer CABINET SAGES</option>
                                <option value="LOYER SALLE CIAD ">LOYER SALLE CIAD </option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Mission employés CABINET SAGES RH">Mission employés CABINET SAGES RH</option>
                                <option value="Primes et gratifications">Primes et gratifications</option>
                                <option value="Provisions Techniques">Provisions Techniques</option>
                                <option value="PROVISON POUR CONGE PAYE">PROVISON POUR CONGE PAYE</option>
                                <option value="Publications">Publications</option>
                                <option value="Publicité-publications-relations">Publicité-publications-relations</option>
                                <option value="Redevances pour logiciels">Redevances pour logiciels</option>
                                <option value="Taxes d'apprentissage">Taxes d'apprentissage</option>
                                <option value="Taxes sur appointements et salaires">Taxes sur appointements et salaires</option>
                                <option value="Transports de plis">Transports de plis</option>
                                <option value="REDEVANCES A TIERS">REDEVANCES A TIERS</option>
                            </select>
                            {{-- <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Decrivez la depense"></textarea>
                            @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
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