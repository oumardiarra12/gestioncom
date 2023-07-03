<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineReturnPurchase extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_return_purchase", "price_return_purchase","subtotal_return_purchase","products_id","return_purchases_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function return_purchase(){
        return $this->belongsTo(ReturnPurchase::class,"return_purchases_id","id");
    }
}
