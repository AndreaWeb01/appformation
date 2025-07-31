@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">ENTREES</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ajouter une Nouvelle Entrée </h5>
                        <a class="btn btn-outline-primary" href="{{ route('entrees.index') }}">Voir la liste</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('entrees.store') }}" method="POST">
                            @csrf          
                            <input type="hidden" class="form-control" id="caisse_id" name="caisse_id" value="1"/>      
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="date_entree">Date</label>
                                    <input type="date" class="form-control @error('date_entree') is-invalid @enderror" id="date_entree" name="date_entree"/>
                                    @error('date_entree')
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
                                <label class="form-label" for="description">Description</label>
                                <select class="form-select" name="description" id="description">
                                    <option value="Frais de participation à des ateliers ou séminaires">Frais de participation à des ateliers ou séminaires</option>
                                    <option value="Cours en ligne ou modules e-learning">Cours en ligne ou modules e-learning</option>
                                    <option value="Subventions publiques ou privées pour des projets de formation">Subventions publiques ou privées pour des projets de formation</option>
                                    <option value="Aides de l'État pour des programmes de formation spécifiques">Aides de l'État pour des programmes de formation spécifiques</option>
                                    <option value="Conseils et consulting en formation">Conseils et consulting en formation</option>
                                    <option value="Développement de programmes de formation sur mesure">Développement de programmes de formation sur mesure</option>
                                    <option value="Évaluations et audits de compétences">Évaluations et audits de compétences</option>
                                    <option value="Manuels et livres de formation">Manuels et livres de formation</option>
                                    <option value="Abonnements">Abonnements</option>
                                    <option value="Abonnements à des plateformes de formation">Abonnements à des plateformes de formation</option>
                                    <option value="Revenus issus de collaborations avec d'autres entreprises ou institutions">Revenus issus de collaborations avec d'autres entreprises ou institutions</option>
                                    <option value="Co-organisation d'événements ou de formations">Co-organisation d'événements ou de formations</option>
                                    <option value="Location de salles de formation">Location de salles de formation</option>
                                    <option value="Frais d’adhésion à des clubs ou réseaux de formation">Frais d’adhésion à des clubs ou réseaux de formation</option>
                                    <option value="Frais pour l'obtention de certifications reconnues">Frais pour l'obtention de certifications reconnues</option>
                                    <option value="Projets de recherche financés par des institutions ou des entreprises">Projets de recherche financés par des institutions ou des entreprises</option>
                                    <option value="Programmes de formation financés par des organismes internationaux">Programmes de formation financés par des organismes internationaux</option>
                                    <option value="Honoraires pour des services de recrutement">Honoraires pour des services de recrutement</option>
                                    <option value="Frais de placement de candidats">Frais de placement de candidats</option>
                                    <option value="Revenus provenant de la gestion externalisation comptable pour des entreprises">Revenus provenant de la gestion externalisation comptable pour des entreprises</option>
                                    <option value="Revenus provenant de la gestion externalisation RH pour des entreprises">Revenus provenant de la gestion externalisation RH pour des entreprises</option>
                                    <option value="Revenus provenant de la gestion externalisation JURISTE  pour des entreprises">Revenus provenant de la gestion externalisation JURISTE  pour des entreprises</option>
                                    <option value="Frais de gestion des processus de formation externalisés">Frais de gestion des processus de formation externalisés</option>
                                    <option value="Frais de gestion et représentation au tribunal du travail">Frais de gestion et représentation au tribunal du travail</option>
                                    <option value="Revenus provenant de la sous-traitance à d'autres prestataires">Revenus provenant de la sous-traitance à d'autres prestataires</option>
                                    <option value="Frais de gestion et de coordination des sous-traitants">Frais de gestion et de coordination des sous-traitants</option>
                                </select>
                                {{-- <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Entrer le nom de l'entrée"></textarea>
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