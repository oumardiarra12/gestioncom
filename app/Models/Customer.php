<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ["id","firstname_customer", "lastname_customer","tel_customer","email_customer","address_customer","description_customer"];
    public $timestamps = false;
    public function customer_orders(){
        return $this->hasMany(CustomerOrder::class);
    }
}
