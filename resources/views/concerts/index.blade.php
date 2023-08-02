@extends('layouts.app')

@section('title', 'Concerts')

@section('content')
    <h1 class="mt-4">Concerts List</h1>
    <a href="{{ route('concerts.create') }}" class="btn btn-primary mb-3">Create New Concert</a>
    <ul class="list-group mt-4">
        @foreach($concerts as $concert)
            <li class="list-group-item">
                <a href="{{ route('concerts.show', ['id' => $concert->id]) }}">{{ $concert->name }}</a>
                <br>
                Date: {{ $concert->date }} | Venue: {{ $concert->venue }}
            </li>
        @endforeach
    </ul>
@endsection
