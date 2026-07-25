<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\BillItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\WhatsAppServices;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function create(){
        $items = Item::all();
        return view('invoice', compact('items'));
    }

    public function store(Request $request){
        $customer = Customer::firstOrCreate( [
        'whatsapp' => $request->whatsapp,
    ],
    [
        'name' => $request->customer_name,
    ]);
       $bill = Bill::create([
    'invoice_number' => 'INV' . time(),
    'customer_id' => $customer->id,
    'invoice_date' => $request->bill_date,
    'gross_amount' => $request->gross_amount,
    'discount_percentage' => $request->discount_percentage,
    'discount_amount' => $request->discount_amount,
    'net_amount' => $request->net_amount,
]);

    foreach ($request->item_id as $index => $item){
        BillItem::create([
            'bill_id' => $bill->id,
            'item_id' => $request->item_id[$index],
            'quantity' => $request->quantity[$index],
            'price' => $request->price[$index],
            'amount' => $request->amount[$index],

        ]);
       
    }
        return redirect()
    ->route('bills.create')
    ->with('success', 'Invoice saved successfully.')
    ->with('bill_id', $bill->id)
    ->withInput();;
    }

    public function show(Bill $bill){

    $bill->load('customer', 'billItems.item');
    return view('billShow', compact('bill'));
     }
    public function generatePdf(Bill $bill){
         $bill->load('customer', 'billItems.item');
         $pdf = Pdf::loadView('invoicePdf', compact('bill'));
         return $pdf->stream('invoice.pdf'); 
         
        
    }

    public function sendWhatsApp(Bill $bill)
{
    try {

        $whatsapp = new WhatsAppServices();
        $whatsapp->sendInvoice($bill);

        return back()->with('success', 'Invoice sent successfully.');

    } catch (\Exception $e) {

        dd($e->getMessage());

    }
}
}
