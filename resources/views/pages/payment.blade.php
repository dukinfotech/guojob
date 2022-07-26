@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/recharge">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Hãy chọn kênh thanh toán</h3>
        <h3></h3>
    </div>
</div>
@endsection

@section('content')
<form action="/payment" method="POST">
    @csrf
    <div class="payment-block mt-3">
        <input type="hidden" name="money" value="{{ request()->get('money') }}">
        <div class="row">
            @foreach ($payments as $i => $payment)
                <div class="col-xs-12 col-sm-6">
                    <input type="radio" name="payment" id="{{ $payment->bank }}" value="{{ $payment->id }}" required {{ $i === 0 ? 'checked' : '' }}>&nbsp;
                    <label for="{{ $payment->bank }}">
                        <h5>{{ $payment->bank }}</h5>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row mt-3 text-center text-white">
        <button type="submit" class="btnPayment">
            <h3>Quyết định nạp tiền</h3>
        </button>
    </div>
</form>
@endsection

@push('scripts')
@endpush
