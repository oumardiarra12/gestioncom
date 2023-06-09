<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["id","image_product", "ref_product","codebarre_product","name_product","stock_min","stock_actuel","categories_id","units_id"];
    public $timestamps = false;
    public function category(){
        return $this->belongsTo(Category::class,"categories_id","id");
    }
    public function unit(){
        return $this->belongsTo(Unit::class,"units_id","id");
    }
}
