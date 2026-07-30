<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);
        $imagePath = null;

        if($request->hasFile('image')){

          $imagePath = $request
                    ->file('image')
                    ->store('items','public');

}
        Item::create([
            'name' => $request->name,
            'image' => $imagePath,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);
        return redirect()->route('items.index')->with('success', 'Items added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
          $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);
        $imagePath = $item->image;

if($request->hasFile('image')){

    if($item->image){

        Storage::disk('public')->delete($item->image);

    }

    $imagePath = $request
                    ->file('image')
                    ->store('items','public');

}
        $item->update([
    'name' => $request->name,
    'image' => $imagePath,
    'price' => $request->price,
    'stock' => $request->stock,
    'status' => $request->status,
]);
      
        return redirect()->route('items.index')->with('success', 'Items added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}
