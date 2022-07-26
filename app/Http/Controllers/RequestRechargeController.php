<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestRecharge;
use App\Models\Payment;
use Illuminate\Support\Str;

class RequestRechargeController extends Controller
{
    public function send(Request $req) {
        $reqRecharge = new RequestRecharge();
        $reqRecharge->code = Str::upper(Str::random(8));
        $reqRecharge->money = $req->money;

        $user = auth()->user();
        $payment = Payment::findOrFail($req->payment);
        $reqRecharge->user()->associate($user);
        $reqRecharge->payment()->associate($payment);

        $reqRecharge->save();

        return redirect('/confirm-recharge?payment=' . $req->payment . '&money=' . $req->money . '&code=' . $reqRecharge->code);
    }
}
