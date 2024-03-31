<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Program;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
{
    use GlobalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $program = Program::find($request->program);
        if ($request->ajax()) {
            $data = Pengeluaran::where('program_id', $request->program)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($request) {
                    $button = '';
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/pengeluaran/' . $data->id . '/edit?program=' . $request->program . '" class="btn btn-sm btn-warning" >
                    <i class="fa fa-edit" aria-hidden="true"></i> Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#modal-delete-pengeluaran"class="btn btn-sm btn-danger delete-pengeluaran">
                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>';
                    $button .= '</div>';

                    return $button;
                })
                ->editColumn('nominal', function ($data) {
                    return 'Rp ' . number_format($data->nominal, 0, ',', '.');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pengeluaran.index', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $program = Program::find($request->program);
        return view('pengeluaran.create', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $request->all();
        $res = Pengeluaran::create($payload);
        return redirect()->route('pengeluaran.index', ['program' => $request->program_id])->with('success', 'Data berhasil ditambahkan.');
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
    public function edit(Request $request, $id)
    {
        $data = Pengeluaran::find($id);
        $program = Program::find($request->program);
        return view('pengeluaran.edit', compact('data', 'program'));
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
        $data = Pengeluaran::find($id);
        $payload = $request->all();
        $data->update($payload);
        return redirect()->route('pengeluaran.index', ['program' => $request->program_id])->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengeluaran::find($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
