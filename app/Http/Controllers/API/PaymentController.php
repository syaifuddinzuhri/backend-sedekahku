<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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
            if ($payload['nominal'] < 10000) throw new Exception('Minimal nominal Rp 10.000');
            $payload['no_transaction'] = $this->generateTransactionOrderNumber();
            $payload['program_id'] = $payload['program'];
            if (!isset($payload['name'])) {
                $payload['name'] = 'Hamba Allah';
            }
            if ($payload['anonim'] == 1) {
                $payload['name'] = 'Hamba Allah';
                $payload['phone'] = NULL;
            }
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
        //
    }
}
