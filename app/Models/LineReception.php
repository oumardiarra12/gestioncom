<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineReception extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_reception", "qty_recu_line_reception","price_line_reception","subtotal_line_reception","products_id","receptions_id"];
    public $timestamps = false;
    public function reception(){
        return $this->belongsTo(Reception::class,"receptions_id","id");
    }
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
}
