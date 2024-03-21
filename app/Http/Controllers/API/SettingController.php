<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
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
            $result = Setting::first();
            return $this->customResponse(true, 'Berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
        }
    }
}
