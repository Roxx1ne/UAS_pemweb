@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    <h1 class="mt-4">Orders List</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>
    <ul class="list-group mt-4">
        @foreach($orders as $order)
            <li class="list-group-item">
                <a href="{{ route('orders.show', ['id' => $order->id]) }}">Order ID: {{ $order->id }}</a>
            </li>
        @endforeach
    </ul>
@endsection
