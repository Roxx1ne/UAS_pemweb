@extends('layouts.app')

@section('title', 'Order ' . $order->id)

@section('content')
<h1 class="mt-4">Order ID: {{ $order->id }}<svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </svg></h1>
<h3>Rincian Pemesanan Ticket</h3>
<div class="card mt-4 bg-success text-light">
    <div class="card-body">
        <p class="card-text">Name: {{ $order->user->name }}</p>
        <p class="card-text">Concert: {{ $order->concert->name }}</p>
        <p class="card-text">Date: {{ $order->concert->date }}</p>
        <p class="card-text">Venue: {{ $order->concert->venue }}</p>
        <p class="card-text">Bayar: Rp.{{ $order->total_amount }}</p>
    </div>


</div>
<div class="mt-4">
    <a href="{{ route('orders.edit', ['id' => $order->id]) }}" class="btn btn-primary">Edit Order</a>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ?')">Delete Order</button>
    </form>
</div>
@endsection
