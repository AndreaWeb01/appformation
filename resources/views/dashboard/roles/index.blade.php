@extends('layouts.template')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="py-3 mb-4">
            <h4 class="fw-bold"><span class="text-muted fw-light">ROLES</h4>
            <a class="btn btn-outline-primary" href="{{ route('roles.create') }}">Ajouter</a>
        </div>
        <!-- Hoverable Table rows -->
        <div class="card">
            <h5 class="card-header">Liste des inscrits</h5>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Titre</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($roles as $key=>$role)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="">{{ $permission->name }}</span>
                                @endforeach
                                
                                {{-- {{ $role->permissions->pluck('name')->implode(', ') }} --}}
                            </td>
                            {{-- <td>{{ $role->created_at->diffForHumans() }}</</td> --}}
                            
                            <td>
                                {{-- <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">Autorisations</a> --}}
                                                
                                <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success"><i class="bx bx-edit me-1"></i></a>
                                               
                                {{-- <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger">Supprimer</a> --}}
                                <form class="d-inline" action="{{ url('roles/'.$role->id.'/delete') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
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