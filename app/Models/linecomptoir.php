<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class linecomptoir extends Model
{
    use HasFactory;
    protected $fillable = ["id","qty_linecomptoir", "price_linecomptoir","subtotal_linecomptoir","products_id","comptoirs_id"];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,"products_id","id");
    }
    public function comptoir(){
        return $this->belongsTo(comptoir::class,"comptoirs_id","id");
    }
}
