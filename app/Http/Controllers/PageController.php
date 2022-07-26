<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\RequestRecharge;
use App\Models\RequestDeposit;
use App\Models\Notification;

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

    public function rechargeHistory() {
        $user = auth()->user();
        $reqRecharges = RequestRecharge::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('pages.recharge_history')->with('reqRecharges', $reqRecharges);
    }

    public function depositHistory() {
        $user = auth()->user();
        $reqDeposits = RequestDeposit::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('pages.deposit_history')->with('reqDeposits', $reqDeposits);
    }

    public function myteam() {
        $setting = DB::table('settings')->first();
        return view('pages.myteam')->with('setting', $setting);
    }

    public function vip() {
        $setting = DB::table('settings')->first();
        return view('pages.vip')->with('setting', $setting);
    }

    public function introduce() {
        $setting = DB::table('settings')->first();
        return view('pages.introduce')->with('setting', $setting);
    }

    public function station() {
        $notifications = Notification::where('user_id', auth()->user()->id)->get();
        return view('pages.station')->with('notifications', $notifications);
    }

    public function me() {
        $cskh_url = null;
        if (auth()->user()->parent) {
            $cskh_url = auth()->user()->parent->cskh_url;
        } else {
            $cskh_url = auth()->user()->cskh_url;
        }
        return view('pages.me')->with('cskh_url', $cskh_url);
    }

    public function agreement() {
        return view('pages.agreement');
    }

    public function setting() {
        return view('pages.setting');
    }

    public function download() {
        $setting = DB::table('settings')->first();
        return view('pages.download')->with('setting', $setting);
    }
}
