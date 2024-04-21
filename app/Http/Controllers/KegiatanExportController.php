<?php

namespace App\Http\Controllers;

use App\Exports\KegiatanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class KegiatanExportController extends Controller
{
    public function index()
    {
       return view('index');
    }

    public function export() 
    {
        return Excel::download(new KegiatanExport, 'guru_template.xlsx');
    }    
}
