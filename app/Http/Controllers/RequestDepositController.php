<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\RequestDeposit;

class RequestDepositController extends Controller
{
    public function send(Request $req) {
        try {
            if (!is_numeric($req->money) || (is_numeric($req->money) && $req->money <= 0 || $req->money > auth()->user()->balance)) {
                throw new \Exception('Số tiền rút không hợp lệ');
            }

            if (! password_verify($req->passcode, auth()->user()->passcode)) {
                throw new \Exception('Mật khẩu kỹ quý không đúng');
            }

            if (auth()->user()->level !== 'v1') {
                throw new \Exception('Bạn cần hoàn thành nhiệm vụ để rút toàn bộ số tiền về. Vui lòng liên hệ chuyên viên hướng dẫn');
            }
            
            $reqDeposit = new RequestDeposit($req->all());

            $user = auth()->user();
            $user->balance = $user->balance - $req->money;
            $user->save();
            $reqDeposit->user()->associate($user);
            $reqDeposit->save();
            return back()->with('success', 'Đã gửi yêu cầu thành công. Vui lòng chờ xử lý');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
