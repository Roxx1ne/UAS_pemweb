@extends('layouts.app')

@section('title', 'Edit Ticket')

@section('content')
    <h1 class="mt-4">Edit Ticket</h1>
    <form action="{{ route('tickets.update', ['id' => $ticket->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="concert_id">Concert</label>
            <select name="concert_id" id="concert_id" class="form-control" required>
                @foreach($concerts as $concert)
                    <option value="{{ $concert->id }}" {{ $ticket->concert_id == $concert->id ? 'selected' : '' }}>
                        {{ $concert->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $ticket->type }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $ticket->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
