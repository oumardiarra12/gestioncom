<?php

namespace App\Exports;

use App\Models\ExpenseType;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpenseTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExpenseType::all();
    }
}
