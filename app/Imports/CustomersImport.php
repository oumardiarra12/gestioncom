<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'firstname_customer'=>$row[0],
            'lastname_customer'=>$row[1],
            'tel_customer'=>$row[2],
            'email_customer'=>$row[3],
            'address_customer'=>$row[4],
            'description_customer'=>$row[5]
        ]);
    }
}
