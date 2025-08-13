@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="py-3 mb-4">
            <h4 class="fw-bold"><span class="text-muted fw-light">TABLEAU DES VERSEMENTS</span></h4>
            <h5>Nom Auditeur: <span style="text-transform:uppercase">{{ $auditeur->nom }} {{ $auditeur->prenom }}</span></h5>
            <h5>Formation: {{ $session->formation->nom }}</h5>
            <h5>Code Session: {{ $session->code }}</h5>
            {{-- <h6>Coût Formation: {{ $session->formation->prix }} FCFA / 
                @if($versements->isEmpty())
                Reste à payer: {{ $session->formation->prix }} FCFA
                @else
                 <p>1000 F</p>
                @endif 
            </h6> --}} 

            <h6>
                Coût Formation: {{ $session->formation->prix }} FCFA / 
                @if($versements->isEmpty())
                    Reste à payer: {{ $session->formation->prix }} FCFA
                @else
                    
                    Reste à payer: {{ $reste_a_payer }}  FCFA
                    
                @endif 
            </h6>

            <p>Date de début: {{ $session->date_debut }}  /  Date de fin: {{ $session->date_fin }}</p>
            @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <a href="{{ route('sessions.show', $session->id) }}" class="btn btn-outline-primary">RETOUR A LA LISTE</a>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des versements</h5>
                <a id="addVersementBtn" href="{{ route('versements.createParAuditeurEtSession', ['auditeur_id' => $auditeur->id, 'session_id' => $session->id]) }}" class="btn btn-outline-primary mt-3">Ajouter</a>
                
            </div>
        
            @if($versements->isEmpty())
                <p class="p-3">Aucun versement n'a été effectué par cet auditeur pour cette session.</p>
            @else
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Intitulé</th>
                                <th>Montant</th>
                                {{-- <th>Reste à Payer</th> --}}
                                <th>Date de Versement</th>       
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($versements as $key => $versement)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $versement->description }}</td>
                                <td>{{ $versement->montant }} FCFA</td>
                                {{-- <td>{{ $versement->reste_a_payer }} FCFA</td> --}}
                                <td>{{ $versement->date_versement }}</td>
                                <td>
                                    {{-- <a href="{{ route('versements.edit', $versement->id) }}" class="btn btn-warning btn-sm">Editer</a> --}}
                                    <form class="d-inline" action="{{ route('versements.destroy', $versement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce versement ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                    </form>
                                    {{-- <a href="{{ route('versement.destroy') }}" class="btn btn-danger btn-sm"></a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    
    </div>
</div>
@endsection

