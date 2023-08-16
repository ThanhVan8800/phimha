<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class Export  implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        return view('renderExport', [
            'data' => $this->data
        ]);
    }
}
