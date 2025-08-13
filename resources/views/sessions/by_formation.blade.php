@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="py-3 mb-4">
        <h4 class="fw-bold"><span class="text-muted fw-light">TABLEAU DES SESSIONS</h4>

        @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif

      </div>
      <!-- Hoverable Table rows -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>NOM DE LA FORMATION: {{ $formation->nom }}</h5>

          <a class="btn btn-outline-primary" href="{{ route('sessions.createForFormation', $formation->id) }}">Ajouter à la formation</a>
          
        </div>

        @if($sessions->isEmpty())
          <p class="card-header">Aucune Session pour l'instant. <br> Cliquez sur le bouton <b>AJOUTER A LA FORMATION</b> pour ajouter une session</p>
        @else
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Code</th>
                      <th>Date de Debut</th>
                      <th>Date de Fin</th>
                      <th>Nbre de place</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @foreach($sessions as $key=>$session)
                  <tr>
                      <td>{{ $key + 1}}</td>
                      <td>{{ $session->code}}</td>
                      <td>{{ $session->date_debut }}</td>
                      <td>{{ $session->date_fin }}</td>
                      <td>{{ $session->nbre_place }}</td>
                      <td>
                        <a class="d-inline" href="{{ route('sessions.show', $session->id) }}"><i class="bx bx-user-plus"></i></a>
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