<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name_product'=>$row[0],
            'categories_id'=>$row[1],
            'codebarre_product'=>$row[2],
            'price_sale'=>$row[3],
            'price_purchase'=>$row[4],
            'units_id'=>$row[5],
            'description_product'=>$row[6],
            'stock_min'=>$row[7],
        ]);
    }
}
