@extends('layouts.app')

@section('title', 'Edit Concert')

@section('content')
    <h1 class="mt-4">Edit Concert</h1>
    <form action="{{ route('concerts.update', ['id' => $concert->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $concert->name }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $concert->date }}" required>
        </div>
        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" name="venue" id="venue" class="form-control" value="{{ $concert->venue }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
