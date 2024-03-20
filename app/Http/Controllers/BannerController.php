<?php

namespace App\Http\Controllers;

use App\Constants\UploadPathConstant;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
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
            $data = Banner::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '';
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/banner/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#modal-delete-banner"class="btn btn-sm btn-danger delete-banner">
                        <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $payload = $request->all();
        if ($request->hasFile('image') || $request->image != null) {
            $file = $request->file('image');
            $file_name = $this->uploadImage($file, UploadPathConstant::BANNER);
            $payload['image'] = $file_name;
        }
        $res = Banner::create($payload);
        return redirect()->route('banner.index')->with('success', 'Data berhasil ditambahkan.');
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
        $data = Banner::find($id);
        return view('banner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $data = Banner::find($id);
        $payload = $request->all();
        if ($request->hasFile('image') || $request->image != null) {
            $name = $data->slug . '-' . rand(1111, 9999);
            $file = $request->file('image');
            $file_name = $this->uploadImage($file, UploadPathConstant::BANNER, true, $name);
            $payload['image'] = $file_name;
            if ($data->image) {
                $image_old = explode('/', $data->image);
                $this->unlinkImage(UploadPathConstant::BANNER, end($image_old));
            }
        }
        $data->update($payload);
        return redirect()->route('banner.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Banner::find($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
