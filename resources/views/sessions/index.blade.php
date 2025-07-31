@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="py-3 mb-4">
        <h4 class="fw-bold"><span class="text-muted fw-light">TABLEAU DES SESSIONS</h4>
        <a class="btn btn-outline-primary" href="{{ route('sessions.create') }}">Ajouter</a>
      </div>
      <!-- Hoverable Table rows -->
      <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Liste des sessions</h5>
            {{-- <a class="btn btn-outline-primary" href="{{ route('sessions.index') }}">Voir la liste</a> --}}

            @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
        </div>
        
        @if($sessions->isEmpty())
          <p class="card-header">Aucune Session pour l'instant. <br> Cliquez sur le bouton <b>AJOUTER</b> pour ajouter une formation</p>
        @else
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>N°</th>
                <th>Formation</th>
                <th>Code</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Nbre Place</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($sessions as $session)
              <tr>
                <td>1</td>
                <td>{{ Str::limit($session->formation->nom, 25) }}</td>
                <td>{{ $session->code}}</td>
                <td>{{ \Carbon\Carbon::parse($session->date_debut)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($session->date_fin)->format('d-m-Y') }}</td>
                <td>{{ $session->nbre_place}}</td>
                <td>
                  <a class="" href="{{ route('sessions.show', $session->id) }}"><i class="bx bx-user-plus"></i></a>
                  <a class="d-inline" style="color:limegreen;" href="{{ route('sessions.edit', $session->id) }}"><i class="bx bx-edit-alt me-1"></i></a>
                  <form class="d-inline" action="{{ route('sessions.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
                    @csrf
                    @method('DELETE')
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
      <!--/ Hoverable Table rows -->
    </div>
    <!-- / Content -->


@endsection