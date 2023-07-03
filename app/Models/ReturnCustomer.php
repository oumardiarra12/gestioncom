<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCustomer extends Model
{
    use HasFactory;
    protected $fillable = ["id", "num_return_customer","description_return_customer","customers_id","total_return_customer","users_id"];
    public function customer(){
        return $this->belongsTo(Customer::class,"customers_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function line_return_customer(){
        return $this->hasMany(LineReturnCustomer::class);
    }
}
