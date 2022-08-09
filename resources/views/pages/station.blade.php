@extends('layouts.master')

@section('navbar')
<div class="recharge-title">
    <div class="container h-100 d-flex justify-content-between align-items-center">
        <h3>
            <a href="/">
                <img src="/images/left.png" alt="left">
            </a>
        </h3>
        <h3>Bản ghi thư trang web</h3>
        <h3>
        </h3>
    </div>
</div>
@endsection

@section('content')
{!! $setting->vippage !!}

@endsection
