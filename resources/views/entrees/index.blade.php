@extends('layouts.template')

@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="py-3 mb-4">
        <h4 class="fw-bold"><span class="text-muted fw-light">TABLEAU DES ENTREES</h4>
        <a class="btn btn-outline-primary" href="{{ route('entrees.create') }}">Ajouter</a>
      </div>
      <!-- Hoverable Table rows -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>Liste des entrees</h5>
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif

          <form action="{{ route('entrees.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="date" class="form-control" name="date_filtre">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
          </form>
          
        </div>
        <H3>Somme total des versements: {{ $versementTotal }} FCFA</H3>
        
        @if($entrees->isEmpty())
          <p class="card-header">Aucune Entrée pour l'instant. <br> Cliquez sur le bouton <b>AJOUTER</b> pour ajouter une formation</p>
        @else
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Description</th>
                  <th>Montant</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($entrees as $key=>$entree)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $entree->description}}</td>
                  <td>{{ $entree->montant}} FCFA</td>
                  <td>{{ $entree->date_entree}}</td>
                  <td>
                    <a class="" href=""><i class="bx bx-archive-in me-1"></i></a>
                    <a class="" href=""><i class="bx bx-edit-alt me-1"></i></a>
                    <a class="" href="javascript:void(0);"><i class="bx bx-trash me-1"></i></a>
                    {{-- <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger"><i class="bx bx-trash me-1"></i></button>
                  </form> --}}
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

@endsection