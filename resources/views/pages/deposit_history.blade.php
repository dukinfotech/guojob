@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/me">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Lịch sử rút tiền</h3>
        <h3>
        </h3>
    </div>
</div>
@endsection

@section('content')
@if(count($reqDeposits) == 0)
    <div class="d-flex justify-content-center align-items-center flex-column nodata">
        <div>
            <img src="/images/nodata.png" alt="" height="120">
        </div>
        <div>Không có đơn đặt hàng</div>
    </div>
@else
    <div class="recharge-history-content mt-3">
        @foreach ($reqDeposits as $reqDeposit)
        <div class="recharge-history-block mb-3">
        <h1>+ @money2($reqDeposit->money)</h1>
            <h2 style="color: #888">
                {{ $reqDeposit->code }} <br>
                @datetime($reqDeposit->created_at)
                <div class="{{ $reqDeposit->isPaid ? 'text-success' : 'text-danger' }}">{{ $reqDeposit->isPaid ? 'Đã xử lý' : 'Đang chờ' }}</div>
            </h2>
        </div>
        @endforeach
    </div>
@endif
@endsection
