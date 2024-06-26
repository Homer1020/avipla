@extends('layouts.dashboard')
@section('title', 'Notificaciones')
@section('content')
  <h1 class="mt-4">Notificaciones</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
  </ol>

  @if (Auth::user()->unreadNotifications->count() > 0)
    <div class="mb-4">
      <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-check"></i>
          Marcar todo como leido
        </button>
      </form>
    </div>
  @endif

  <p class="text-muted text-uppercase">Notificaciones sin leer</p>

  @if (!Auth::user()->unreadNotifications->count())
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>
    
    <div class="alert alert-primary d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
      <div>
        Estas al dia. No tienes notificaciones pendientes.
      </div>
    </div>
  @endif
  
  @foreach (Auth::user()->unreadNotifications as $notification)
    @switch($notification->type)
      @case('App\Notifications\InvoiceCreated')
        <x-notifications.invoice-created
          :notification="$notification"
        />
        @break
      @case('App\Notifications\InvoicePaid')
        <x-notifications.invoice-paid
          :notification="$notification"
        />
        @break
      @default
        
    @endswitch
  @endforeach

  <p class="text-muted text-uppercase">Notificaciones leidas</p>
  @if (!Auth::user()->readNotifications->count())
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>

    <div class="alert alert-primary d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
      <div>
        Aún no tienes notificaciones leidas.
      </div>
    </div>
  @endif
  @foreach (Auth::user()->readNotifications as $notification)
  @switch($notification->type)
      @case('App\Notifications\InvoiceCreated')
        <x-notifications.invoice-created
          :notification="$notification"
        />
        @break
      @case('App\Notifications\InvoicePaid')
        <x-notifications.invoice-paid
          :notification="$notification"
        />
        @break
      @default
        
    @endswitch
  @endforeach
@endsection
@push('script')
  <script>
    const $markAllAsRead = document.getElementById('mark-all-as-read')

    console.log($("meta[name='csrf-token']").attr("content"))

    $markAllAsRead.addEventListener('click', e => {
      fetch('notificaciones', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          '_token': $("meta[name='csrf-token']").attr("content")
        })
      })
        .then(resp => resp.json())
        .then(resp => {
          console.log(resp)
        })
        .catch(err => {
          console.log(err)
        })
    })
  </script>
@endpush