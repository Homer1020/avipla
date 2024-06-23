@extends('layouts.dashboard')
@section('title', 'Notificaciones')
@section('content')
  <h1 class="mt-4">Notificaciones</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
  </ol>

  @foreach (Auth::user()->notifications as $notification)
    <div class="card mb-3 shadow shadow-sm">
      <div class="card-body">
        Tienes una factura pendiente <a href="{{ route('pagos.pay_invoice', $notification->data['invoice_id']) }}">#{{ $notification->data['numero_factura'] }}</a>. por un monto de {{ $notification->data['monto_total'] }}$
        <p class="mb-0 mt-1">
          <small>{{ $notification->created_at->diffForHumans() }}</small>
        </p>
      </div>
    </div>
  @endforeach
@endsection