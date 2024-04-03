<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentase;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari tabel presentase_sosial
        $data = Presentase::select('pekerjaan_ortu')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('pekerjaan_ortu')
            ->get();

        // Mengembalikan data dalam format yang sesuai untuk digunakan dalam grafik
        return view('dashboard.home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
