@extends('layouts.template')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="py-3 mb-4">
            <h4 class="fw-bold"><span class="text-muted fw-light">UTILISATEURS</h4>
            <a class="btn btn-outline-primary" href="{{ route('users.create') }}">Ajouter</a>
        </div>
        <!-- Hoverable Table rows -->
        <div class="card">
            <h5 class="card-header">Liste des utilisateurs</h5>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($users as $key=>$user)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $rolename)
                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success">Modifier</a>
                                <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-danger">Delete</a>
                                
                                {{-- <a class="" href="{{ route('versements.by_auditeur', $auditeur->id) }}"><i class="bx bx-money me-1"></i></a> --}}
                                {{-- <a class="" href="{{ route('auditeurs.edit', $auditeur->id) }}"><i class="bx bx-edit-alt me-1"></i></a> --}}
                                {{-- <a class="" href="javascript:void(0);"><i class="bx bx-trash me-1"></i></a> --}}
                                {{-- <form action="{{ route('auditeurs.destroy', $auditeur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bx bx-trash me-1"></i></button>
                                </form> --}}
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