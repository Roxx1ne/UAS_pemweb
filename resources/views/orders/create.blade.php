@extends('layouts.app')

@section('title', 'Create New Order')

@section('content')
    <h1 class="mt-4">Create New Order</h1>
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
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
            <label for="ticket_id">Ticket</label>
            <select name="ticket_id" id="ticket_id" class="form-control" required>
                <option value="">Select Ticket</option>
                @foreach($tickets as $ticket)
                    <option value="{{ $ticket->id }}" data-price="{{ $ticket->price }}">{{ $ticket->type }} - {{ $ticket->price }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total_amount">Total Harga</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
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
@endsection
