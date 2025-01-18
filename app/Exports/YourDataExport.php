<?php

namespace App\Exports;

use App\Models\YourModel; // Your model
use Maatwebsite\Excel\Concerns\FromCollection;

class YourDataExport implements FromCollection
{
    public function collection()
    {
        return YourModel::all(); // Adjust the data collection as needed
    }
}
