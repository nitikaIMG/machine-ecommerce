<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserReportExport implements FromCollection, WithHeadings, WithMapping
{
    public $users;
    public $type;
    public function __construct($users,$type)
    {
        $this->users = $users;
        $this->type = $type;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->users;
    }
    public function headings(): array
    {
        $heading = [
            'User Id',
            'Name',
            'Email Id',
            'Phone Number',
            'Joined At',
            'Role',
        ];
        return $heading;
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->created_at,
            $user->role,
           
        ];
    }
}
