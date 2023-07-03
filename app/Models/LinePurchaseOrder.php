<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinePurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_purchase_order","qty_line_recept", "price_line_purchase_order","subtotal_line_purchase_order","products_id","purchase_orders_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function purchase_order(){
        return $this->belongsTo(PurchaseOrder::class,"purchase_orders_id","id");
    }
}
