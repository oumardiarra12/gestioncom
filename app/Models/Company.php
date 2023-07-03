<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ["id","company_name", "company_sigle","company_status","company_nif","company_logo","company_contact","company_email","company_bp","company_fax","company_address","company_activity"];
    public $timestamps = false;
}
