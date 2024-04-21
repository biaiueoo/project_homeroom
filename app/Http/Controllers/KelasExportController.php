<?php

namespace App\Http\Controllers;

use App\Exports\KelasExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasExportController extends Controller
{
    public function index()
    {
       return view('index');
    }

    public function export() 
    {
        return Excel::download(new KelasExport, 'kelas_template.xlsx');
    }    
}
