@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/payment?money={{ request()->get('money') }}">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Chọn chuyển nhanh 24/7</h3>
        <h3></h3>
    </div>
</div>
@endsection
@section('content')
<div class="confirm_recharge_block mt-3">
    <div class="text-center">
        <img src="{{ $payment->bank_logo }}" alt="" height="80">
    </div>
    <div class="h5 mt-4" style="color: #E1105C">Số dư thanh toán @money2(request()->get('money'))</div>
    <div class="h6 mt-1">Mã đơn hàng {{ request()->get('code') }}</div>
    <form action="">
        <label for="content" class="form-label">Nội dung chuyển khoản</label>
        <div class="input-group mb-3">
            <input type="text" name="content" class="form-control" value="{{ $payment->content }}" id="copyContent">
            <button class="btn btn-outline-secondary" type="button" onclick="copy('copyContent')">Copy</button>
        </div>
        <label for="receiver" class="form-label">Thông tin người thụ hưởng</label>
        <div class="input-group mb-3">
            <input type="text" name="receiver" class="form-control" value="{{ $payment->receiver }}" id="copyReceiver">
            <button class="btn btn-outline-secondary" type="button" onclick="copy('copyReceiver')">Copy</button>
        </div>
        <label for="number" class="form-label">Số tài khoản thụ hưởng</label>
        <div class="input-group mb-3">
            <input type="text" name="number" class="form-control" value="{{ $payment->number }}" id="copyNumber">
            <button class="btn btn-outline-secondary" type="button" onclick="copy('copyNumber')">Copy</button>
        </div>
    </form>
    <div class="recharge_note2 mt-3">
        Danh mục chú ý
    </div>
    <div class="recharge_note1 mt-1">
        Các bạn nhớ nhập nội dung ghi chú chuyển khoản, nếu không sẽ không thể nạp tiền thành công
    </div>
    <div class="recharge_note2 mt-3">
        Lời nhắc nhở ấm áp
    </div>
    <div class="recharge_note1 mt-1">
        Vui lòng xác nhận lại thông tin tài khoản ngân hàng của bạn, điền và thanh toán trong thời gian còn liên lạc. Nếu hết thời gian hiệu lực, vui lòng tạo mới đơn hàng
    </div>
</div>
<div class="text-center h3 mt-3">
    <a href="/" class="link-white">Trang chủ</a>
</div>
@endsection

@push('scripts')
<script>
    function copy(id) {
        var value = $('#' + id).val();
        const textArea = document.createElement("textarea");
        textArea.value = value;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            alert('Copy thành công');
        } catch (err) {
            console.error('Unable to copy to clipboard', err);
        }
        document.body.removeChild(textArea);
    }
</script>
@endpush
