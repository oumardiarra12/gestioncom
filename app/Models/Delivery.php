<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_deliveries","total_deliveries" ,"status_deliveries","description_deliveries","customer_orders_id","users_id"];
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function customer_order(){
        return $this->belongsTo(CustomerOrder::class,"customer_orders_id","id");
    }
}
