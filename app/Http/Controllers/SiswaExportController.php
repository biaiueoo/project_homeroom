<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaExportController extends Controller
{
     public function index()
    {
       return view('index');
    }

    public function export() 
    {
        return Excel::download(new SiswaExport, 'siswa_template.xlsx');
    }    
}