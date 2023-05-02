<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ["id","name_supplier", "tel_supplier","address_supplier","email_supplier","firstname_contact_supplier","lastname_contact_supplier","tel_contact_supplier","email_contact_supplier","description_supplier"];
    public $timestamps = false;
    public function purchase_Orders(){
        return $this->hasMany(Purchase_Order::class);
    }
}
