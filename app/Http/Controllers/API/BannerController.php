<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

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
        try {
            $result = Banner::latest()->get();
            return $this->customResponse(true, 'Berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
        }
    }
}
