<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineCustomerInvoice extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_customer_invoice", "price_line_customer_invoice","subtotal_line_customer_invoice","products_id","customer_invoices_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function customer_invoice(){
        return $this->belongsTo(CustomerInvoice::class,"customer_invoices_id","id");
    }
}
