<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPenerimaanExport;
use App\Models\Program;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        if (isset($request->search)) {
            $query = Program::latest();
            if (!isset($request->is_all)) {
                if (!isset($request->from_date) || !isset($request->end_date)) {
                    return redirect()->back()->with('error', 'Tanggal harus dilengkapi');
                }
                $query->whereDate('created_at', '>=', $request->from_date)
                    ->whereDate('created_at', '<=', $request->end_date);
            }
            $data = $query->get();
        }
        return view('report.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = Program::latest();
        if (!isset($request->is_all)) {
            $query->whereDate('created_at', '>=', $request->from_date)
                ->whereDate('created_at', '<=', $request->end_date);
        }
        $data = $query->get();
        $payload = $request->all();
        return Excel::download(new LaporanPenerimaanExport($data, $payload), 'Laporan Penerimaan.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
