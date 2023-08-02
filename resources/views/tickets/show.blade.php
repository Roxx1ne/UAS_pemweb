@extends('layouts.app')

@section('title', $ticket->type)

@section('content')
    <h1 class="mt-4">{{ $ticket->type }}</h1>
    <div class="card mt-4">
        <div class="card-body">
            <p class="card-text">Price: {{ $ticket->price }}</p>
            <p class="card-text">Concert: {{ $ticket->concert->name }}</p>
            <p class="card-text">Date: {{ $ticket->concert->date }}</p>
            <p class="card-text">Venue: {{ $ticket->concert->venue }}</p>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-primary">Edit Ticket</a>

        <form action="{{ route('tickets.destroy', ['id' => $ticket->id]) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Anda yakin ?')">Delete Ticket</button>
        </form>
    </div>
@endsection
