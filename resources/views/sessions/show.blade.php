@extends('layouts.template')

@section('content')


<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y ">
        <div class="py-3 mb-4">
            <h3>Formation: {{ $session->formation->nom }}</h3>
            <h4 class="fw-bold"><span class="text-muted">Code Session: {{ $session->code }}</h4>
            <h5>Date de début: {{ \Carbon\Carbon::parse($session->date_debut)->format('d-m-Y') }} / Date de fin: {{ \Carbon\Carbon::parse($session->date_fin)->format('d-m-Y') }}</h5>      
            <a class="btn btn-outline-primary" href="{{ route('sessions.index') }}">Retour Aux Sessions</a>
        </div>
        <div class="card">
            <h3 class="card-header">Auditeurs inscrits</h3>

            @if($session->auditeurs->isEmpty())
                <p class="card-header">Aucun Auditeur  inscrire pour l'instant. <br> Scrollez vers le bas <i class="bx bx-down-arrow-circle me-1"></i> pour ajouter un auditeur</p>
            @else
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>N°</th>
                            <th>NOM et PRENOM</th>
                            <th>EMAIL</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            
                            @foreach($session->auditeurs as $index => $auditeur)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span style="text-transform:uppercase">{{ $auditeur->nom }} {{ $auditeur->prenom }}</span></td>
                                <td>{{ $auditeur->email }}</td>
                                <td>
                                    <a class="" href="{{ route('versements.par_auditeur_session', ['auditeur_id' => $auditeur->id, 'session_id' => $session->id]) }}"><i class="bx bx-money me-1"></i></a>
                                    <a class="" style="color:limegreen;" href=""><i class="bx bx-edit me-1"></i></a>
                                    <form class="d-inline" action="{{ route('inscriptions.desinscrire') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="auditeur_id" value="{{ $auditeur->id }}">
                                        <input type="hidden" name="session_id" value="{{ $session->id }}">
                                        <button type="submit" style="background:none; border:none; cursor:pointer; color:red;">
                                            <i class="bx bx-trash me-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="card mt-3">
            <h3 class="card-header">Inscrire un auditeur</h3>
            <div class="card-body">
                <form action="{{ route('inscriptions.inscrire') }}" method="POST">
                    @csrf
                    {{-- <input type="text" name="resteapayer" value="{{ $session->formation->prix }}"> --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="nomauditeur">Nom</label>
                            <input type="text" class="form-control" id="nomauditeur" name="nom" placeholder="Entrer le nom" />
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="prenomauditeur">Prenom</label>
                            <input type="text" class="form-control" id="prenomauditeur" name="prenom" placeholder="Entrer le prenom" />
                            @error('prenom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="emailauditeur">Email</label>
                            <input type="email" class="form-control" id="emailauditeur" name="email" placeholder="Entrer le mail " />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contactauditeur">Contact</label>
                            <input type="text" class="form-control" id="contactauditeur" name="contact" placeholder="Entrer le contact" />  
                            @error('contact')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="etseauditeur">Entreprise</label>
                        <input type="text" class="form-control" id="etseauditeur" name="entreprise" placeholder="Entrer le nom de l'entreprise"/>
                        @error('entreprise')
                            <div class="text-danger">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <input type="hidden" name="session_id" value="{{ $session->id }}">
    
                    <button type="submit" class="btn btn-primary">Inscrire</button>
                    <button type="reset" class="btn btn-danger">Annuler</button>
    
                </form>
            </div>
            
        </div>
</div>

@endsection
