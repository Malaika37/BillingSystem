<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['invoice_number', 'customer_id', 'invoice_date', 'gross_amount',
    'discount_percentage', 'discount_amount', 'net_amount'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function billItems(){
        return $this->hasMany(BillItem::class);
    }
}
