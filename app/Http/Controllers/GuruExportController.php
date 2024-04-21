<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GuruExportController extends Controller
{
    public function index()
    {
       return view('index');
    }

    public function export() 
    {
        return Excel::download(new GuruExport, 'guru_template.xlsx');
    }    
}
