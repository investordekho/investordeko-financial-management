<?php

namespace App\Exports;

use App\Models\Investor;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvestorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;
    public function __construct($data)
    {
        $this->data = collect($data);
    }

    public function collection()
    {
        // return Investor::all();
        return $this->data;
    }
}
