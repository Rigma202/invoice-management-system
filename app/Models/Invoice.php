<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
 use  SoftDeletes;

    protected $fillable = [
        'customer_id', 'product_id', 'invoice_date',
        'due_date', 'quantity', 'unit_price', 'total_amount' ,'status','rejection_reason',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date'     => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
