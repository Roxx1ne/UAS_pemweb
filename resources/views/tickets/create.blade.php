@extends('layouts.app')

@section('title', 'Create New Ticket')

@section('content')
    <h1 class="mt-4">Create New Ticket</h1>
    <form action="{{ route('tickets.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="concert_id">Concert</label>
            <select name="concert_id" id="concert_id" class="form-control" required>
                <option value="">Select Concert</option>
                @foreach($concerts as $concert)
                    <option value="{{ $concert->id }}">{{ $concert->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
