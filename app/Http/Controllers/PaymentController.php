<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = \App\Models\Payment::with('rental')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function update($id)
    {
        $payment = \App\Models\Payment::find($id);
        $payment->status = 'valid';
        $payment->save();

        return back();
    }
    public function store(Request $request)
    {
        Payment::create([
            'rental_id' => $request->rental_id,
            'metode' => $request->metode,
            'bukti' => $request->file('bukti')->store('bukti')
        ]);

        return redirect()->back();
    }
}
