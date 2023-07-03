<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    protected $fillable = ["id","amount_to_be_paid","num_supplier_payment","amount_to_pay","reste","description_supplier_payment","purchase_invoices_id","users_id"];
    public function purchase_invoice(){
        return $this->belongsTo(PurchaseInvoice::class,"purchase_invoices_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
}
