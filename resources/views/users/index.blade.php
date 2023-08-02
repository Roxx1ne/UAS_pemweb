@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <h1 class="mt-4">Users List</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
    <ul class="list-group mt-4">
        @foreach($users as $user)
            <li class="list-group-item">
                <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
