<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Concert;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        // Retrieve concert data to be used in the create form
        $concerts = Concert::all();
        return view('tickets.create', compact('concerts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'concert_id' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
        ]);
        

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $concerts = Concert::all();
        return view('tickets.edit', compact('ticket', 'concerts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'concert_id' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
        ]);

        $ticket = Ticket::find($id);
        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy($id)
    {
        Ticket::destroy($id);
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
