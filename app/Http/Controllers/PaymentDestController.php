<?php

namespace App\Http\Controllers;

use App\Models\PaymentDest;
use Illuminate\Http\Request;

class PaymentDestController extends Controller
{
    public function index()
    {
        $paymentDests = PaymentDest::latest()->get();
        return view('backend.paymentdests.index', compact('paymentDests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
        ]);

        PaymentDest::create($request->all());

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Data berhasil ditambahkan.'
        ]);

        return redirect()->back();
    }

    public function update(Request $request, PaymentDest $paymentdest)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
        ]);

        $paymentdest->update($request->all());

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Data berhasil diupdate.'
        ]);

        return redirect()->back();
    }

    public function destroy(PaymentDest $paymentdest)
    {
        $paymentdest->delete();

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Data berhasil dihapus.'
        ]);

        return redirect()->back();
    }
}
