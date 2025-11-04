@extends('layouts.app')

@section('title', 'Notificaciones')

@section('content')
<div class="container">
    <h1>Mis Notificaciones</h1>

    @forelse($notifications as $notification)
        <div class="card mb-3 {{ $notification->read ? 'bg-light' : 'bg-white' }}">
            <div class="card-body">
                <h5 class="card-title">{{ $notification->title }} <small class="text-muted">({{ $notification->type }})</small></h5>
                <p class="card-text">{{ $notification->message }}</p>

                @if(!$notification->read)
                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success">Marcar como leída</button>
                    </form>
                @else
                    <span class="badge bg-secondary">Leída</span>
                @endif
            </div>
        </div>
    @empty
        <p>No tienes notificaciones.</p>
    @endforelse
</div>
@endsection
