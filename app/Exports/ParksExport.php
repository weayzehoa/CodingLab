<?php

namespace App\Exports;

use App\Park;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Park::all();
    }
}
