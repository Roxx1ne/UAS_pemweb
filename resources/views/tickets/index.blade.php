@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <h1 class="mt-4">Tickets List</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create New Ticket</a>
    <ul class="list-group mt-4">
        @foreach($tickets as $ticket)
            <li class="list-group-item">
                <a href="{{ route('tickets.show', ['id' => $ticket->id]) }}">
                    {{ $ticket->type }} - Rp{{ $ticket->price }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
