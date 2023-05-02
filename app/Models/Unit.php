<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ["id","name_unit", "description_unit"];
    public $timestamps = false;
    public function products(){
        return $this->hasMany(Product::class);
    }
}
