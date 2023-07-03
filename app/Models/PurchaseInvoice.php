<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    protected $fillable = ["id","status_purchase_invoice", "num_purchase_invoice","total_purchase_invoice","receptions_id","description_purchase_invoice","users_id"];
    public function reception(){
        return $this->belongsTo(Reception::class,"receptions_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function line_purchase_invoices(){
        return $this->hasMany(LinePurchaseInvoice::class);
    }
    public function supplierpayments(){
        return $this->hasMany(SupplierPayment::class);
    }
}
