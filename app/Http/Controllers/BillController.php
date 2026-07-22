<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function create(){
        $items = Item::all();
        return view('invoice', compact('items'));
    }
}
