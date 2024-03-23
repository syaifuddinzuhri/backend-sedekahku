<?php

namespace App\Http\Controllers;

use App\Constants\UploadPathConstant;
use App\Http\Requests\PaymentAccountRequest;
use App\Models\PaymentAccount;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentAccountController extends Controller
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
            $data = PaymentAccount::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '';
                    $button .= '<a href="/payment-account/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                    <i class="fa fa-edit" aria-hidden="true"></i> Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#modal-delete-payment-account"class="btn btn-sm btn-danger delete-payment-account">
                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>';
                    $button .= '</div>';

                    return $button;
                })
                ->editColumn('total', function ($data) {
                    return 'Rp ' . number_format($data->total, 0, ',', '.');
                })
                ->editColumn('pengeluaran', function ($data) {
                    return 'Rp ' . number_format($data->pengeluaran, 0, ',', '.');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('payment-account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment-account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentAccountRequest $request)
    {
        $payload = $request->all();
        if ($request->hasFile('logo') || $request->logo != null) {
            $file = $request->file('logo');
            $file_name = $this->uploadImage($file, UploadPathConstant::PAYMENT_ACCOUNT);
            $payload['logo'] = $file_name;
        }
        $res = PaymentAccount::create($payload);
        return redirect()->route('payment-account.index')->with('success', 'Data berhasil ditambahkan.');
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
        $data = PaymentAccount::find($id);
        return view('payment-account.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentAccountRequest $request, $id)
    {
        $data = PaymentAccount::find($id);
        $payload = $request->all();
        if ($request->hasFile('logo') || $request->logo != null) {
            $name = $data->slug . '-' . rand(1111, 9999);
            $file = $request->file('logo');
            $file_name = $this->uploadImage($file, UploadPathConstant::PAYMENT_ACCOUNT, true, $name);
            $payload['logo'] = $file_name;
            if ($data->logo) {
                $image_old = explode('/', $data->logo);
                $this->unlinkImage(UploadPathConstant::PAYMENT_ACCOUNT, end($image_old));
            }
        }
        $data->update($payload);
        return redirect()->route('payment-account.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PaymentAccount::find($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
