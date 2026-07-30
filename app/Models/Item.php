<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'image','price','stock', 'status'];

    public function billItems(){
        return $this->hasMany(BillItem::class);
    }
}
