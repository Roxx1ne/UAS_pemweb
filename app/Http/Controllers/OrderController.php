<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Concert;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $concerts = Concert::all();
        $tickets = Ticket::all();
        $users = User::all();

        return view('orders.create', compact('concerts', 'tickets', 'users'));
    }

    public function store(Request $request)
    {
         // Lakukan validasi data dari $request sesuai kebutuhan
    $request->validate([
        'user_id' => 'required',
        'concert_id' => 'required',
        'total_amount' => 'required|numeric',
    ]);

    try {
        // Gunakan transaksi agar menyimpan data order dan order items dalam satu transaksi
        DB::beginTransaction();

        // Simpan data order ke dalam tabel orders
        $order = Order::create([
            'user_id' => $request->user_id,
            'concert_id' => $request->concert_id,
            'total_amount' => $request->total_amount,
        ]);

        // Commit transaksi jika semua proses berhasil
        DB::commit();

        // Redirect pengguna ke halaman show order yang baru saja dibuat
        return redirect()->route('orders.show', ['id' => $order->id])->with('success', 'Order created successfully.');
    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi error
        DB::rollback();

        // Redirect atau berikan respon dengan pesan error
        return redirect()->back()->with('error', 'Failed to create order. Please try again.');
    }
}

    public function show($id)
    {
        $order = Order::find($id);
        // Ambil daftar order items terkait order ini
        $orderItems = $order->items;
        return view('orders.show', compact('order', 'orderItems'));
    }

    public function showOrderItems($id)
    {
        $order = Order::find($id);

        // Pastikan order dengan ID yang diberikan ada
        if (!$order) {
            abort(404);
        }
        // Tampilkan rincian pesanan (order items) pada view "orders.order_items"
        return view('orders.order_items', compact('order'));
    }


    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $order = Order::find($id);
        $users = User::all(); // Assuming you have a User model and want to fetch all users
        $concerts = Concert::all();
        $tickets = Ticket::all();


        return view('orders.edit', compact('order', 'users', 'concerts', 'tickets'));
        return view('orders.create', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // Lakukan validasi data dari $request sesuai kebutuhan
        $request->validate([
            'user_id' => 'required',
            'concert_id' => 'required',
            'total_amount' => 'required|numeric',
        ]);

        // Cari order berdasarkan ID
        $order = Order::find($id);

        // Perbarui data order dengan data baru
        $order->user_id = $request->user_id;
        $order->concert_id = $request->concert_id;
        $order->total_amount = $request->total_amount;

        // Simpan perubahan data order
        $order->save();

        // Redirect pengguna kembali ke halaman show order yang telah diupdate
        return redirect()->route('orders.show', ['id' => $order->id])->with('success', 'Order updated successfully.');
    }
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
