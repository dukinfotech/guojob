@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Số tiền dư</h3>
        <h3>
        </h3>
    </div>
</div>
@endsection

@section('content')

<form action="/deposit" method="POST">
    <div class="deposit-content mt-3">
        @csrf
        <div class="mb-3">
            <label for="money" class="form-label">Số tiền rút <span class="required">*</span></label>
            <input type="number" name="money" class="form-control" value="{{ old('money') }}" placeholder="Nhập số tiền rút" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại <span class="required">*</span></label>
            <input type="number" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Số tài khoản <span class="required">*</span></label>
            <input type="text" name="number" class="form-control" value="{{ old('number') }}" placeholder="Nhập số tài khoản" required>
        </div>
        <div class="mb-3">
            <label for="bank" class="form-label">Ngân hàng sở hữu <span class="required">*</span></label>
            <select name="bank" class="form-control">
                @foreach ($payments as $payment)
                <option value="{{ $payment->id }}" {{ old('bank') == $payment->id ? 'selected' : '' }}>{{ $payment->bank }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên <span class="required">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập họ và tên" required>
        </div>
        <div class="mb-3">
            <label for="passcode" class="form-label">Mật khẩu quỹ <span class="required">*</span></label>
            <input type="text" name="passcode" class="form-control" value="{{ old('passcode') }}" placeholder="Nhập mật khẩu quỹ" required>
        </div>
        @if(session('error'))
        <div class="error"></div>
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="error"></div>
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <p class="mt-3 text-white">
        Vui lòng kiểm tra kỹ thông tin giao dịch, nếu có sai sót thông tin, tài khoản sẽ không nhận được tiền.
        Hôm nay rút tiền sẽ được nhận khấu trừ.
        Nhận tiền nhanh trong 5 phút, chậm nhất 30 phút.
    </p>
    <div class="text-center">
        <button class="btnDeposit">Rút tiền ngay</button>
    </div>
</form>

<div class="text-center h3 mt-3">
    <a href="/" class="link-white">Trang chủ</a>
</div>
@endsection

@push('scripts')
@endpush
