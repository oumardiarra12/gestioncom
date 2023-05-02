<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineCustomerOrder extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_customer_order", "price_line_customer_order","subtotal_line_customer_order","products_id","customer_orders_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(LineCustomerOrder::class,"products_id","id");
    }
    public function customer_order(){
        return $this->belongsTo(CustomerOrder::class,"customer_orders_id","id");
    }
}
