<?php

namespace App\Http\Controllers;

use App\Exports\Export;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function index()
    {
        return view('exportdata');
    }
    public function export(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $text = $request->input('text');

        $export = new Export([$name, $email, $phone, $address, $text]);
        $file = 'exports/example.xlsx';
        Excel::store($export, $file, 'public');
        $fileUrl = Storage::url($file);
        return redirect()->back()->with('success', 'Excel file exported successfully!')->with('fileUrl', $fileUrl);
    }
}
