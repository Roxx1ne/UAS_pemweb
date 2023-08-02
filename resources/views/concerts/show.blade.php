@extends('layouts.app')

@section('title', $concert->name)

@section('content')
    <div class="card" style="width: 18rem;">
        <img src="{{ asset('images/concerts/' . $concert->image) }}" class="card-img-top" alt="direktori/path blm di masukan">
          <h5 class="card-text">{{ $concert->name }}</h5>
          <p class="card-text">Date: {{ $concert->date }}</p>
          <p class="card-text">Venue: {{ $concert->venue }}</p>
           <div class="mt-4">
            <a href="{{ route('concerts.edit', ['id' => $concert->id]) }}" class="btn btn-primary">Edit Concert</a>

            <form action="{{ route('concerts.destroy', ['id' => $concert->id]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ?')">Delete Concert</button>
            </form>
        </div>
    </div>
@endsection
