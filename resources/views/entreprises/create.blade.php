@extends('layouts.template')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">ENTREPRISE</h4>
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
                    <h5 class="mb-0">Ajouter une nouvelle Entreprise</h5>
                    <a class="btn btn-outline-primary" href="{{ route('entreprises.index') }}">Voir la liste</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('entreprises.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrer l'email " />
                            </div>
                        </div>
                        <div class="row mb-3">
                            
                            <div class="col-md-6">
                                <label class="form-label" for="telephone">Telephone</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Entrer le telephone" />  
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="adresse">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer l'adresse" />  
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="etseauditeur">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" placeholder="Entrer le logo de l'entreprise"/>
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