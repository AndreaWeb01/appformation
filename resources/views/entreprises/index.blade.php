@extends('layouts.template')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="py-3 mb-4">
            <h4 class="fw-bold"><span class="text-muted fw-light">ENTREPRISES</h4>
            <a class="btn btn-outline-primary" href="{{ route('entreprises.create') }}">Ajouter</a>
        </div>
        <!-- Hoverable Table rows -->
        <div class="card">
            <h5 class="card-header">Liste des entreprises</h5>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Logo</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody class="table-border-bottom-0">
                        @foreach($auditeurs as $auditeur)
                        <tr>
                            <td></td>
                            <td>{{ $auditeur->nom }}</td>
                            <td>{{ $auditeur->prenom }}</td>
                            <td>{{ $auditeur->email }}</td>
                            <td>{{ $auditeur->contact}}</td>
                            <td>{{ $auditeur->entreprise }}</td>
                            <td> --}}
                                {{-- <a class="" href="{{ route('versements.by_auditeur', $auditeur->id) }}"><i class="bx bx-money me-1"></i></a> --}}
                                {{-- <a class="" href="{{ route('auditeurs.edit', $auditeur->id) }}"><i class="bx bx-edit-alt me-1"></i></a> --}}
                                {{-- <a class="" href="javascript:void(0);"><i class="bx bx-trash me-1"></i></a> --}}
                                {{-- <form action="{{ route('auditeurs.destroy', $auditeur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bx bx-trash me-1"></i></button>
                                </form> --}}
                            {{-- </td>
                        </tr>
                        @endforeach
                        
              
                    </tbody> --}}
                </table>
            </div>
        </div>
      <!--/ Hoverable Table rows -->
    </div>
    <!-- / Content -->
</div>
  <!-- Content wrapper -->

@endsection