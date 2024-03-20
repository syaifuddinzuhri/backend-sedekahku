<?php

namespace App\Http\Controllers;

use App\Constants\UploadPathConstant;
use App\Models\Images;
use App\Models\Program;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    use GlobalTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $program = Program::find($request->program);

            $files = $request->file('file');
            foreach ($files as $key => $file) {
                $name = $program->slug . '-' . rand(1111, 9999);
                $file_name = $this->uploadImage($file, UploadPathConstant::PROGRAM_IMAGES, true, $name);
                Images::create([
                    'program_id' => $program->id,
                    'image' => $file_name,
                ]);
            }


            return response()->json(['success' => true, 'message' => 'Success', 'data' => $request->all()], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 400);
        }
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
        $data = Images::find($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
