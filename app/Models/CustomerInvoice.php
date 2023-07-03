<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInvoice extends Model
{
    use HasFactory;
    protected $fillable = ["id","status_customer_invoices", "num_customer_invoices","total_customer_invoices","deliveries_id","description_customer_invoices","users_id"];
    public function deliveries(){
        return $this->belongsTo(Delivery::class,"deliveries_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function line_customer_invoices(){
        return $this->hasMany(LineCustomerInvoice::class);
    }
    public function customerpayments(){
        return $this->hasMany(CustomerPayment::class);
    }
}
