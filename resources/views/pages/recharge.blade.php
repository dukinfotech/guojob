@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Nạp tiền</h3>
        <h3>
            <a href="/recharge-history" class="history-link">Lịch sử</a>
        </h3>
    </div>
</div>
<div class="recharge-balance d-flex align-items-center justify-content-center">
    <h1>Số dư hiện tại: @money2(auth()->user()->balance)</h1>
</div>
@endsection

@section('content')
<div class="recharge-content mt-3">
    <h3>Số tiền nạp</h3>
    <div class="input-group input-group-lg">
        <span class="input-group-text" id="recharge_label">VND</span>
        <input id="recharge_money" type="number" class="form-control">
    </div>
    <div class="recharge_note1 h2 mt-3">
        Thời gian nạp 1 lần là 10 phút, số tiền tối thiểu là 100000 VND
    </div>
    <div class="recharge_note2 h2 mt-3">
        Thí dụ số tiền nạp
    </div>
    <div class="row">
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(100000)">100K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(200000)">200K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(500000)">500K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(1000000)">1000K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(3000000)">3000K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(5000000)">5000K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(10000000)">10000K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(20000000)">20000K</button>
        </div>
        <div class="col-6 col-sm-4 mb-2 col-lg-3">
            <button class="money_ex" onclick="exampleMoney(30000000)">30000K</button>
        </div>
    </div>
    <div class="text-center mt-3">
        <button class="btnRecharge">Quyết định nạp tiền</button>
    </div>
    <div class="recharge_note2 mt-3">
        Sự gợi ý
    </div>
    <div class="recharge_note1 mt-1">
        Trước mỗi lần nạp tiền, bạn phải lấy tài khoản  của thương gia mới và nội dung mới. <br>
        Sau mỗi lần nạp tiền, vui lòng không lưu tài khoản nạp và thông tin ngân hàng. <br>
        Tránh lỗi nạp tiền, nếu bạn gặp bất kỳ vấn đề gì về nạp tiền, vui lòng liên hệ với chuyên viên tư vấn.
    </div>
</div>
@endsection

@push('scripts')
<script>
    function exampleMoney(money) {
        $('#recharge_money').val(money);
    }
    $('.btnRecharge').click(function () {
        var money = $('#recharge_money').val();
        if (money > 0) {
            window.location.href = "/payment?money=" + money;
        } else {
            alert('Vui lòng nhập số tiền');
        }
    });
</script>
@endpush
