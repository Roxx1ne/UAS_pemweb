@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
    <h1 class="mt-4">Edit Order</h1>
    <form action="{{ route('orders.update', ['id' => $order->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="concert_id">Concert</label>
            <select name="concert_id" id="concert_id" class="form-control" required>
                <option value="">Select Concert</option>
                @foreach($concerts as $concert)
                    <option value="{{ $concert->id }}" {{ $order->concert_id == $concert->id ? 'selected' : '' }}>
                        {{ $concert->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ticket_id">Ticket</label>
            <select name="ticket_id" id="ticket_id" class="form-control" required>
                <option value="">Select Ticket</option>
                @foreach($tickets as $ticket)
                    <option value="{{ $ticket->id }}" data-price="{{ $ticket->price }}"
                        {{ $order->ticket_id == $ticket->id ? 'selected' : '' }}>
                        {{ $ticket->type }} - ${{ $ticket->price }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required
                value="{{ $order->quantity }}">
        </div>
        <div class="form-group">
            <label for="total_amount">Total Harga</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" readonly
                value="{{ $order->total_amount }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <script>
        // Ambil elemen-elemen yang diperlukan
        const ticketSelect = document.getElementById('ticket_id');
        const quantityInput = document.getElementById('quantity');
        const totalAmountInput = document.getElementById('total_amount');

        // Event listener untuk menghitung total pembayaran
        ticketSelect.addEventListener('change', updateTotalAmount);
        quantityInput.addEventListener('input', updateTotalAmount);

        // Fungsi untuk menghitung total pembayaran
        function updateTotalAmount() {
            const selectedTicketOption = ticketSelect.options[ticketSelect.selectedIndex];
            const ticketPrice = selectedTicketOption.getAttribute('data-price');
            const quantity = parseInt(quantityInput.value);

            if (!isNaN(ticketPrice) && !isNaN(quantity)) {
                const totalAmount = ticketPrice * quantity;
                totalAmountInput.value = totalAmount.toFixed(2);
            } else {
                totalAmountInput.value = '';
            }
        }

        // Panggil fungsi untuk menginisialisasi total pembayaran saat halaman dimuat
        updateTotalAmount();
    </script>

    <!-- The JavaScript part for calculating total amount is not needed here as it's specific to create only -->
@endsection
