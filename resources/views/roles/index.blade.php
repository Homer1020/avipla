@extends('layouts.dashboard')
@section('title', 'Roles')
@section('content')
  <h1 class="mt-4">Roles</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear role</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="invoices-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Rol</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($roles as $role)
            <tr>
              <td>#{{ $role->id }}</td>
              <td>{{ $role->name }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection