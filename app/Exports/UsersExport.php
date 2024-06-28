<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    public function headings():array {
        return [
            "Id",
            "Name",
            "Email",
            "Phone",
            "Address"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Users::getUsers());
    }
}
