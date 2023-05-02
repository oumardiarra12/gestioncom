<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineEstimate extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_line_estimate", "price_line_estimate","subtotal_line_estimate","products_id","estimates_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(LineCustomerOrder::class,"products_id","id");
    }
    public function estimates(){
        return $this->belongsTo(Estimate::class,"estimates_id","id");
    }
}
