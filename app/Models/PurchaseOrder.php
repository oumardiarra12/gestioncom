<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = ["id","stats_purchase_order", "num_purchase_order","description_purchase_order","suppliers_id","total_purchase_order"];
    public function supplier(){
        return $this->belongsTo(Supplier::class,"suppliers_id","id");
    }
    public function line_purchase_order(){
        return $this->hasMany(LinePurchaseOrder::class);
    }
}
