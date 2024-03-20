<?php

namespace App\Http\Controllers;

use App\Constants\UploadPathConstant;
use App\Http\Requests\ProgramRequest;
use App\Models\Images;
use App\Models\Program;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    use GlobalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Program::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '';
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/program/' . $data->id . '/edit" class="btn btn-sm btn-success" >
                    <i class="fa fa-inbox" aria-hidden="true"></i> Pemasukan</a>';
                    $button .= '<a href="/pengeluaran?program=' . $data->id . '" class="btn btn-sm btn-info" >
                    <i class="fa fa-boxes" aria-hidden="true"></i> Pengeluaran</a>';
                    $button .= '<a href="/program/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                    <i class="fa fa-edit" aria-hidden="true"></i> Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#modal-delete-program"class="btn btn-sm btn-danger delete-program">
                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>';
                    $button .= '</div>';

                    return $button;
                })
                ->editColumn('total', function ($data) {
                    return 'Rp ' . number_format($data->total, 0, ',', '.');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('program.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramRequest $request)
    {
        $payload = $request->all();
        if ($request->hasFile('image') || $request->image != null) {
            $file = $request->file('image');
            $file_name = $this->uploadImage($file, UploadPathConstant::PROGRAM_THUMBNAIL);
            $payload['thumbnail'] = $file_name;
        }
        $res = Program::create($payload);
        return redirect()->route('program.edit', $res->id)->with('success', 'Data berhasil ditambahkan.');
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
        $data = Program::find($id);
        $images = Images::where('program_id', $id)->get();
        return view('program.edit', compact('data', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramRequest $request, $id)
    {
        $data = Program::find($id);
        $payload = $request->all();
        if ($request->hasFile('image') || $request->image != null) {
            $name = $data->slug . '-' . rand(1111, 9999);
            $file = $request->file('image');
            $file_name = $this->uploadImage($file, UploadPathConstant::PROGRAM_THUMBNAIL, true, $name);
            $payload['thumbnail'] = $file_name;
            if ($data->image) {
                $image_old = explode('/', $data->image);
                $this->unlinkImage(UploadPathConstant::PROGRAM_THUMBNAIL, end($image_old));
            }
        }
        $data->update($payload);
        return redirect()->route('program.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Program::find($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
