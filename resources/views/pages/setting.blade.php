@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/me">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Cài đặt</h3>
        <h3>
        </h3>
    </div>
</div>
@endsection

@section('content')
<div class="text-center mt-5">
    <div class="btn-logout">
        <a href="/logout">
           <h3>Đăng xuất</h3>
        </a>
    </div>
</div>
@endsection
