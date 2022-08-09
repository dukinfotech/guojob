@extends('layouts.master2')

@section('content')
<div class="me">
    <div class="me-info d-flex justify-content-between">
        <div>
            <img src="/images/logo.png" alt="" height="100">
        </div>
        <div>
            <div class="me-block">{{ auth()->user()->name }}</div>
            <div class="me-block">Số dư: @money2(auth()->user()->balance)</div>
            <div class="me-block">{{ auth()->user()->phone }}</div>    
        </div>
    </div>
    <div class="me-content container mt-3 mb-5">
        <div class="charge-deposit">
            <div class="charge-deposit-logo d-flex justify-content-between">
                <div>
                    <a href="/recharge">
                        <img src="/images/moneyimg.png" alt="moneyimg" height="40">
                    </a>
                </div>
                <div>
                    <a href="/deposit">
                        <img src="/images/downloadmoney.png" alt="downloadmoney" height="40">
                    </a>
                </div>
            </div>
            <div class="charge-deposit-text d-flex justify-content-between">
                <div>
                    <a href="/recharge">
                        Nạp tiền
                    </a>
                </div>
                <div>
                    <a href="/deposit">
                        Rút tiền
                    </a>
                </div>
            </div>
        </div>
        <div class="charge-deposit-menu mt-3">
            <a href="/agreement">
                <img src="/images/mineb.png" alt="mineb">
                Hướng dẫn
            </a>
        </div>
        <div class="charge-deposit-menu mt-3">
            <a href="{{ $cskh_url }}">
                <img src="/images/minnc.png" alt="minnc">
                Dịch vụ
            </a>
        </div>
        <div class="charge-deposit-menu mt-3">
            <a href="/download?from=me">
                <img src="/images/mined.png" alt="mined">
                Tải xuống
            </a>
        </div>
        <div class="charge-deposit-menu mt-3">
            <a href="/deposit-history">
                <img src="/images/minee.png" alt="minee">
                Bảng ghi rút tiền
            </a>
        </div>
        <div class="charge-deposit-menu mt-3">
            <a href="/station">
                <img src="/images/monef.png" alt="monef">
                Ga thư
            </a>
        </div>
        <div class="text-center mt-3">
            <a href="/setting" class="setting">
                <h3>Cài đặt</h3>
            </a>
        </div>
    </div>
</div>
@endsection
