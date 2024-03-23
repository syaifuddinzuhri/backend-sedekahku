<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Program;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $program = Program::find($request->program);
        if ($request->ajax()) {
            $data = Payment::with(['program', 'payment_account'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '';
                    // $button = '<div class="btn-group" role="group">';
                    // $button .= '<a href="/pemasukan?program=' . $data->id . '"  class="btn btn-sm btn-success" >
                    // <i class="fa fa-inbox" aria-hidden="true"></i> Pemasukan</a>';
                    // $button .= '<a href="/pengeluaran?program=' . $data->id . '" class="btn btn-sm btn-info" >
                    // <i class="fa fa-boxes" aria-hidden="true"></i> Pengeluaran</a>';
                    // $button .= '<a href="/program/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                    // <i class="fa fa-edit" aria-hidden="true"></i> Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#modal-delete-pemasukan"class="btn btn-sm btn-danger delete-pemasukan">
                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>';
                    $button .= '</div>';

                    return $button;
                })
                ->editColumn('nominal', function ($data) {
                    return 'Rp ' . number_format($data->nominal, 0, ',', '.');
                })
                ->editColumn('payment_account', function ($data) {
                    if ($data->payment_account) return $data->payment_account->name;
                    return '-';
                })
                ->rawColumns(['action', 'payment_account'])
                ->make(true);
        }
        return view('pemasukan.index', compact('program'));
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
        //
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
        $data = Payment::find($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
