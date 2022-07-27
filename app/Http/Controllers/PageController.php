<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;

class PageController extends Controller
{
    public function homepage() {
        $setting = DB::table('settings')->first();
        $homepage_images = json_decode($setting->homepage_images);
        $cskh_url = null;
        if (auth()->user()->parent) {
            $cskh_url = auth()->user()->parent->cskh_url;
        } else {
            $cskh_url = auth()->user()->cskh_url;
        }
        return view('pages.homepage')->with([
            'homepage_images' => $homepage_images,
            'cskh_url' => $cskh_url
        ]);;
    }

    public function recharge()
    {
        return view('pages.recharge');
    }

    public function payment(Request $req)
    {
        if (!isset($req->money)) {
            abort(403);
        }
        $payments = Payment::all();
        return view('pages.payment')->with('payments', $payments);
    }

    public function confirmRecharge(Request $req)
    {
        if (!isset($req->money) || !isset($req->payment)) {
            abort(403);
        }
        $payment = Payment::findOrFail($req->payment);
        return view('pages.confirm_recharge')->with('payment', $payment);
    }

    public function deposit() {
        $payments = Payment::all();
        return view('pages.deposit')->with('payments', $payments);
    }
}
