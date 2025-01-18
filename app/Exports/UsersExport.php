<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithFilters;

class UsersExport implements FromCollection, WithHeadings
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->filter) {
            // Apply filter to the query
            $query->where('name', 'like', '%' . $this->filter . '%');
        }

        return $query->get(['name', 'email', 'created_at']);
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Created At'];
    }
}
