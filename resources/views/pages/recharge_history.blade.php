@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/recharge">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Lịch sử nạp tiền</h3>
        <h3>
        </h3>
    </div>
</div>
@endsection

@section('content')
<div class="recharge-history-content mt-3">
    @foreach ($reqRecharges as $reqRecharge)
    <div class="recharge-history-block mb-3">
       <h1>+ @money2($reqRecharge->money)</h1>
        <h2 style="color: #888">
            {{ $reqRecharge->code }} <br>
            @datetime($reqRecharge->created_at)
            <div class="{{ $reqRecharge->isPaid ? 'text-success' : 'text-danger' }}">{{ $reqRecharge->isPaid ? 'Đã xử lý' : 'Đang chờ' }}</div>
        </h2>
    </div>
    @endforeach
</div>
@endsection
