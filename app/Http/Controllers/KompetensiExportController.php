<?php

namespace App\Http\Controllers;

use App\Exports\KompetensiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KompetensiExportController extends Controller
{
    public function index()
    {
       return view('index');
    }

    public function export() 
    {
        return Excel::download(new KompetensiExport, 'kompetensi_template.xlsx');
    }    
}
