<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comptoir extends Model
{
    use HasFactory;
    protected $fillable = ["id", "num_comptoir","customers_id","total_comptoir","users_id"];
    public function customer(){
        return $this->belongsTo(Customer::class,"customers_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"users_id","id");
    }
    public function linecomptoirs(){
        return $this->hasMany(linecomptoirs::class);
    }
}
