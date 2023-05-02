<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    protected $fillable = ["id","amount_to_be_paid", "amount_to_pay","reste","description_supplier_payment","purchase_invoices_id"];
    public function purchase_invoice(){
        return $this->belongsTo(PurchaseInvoice::class,"purchase_invoices_id","id");
    }
}
