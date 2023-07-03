<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineReturnCustomer extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_return_customer", "price_return_customer","subtotal_return_customer","products_id","return_customers_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function return_customer(){
        return $this->belongsTo(ReturnCustomer::class,"return_customers_id","id");
    }
}
