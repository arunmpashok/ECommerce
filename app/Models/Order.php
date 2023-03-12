<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'customer_name',
        'phone',
        'order_id',
        'product_id',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
