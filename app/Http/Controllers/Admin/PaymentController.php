<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        return view('payments.index');
    }

    public function getPaymentData()
    {
        $datatable = Datatables::of(Payment::query());
        return $datatable->addColumn('bank_logo', function ($data) {
                            return '<img src="'. $data->bank_logo .'" height="50">';
                        })
                        ->addColumn('action', function ($data) {
                            return '<a href="/admin/payments/'.$data->id.'" class="btn btn-warning">Sửa</a>
                                <form class="d-inline" method="post" action="/admin/payments/'.$data->id.'" id="deletePaymentForm'.$data->id.'">
                                    <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                    <input type="hidden" name="_method" value="delete" />
                                    <button type="button" class="btn btn-danger" onclick="deletePayment('.$data->id.')">Xóa</button>
                                </form>';
                            })
                        ->escapeColumns([])
                        ->make(true);
    }

    public function create()
    {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }
        return view('payments.create');
    }

    public function save(Request $request)
    {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        Payment::create([
            'bank' => $request->bank,
            'bank_logo' => $request->bank_logo,
            'content' => $request->content,
            'receiver' => $request->receiver,
            'number' => $request->number,
        ]);

        return back()->with('success', true);
    }

    public function showEdit($id)
    {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $payment = Payment::findOrFail($id);

        return view('payments.edit')->with('payment', $payment);
    }

    public function delete($id) {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $payment = Payment::findOrFail($id);

        $payment->delete();

        return back();
    }

    public function update($id, Request $request) {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $payment = Payment::findOrFail($id);

        $payment->bank = $request->bank;
        $payment->bank_logo = $request->bank_logo;
        $payment->content = $request->content;
        $payment->receiver = $request->receiver;
        $payment->number = $request->number;

        $payment->save();

        return back()->with('success', true);
    }
}
