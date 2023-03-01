<?php

namespace App\Models;

use App\Http\Livewire\Employee\Orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'prod_id',
        'qty'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function order_item()
    {
        return $this->belongsTo(Product::class,'prod_id');
    }
}
