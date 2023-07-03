<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineDelivery extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_order","qty_line_deliverie", "price_line_deliverie","subtotal_line_deliverie","products_id","deliveries_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function Deliveries(){
        return $this->belongsTo(Delivery::class,"deliveries_id","id");
    }
}
