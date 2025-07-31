@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="py-3 mb-4">
        <h4 class="fw-bold"><span class="text-muted fw-light">TABLEAU DES FORMATIONS</h4>
        <a class="btn btn-outline-primary" href="{{ route('formations.create') }}">Ajouter</a>
      </div>
      <!-- Hoverable Table rows -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>Liste des formations</h5>
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif

          {{-- <form action="{{ route('formations.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="date" class="form-control" name="date_filtre">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
          </form> --}}
        </div>
        
        @if($formations->isEmpty())
          <p class="card-header">Aucune Formation pour l'instant. <br> Cliquez sur le bouton <b>AJOUTER</b> pour ajouter une formation</p>
        @else
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nom</th></th>
                  <th>Durée</th>
                  <th>Prix</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($formations as $key=>$formation)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ Str::limit($formation->nom, 25)}}</td>
                  <td>{{ $formation->duree}} H</td>
                  <td>{{ $formation->prix}} FCFA</td>
                  <td>{{ Str::limit($formation->description, 25)}}</td>
                  <td>
                    <a class="d-inline" href="{{ route('sessions.by_formation', $formation->id) }}"><i class="bx bx-archive-in me-1"></i></a>
                    <a class="d-inline" style="color:limegreen;" href="{{ route('formations.edit', $formation->id) }}"><i class="bx bx-edit-alt me-1"></i></a>
                    <form class="d-inline" action="{{ route('formations.destroy', $formation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
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