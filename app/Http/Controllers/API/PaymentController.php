<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentAccount;
use App\Models\Program;
use App\Traits\GlobalTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
            $result = Payment::latest()->where('program_id', $request->program)->paginate(10);
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
        try {
            $payload = $request->all();
            $program = Program::find($payload['program']);
            if (!$program) throw new Exception('Program tidak ditemukan');
            if (!isset($payload['payment_account_id'])) throw new Exception('Akun pembayaran harus diisi');
            if ($payload['nominal'] < 10000) throw new Exception('Minimal nominal Rp 10.000');

            $paymentAccount = PaymentAccount::find($payload['payment_account_id']);
            if (!$paymentAccount) throw new Exception('Akun pembayaran tidak ditemukan');

            $payload['no_transaction'] = $this->generateTransactionOrderNumber();
            $payload['program_id'] = $payload['program'];
            if (!isset($payload['name'])) {
                $payload['name'] = 'Hamba Allah';
            }
            if ($payload['anonim'] == 1) {
                $payload['name'] = 'Hamba Allah';
                $payload['phone'] = NULL;
            }
            $payload['status'] = 1;

            Payment::create($payload);
            $result = $payload;
            return $this->customResponse(true, 'Pembayaran berhasil', $result);
        } catch (\Throwable $th) {
            return $this->customResponse(false, $th->getMessage());
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
        try {
            $result = Payment::with(['payment_account', 'program'])->where('no_transaction', $id)->first();
            return $this->customResponse(true, 'Pembayaran berhasil', $result);
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
