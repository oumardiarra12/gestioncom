<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    protected $fillable = ["id","amount_to_be_paid", "amount_to_pay","reste","description_customer_payment","customer_invoices_id","num_customer_payment","users_id"];
    public function customer_invoice(){
        return $this->belongsTo(CustomerInvoice::class,"customer_invoices_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
}
