@extends('layouts.template')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">AUDITEUR</h4>
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
                    <h5 class="mb-0">Ajouter un Nouveau Auditeur</h5>
                    <a class="btn btn-outline-primary" href="{{ route('auditeurs.index') }}">Voir la liste</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('auditeurs.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nomauditeur">Nom</label>
                                <input type="text" class="form-control" id="nomauditeur" name="nom" placeholder="Entrer le nom" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="prenomauditeur">Prenom</label>
                                <input type="text" class="form-control" id="prenomauditeur" name="prenom" placeholder="Entrer le prenom" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="emailauditeur">Email</label>
                                <input type="email" class="form-control" id="emailauditeur" name="email" placeholder="Entrer le mail " />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contactauditeur">Contact</label>
                                <input type="text" class="form-control" id="contactauditeur" name="contact" placeholder="Entrer le contact" />  
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="etseauditeur">Entreprise</label>
                            <input type="text" class="form-control" id="etseauditeur" name="entreprise" placeholder="Entrer le nom de l'entreprise"/>
                        </div>
                        {{-- <div class="mb-3">
                        <label class="form-label" for="basic-default-email">Formation</label>
                        <select name="" id="" class="form-control">
                            <option selected disabled>Choisir une formation</option>
                            <option value="">Ressources Humaines </option>
                            <option value="">Informatique Français</option>
                            <option value="">Français</option>
                            <option value="">Anglais</option>
                        </select>
                        </div> --}}
            
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