@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
  <h1 class="mt-4">Dashboard</h1>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
  @endif
@endpush