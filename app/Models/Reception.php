<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;
    protected $fillable = ["id","status_reception", "num_reception","total_reception","description_reception","purchase_orders_id","users_id"];
    public function purchase_order(){
        return $this->belongsTo(PurchaseOrder::class,"purchase_orders_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function line_receptions(){
        return $this->hasMany(LineReception::class);
    }
}
