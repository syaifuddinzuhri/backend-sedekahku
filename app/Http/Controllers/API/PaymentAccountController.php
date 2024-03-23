<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PaymentAccount;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    use GlobalTrait;

    public function index(Request $request)
    {
        try {
            $result = PaymentAccount::latest()->get();
            return $this->customResponse(true, 'Berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $result = PaymentAccount::find($id);
            return $this->customResponse(true, 'Berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
        }
    }
}
