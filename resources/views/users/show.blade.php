@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <h1 class="mt-4">{{ $user->name }}</h1>
    <div class="card mt-4">
        <div class="card-body">
            <p class="card-text">Email: {{ $user->email }}</p>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit User</a>

        <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
        </form>
    </div>
@endsection
