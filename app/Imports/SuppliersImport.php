<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SuppliersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Supplier([
            'name_supplier'=>$row[0],
            'tel_supplier'=>$row[1],
            'address_supplier'=>$row[2],
            'email_supplier'=>$row[3],
            'firstname_contact_supplier'=>$row[4],
            'lastname_contact_supplier'=>$row[5],
            'tel_contact_supplier'=>$row[6],
            'email_contact_supplier'=>$row[7],
            'description_supplier'=>$row[8],
        ]);
    }
}
