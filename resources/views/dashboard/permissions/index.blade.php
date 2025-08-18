@extends('layouts.template')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="py-3 mb-4">
            <h4 class="fw-bold"><span class="text-muted fw-light">PERMISSIONS</h4>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        </div>
        <!-- Hoverable Table rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Liste des permissions</h5>
                <a class="btn btn-outline-primary" href="{{ route('permissions.create') }}">Ajouter</a>
            </div>
            

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Titre</th>
                            <th>Crée à</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($permissions as $key => $permission)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>
                                
                                <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bx bx-edit me-1"></i></a>

                                <form class="d-inline" action="{{ url('permissions/'.$permission->id.'/delete') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette permission ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash me-1"></i>
                                    </button>
                                </form>
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
</div>
  <!-- Content wrapper -->

@endsection