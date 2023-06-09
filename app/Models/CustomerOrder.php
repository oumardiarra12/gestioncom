<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_customer_order", "status_customer_order","description_customer_order","customers_id"];
    public function customer(){
        return $this->belongsTo(Customer::class,"customers_id","id");
    }
    public function linecustomerorder(){
        return $this->hasMany(LineCustomerOrder::class);
    }
}
