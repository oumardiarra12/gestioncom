<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_estimates", "status_estimates","description_estimates","customers_id"];
    public function customer(){
        return $this->belongsTo(Customer::class,"customers_id","id");
    }
    public function lineestimate(){
        return $this->hasMany(LineEstimate::class);
    }
}
