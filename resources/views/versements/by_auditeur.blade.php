@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="py-3 mb-4">
        <h4 class="fw-bold"><span class="text-muted fw-light">TABLEAU DES VERSEMENTS</h4>
        <a class="btn btn-outline-primary" href="{{ route('versements.createForAuditeur', $auditeur->id) }}">Ajouter</a>
      </div>
      <!-- Hoverable Table rows -->
      <div class="card">
        <h5 class="card-header">Versements pour l'Auditeur: {{ $auditeur->nom }} {{ $auditeur->prenom }}</h5>

        @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif

        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Formation</th>
                    <th>Montant</th>
                    <th>Date de Versement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($versements as $versement)
                <tr>
                    <td>{{ $versement->id }}</td>
                    <td>{{ $versement->formation->nom }}</td>
                    <td>{{ $versement->montant }} FCFA</td>
                    <td>{{ $versement->date_versement }}</td>
                    <td>
                    <td>
                        <a class="" href="{{ route('') }}"><i class="bx bx-archive-in me-1"></i></a>
                        <a class="" href="{{ route('versements.edit', $versement->id) }}"><i class="bx bx-edit-alt me-1"></i></a>
                        <a class="" href="javascript:void(0);"><i class="bx bx-trash me-1"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Hoverable Table rows -->
    </div>
    <!-- / Content -->


@endsection