<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;

class CustomerController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $customers = Customer::when($search, function($query) use ($search){
        $query->where('name', 'like', "%{$search}%")->orWhere('whatsapp', 'like', "%{$search}%");
        })->latest()
->paginate(10)
->withQueryString();

        return view('customers.index', compact('customers')); 
    }

    public function show(Customer $customer){
        $customer->load('bills.billItems.item');
        $totalBills = $customer->bills->count();
        $totalPurchase = $customer->bills->sum('net_amount');
        return view('customers.show', compact('customer','totalBills','totalPurchase'));
    }

    public function showBill(Bill $bill){
        $bill->load(['customer', 'billItems.item']);
        return response()->json($bill);
    }
}
