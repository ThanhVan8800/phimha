<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        return view('exports.invoices', [
            'invoices' => User::all()
        ]);
    }
}
