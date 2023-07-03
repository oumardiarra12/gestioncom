<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ["id","number_expense","reason", "amount","expense_types_id","description_expense"];
    public function typeexpense(){
        return $this->belongsTo(ExpenseType::class,'expense_types_id','id');
    }

}
