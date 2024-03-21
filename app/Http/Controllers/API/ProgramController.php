<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Traits\GlobalTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        try {
            $filter = ["name"];
            $result = Program::with(['images'])->whereLike($filter, $request->keyword ?? "")->latest()
                ->where(function ($query) {
                    $now = Carbon::now()->format('Y-m-d');
                    $query->whereNull('end_date')
                        ->orWhere(function ($query) use ($now) {
                            $query->where('end_date', '>=', $now);
                        });
                })
                ->paginate(isset($request->perPage) ? $request->perPage : 10);
            return $this->customResponse(true, 'Berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
        }
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
        try {
            $result = Program::with(['images'])->where('slug', $id)->first();
            return $this->customResponse(true, 'Berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
        }
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
