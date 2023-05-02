<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryUser extends Model
{
    use HasFactory;
    protected $fillable = ["id","name_category_users", "description_category_users"];
    public $timestamps = false;
    public function users(){
        return $this->hasMany(User::class);
    }
}
