<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnPurchase extends Model
{
    use HasFactory;
    protected $fillable = ["id", "num_return_purchase","description_return_purchase","suppliers_id","total_return_purchase","users_id"];
    public function supplier(){
        return $this->belongsTo(Supplier::class,"suppliers_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function line_return_purchase(){
        return $this->hasMany(LineReturnPurchase::class);
    }
}
