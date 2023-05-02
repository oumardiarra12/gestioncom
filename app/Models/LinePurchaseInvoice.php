<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinePurchaseInvoice extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_purchase_invoice", "price_purchase_invoice","subtotal_purchase_invoice","products_id","purchase_invoices_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function purchase_invoice(){
        return $this->belongsTo(PurchaseInvoice::class,"purchase_invoices_id","id");
    }
}
