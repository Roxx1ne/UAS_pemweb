<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Concert;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::all();
        return view('concerts.index', compact('concerts'));
    }

    public function create()
    {
        return view('concerts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'venue' => 'required',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
         // Check if the 'images' directory exists, if not, create it
         $imagePath = public_path('images/concerts');
         if (!File::exists($imagePath)) {
            File::makeDirectory($imagePath, 0777, true);
        }
        // Upload image to public/images/concerts folder
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/concerts'), $imageName);

        Concert::create([
            'name' => $request->name,
            'venue' => $request->venue,
            'date' => $request->date,
            'image' => $imageName,
        ]);

        return redirect()->route('concerts.index')->with('success', 'Concert created successfully.');
    }

    public function show($id)
    {
        $concert = Concert::find($id);
        return view('concerts.show', compact('concert'));
    }

    public function edit($id)
    {
        $concert = Concert::find($id);
        return view('concerts.edit', compact('concert'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'venue' => 'required',
            'date' => 'required|date',
        ]);

        $concert = Concert::find($id);
        $concert->update($request->all());

        return redirect()->route('concerts.index')->with('success', 'Concert updated successfully.');
    }

    public function destroy($id)
    {
        Concert::destroy($id);
        return redirect()->route('concerts.index')->with('success', 'Concert deleted successfully.');
    }
}
